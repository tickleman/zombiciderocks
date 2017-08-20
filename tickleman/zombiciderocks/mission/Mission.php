<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Dao\File\Session_File\Files;
use ITRocks\Framework\Session;
use ITRocks\Framework\Traits\Has_Code;
use Tickleman\ZombicideRocks\Mission\Author;
use Tickleman\ZombicideRocks\Mission\Objective;
use Tickleman\ZombicideRocks\Mission\Special_Rule;
use Tickleman\ZombicideRocks\Mission\Tile\Grid;

/**
 * A mission for Zombicide
 *
 * @business
 * @display_order code, title, difficulty_level, survivors_count, duration, author, introduction,
 *                material, tiles, equipment_cards, zombie_cards, objectives, special_rules
 * @group _top code, title
 * @group Main difficulty_level, survivors_count, duration, author
 * @group Story introduction, objectives, special_rules
 * @group Material material, equipment_cards, zombie_cards
 * @group Map tiles, tokens
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

	//------------------------------------------------------------------------------------- $material
	/**
	 * @link Map
	 * @var Box[]
	 */
	public $material;

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
