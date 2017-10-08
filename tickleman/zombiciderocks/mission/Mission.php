<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Dao;
use ITRocks\Framework\Dao\File\Session_File\Files;
use ITRocks\Framework\Session;
use ITRocks\Framework\Traits\Has_Code;
use Tickleman\ZombicideRocks\Campaign\Campaign_Mission;
use /** @noinspection PhpUnusedAliasInspection $url @widget */ Tickleman\ZombicideRocks\Link\Url;
use Tickleman\ZombicideRocks\Mission\Author;
use Tickleman\ZombicideRocks\Mission\Objective;
use Tickleman\ZombicideRocks\Mission\Special_Rule;
use Tickleman\ZombicideRocks\Mission\Tile\Grid;

/**
 * A mission for Zombicide
 *
 * @after_read
 * @after_write
 * @business
 * @group _top code, title, campaign
 * @group Main difficulty_level, survivors_count, maximum_survivors_count, duration, author,
 *             link_to_source, link_to_scenario
 * @group Map tiles, tokens
 * @group Material material, equipment_cards, zombie_cards
 * @group Story introduction, objectives, special_rules
 * @groups_order Main, Story, Material, Map
 * @list code, title, difficulty_level, survivors_count, duration, author.name
 * @representative code, title
 * @sort code, title
 */
class Mission
{
	use Has_Code;

	//--------------------------------------------------------------------------------------- $author
	/**
	 * @link Object
	 * @var Author
	 */
	public $author;

	//------------------------------------------------------------------------------------- $campaign
	/**
	 * @link Object
	 * @store false
	 * @var Campaign
	 */
	public $campaign;

	//----------------------------------------------------------------------------- $difficulty_level
	/**
	 * @values easy, medium, hard
	 * @var string
	 */
	public $difficulty_level;

	//------------------------------------------------------------------------------------- $duration
	/**
	 * @max_size 4
	 * @var integer
	 */
	public $duration;

	//------------------------------------------------------------------------------ $equipment_cards
	/**
	 * @link Map
	 * @user invisible
	 * @var Card\Equipment[]
	 */
	public $equipment_cards;

	//--------------------------------------------------------------------------------- $introduction
	/**
	 * @max_length 65535
	 * @multiline
	 * @var string
	 */
	public $introduction;

	//------------------------------------------------------------------------------- $link_to_source
	/**
	 * @var string
	 * @widget Url
	 */
	public $link_to_source;

	//----------------------------------------------------------------------------- $link_to_scenario
	/**
	 * @var string
	 * @widget Url
	 */
	public $link_to_scenario;

	//------------------------------------------------------------------------------------- $material
	/**
	 * @link Map
	 * @var Box[]
	 */
	public $material;

	//---------------------------------------------------------------------- $maximum_survivors_count
	/**
	 * If set, the maximum number of survivors that can play the game
	 *
	 * @max_size 2
	 * @null
	 * @var integer
	 */
	public $maximum_survivors_count;

	//----------------------------------------------------------------------------------- $objectives
	/**
	 * @link Collection
	 * @var Objective[]
	 */
	public $objectives;

	//-------------------------------------------------------------------------------- $special_rules
	/**
	 * @link Collection
	 * @var Special_Rule[]
	 */
	public $special_rules;

	//------------------------------------------------------------------------------ $survivors_count
	/**
	 * @max_size 2
	 * @var integer
	 */
	public $survivors_count;

	//---------------------------------------------------------------------------------------- $tiles
	/**
	 * @link Collection
	 * @var Mission\Tile[]
	 * @widget Mission\Tile\Widget
	 */
	public $tiles;

	//---------------------------------------------------------------------------------- $tiles_image
	/**
	 * @user invisible
	 * @store false
	 * @var string
	 */
	private $tiles_image;

	//---------------------------------------------------------------------------------------- $title
	/**
	 * @mandatory
	 * @var string
	 */
	public $title;

	//--------------------------------------------------------------------------------------- $tokens
	/**
	 * @link Collection
	 * @var Mission\Token[]
	 * @widget Mission\Token\Widget
	 */
	public $tokens;

	//--------------------------------------------------------------------------------- $zombie_cards
	/**
	 * @link Map
	 * @user invisible
	 * @var Card\Zombie[]
	 */
	public $zombie_cards;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return trim(strval($this->code) . SP . strval($this->title));
	}

	//------------------------------------------------------------------------------------- afterRead
	/**
	 * Get campaign from its Campaign_Mission, if exists.
	 * Getting it once the mission is read is the simplest thing, not the most optimized.
	 */
	public function afterRead()
	{
		$campaign_mission = Dao::searchOne(['mission' => $this], Campaign_Mission::class);
		if ($campaign_mission) {
			$this->campaign = $campaign_mission->campaign;
		}
	}

	//------------------------------------------------------------------------------------ afterWrite
	/**
	 * Link mission to campaign if needed.
	 * Remove the link if removed.
	 */
	public function afterWrite()
	{
		// remove this mission from the campaigns it is not linked to
		foreach (Dao::search(['mission' => $this], Campaign_Mission::class) as $campaign_mission) {
			if (!$this->campaign || !Dao::is($campaign_mission->campaign, $this->campaign)) {
				Dao::delete($campaign_mission);
			}
		}
		// add this mission to its campaign, if not already in it
		if ($this->campaign) {
			$already_in_campaign = false;
			$maximum_ordering    = 0;
			foreach ($this->campaign->missions as $campaign_mission) {
				if (Dao::is($campaign_mission->mission, $this)) {
					$already_in_campaign = true;
					break;
				}
				$maximum_ordering = max($maximum_ordering, $campaign_mission->ordering);
			}
			if (!$already_in_campaign) {
				$campaign_mission           = new Campaign_Mission();
				$campaign_mission->campaign = $this->campaign;
				$campaign_mission->mission  = $this;
				$campaign_mission->ordering = $maximum_ordering + 1;
				Dao::write($campaign_mission);
			}
		}
	}

	//--------------------------------------------------------------------------------- moreSurvivors
	/**
	 * Returns '+' if more survivors are allowed
	 * Returns '-n' if the maximum survivors count is known
	 *
	 * @return string @values +,
	 */
	public function moreSurvivors()
	{
		if ($this->maximum_survivors_count > $this->survivors_count) {
			return '-' . $this->maximum_survivors_count;
		}
		if (!$this->maximum_survivors_count) {
			return '+';
		}
		return '';
	}

	//------------------------------------------------------------------------------------- tileCodes
	/**
	 * Returns the list of tile codes, sorted
	 */
	public function tileCodes()
	{
		$tile_codes = array_map(function(Tile $tile) { return $tile->code; }, $this->tiles);
		sort($tile_codes);
		return $tile_codes;
	}

	//------------------------------------------------------------------------------------ tilesImage
	/**
	 * Creates an image for current mission tiles and tokens and returns a link to this image
	 *
	 * @return string
	 */
	public function tilesImage()
	{
		if (!isset($this->tiles_image)) {
			$grid            = new Grid($this);
			$image           = $grid->toImage();
			$image_file_name = 'mission-' . strtolower($this->code) . '.jpg';
			/** @var $session_files Files */
			$session_files     = Session::current()->get(Files::class, true);
			$this->tiles_image = $image
				? $session_files->addAndGetLink($image->asFile($image_file_name))
				: '';
		}
		return $this->tiles_image;
	}

}
