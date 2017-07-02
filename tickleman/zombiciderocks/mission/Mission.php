<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Traits\Has_Code;
use Tickleman\ZombicideRocks\Mission\Author;
use Tickleman\ZombicideRocks\Mission\Objective;
use Tickleman\ZombicideRocks\Mission\Special_Rule;

/**
 * A mission for Zombicide
 *
 * @business
 * @display_order code, title, difficulty_level, survivors_count, duration, author, introduction,
 *                material, tiles, equipment_cards, zombie_cards, objectives, special_rules
 * @representative code, title
 * @sort title
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
	 */
	public $tiles;

	//---------------------------------------------------------------------------------------- $title
	/**
	 * @mandatory
	 * @var string
	 */
	public $title;

	//--------------------------------------------------------------------------------- $zombie_cards
	/**
	 * @link Map
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

}
