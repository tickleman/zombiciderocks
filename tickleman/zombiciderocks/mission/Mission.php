<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Traits\Has_Code;
use Tickleman\ZombicideRocks\Card;
use Tickleman\ZombicideRocks\Mission\Author;

/**
 * A mission for Zombicide
 *
 * @business
 * @display_order code, title, author, difficulty_level, survivors_count, duration, material,
 *                tiles, equipment_cards, zombie_carts
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

	//------------------------------------------------------------------------------------- $duration
	/**
	 * @max_size 4
	 * @var integer
	 */
	public $duration;

	//----------------------------------------------------------------------------- $difficulty_level
	/**
	 * @values easy, medium, hard
	 * @var string
	 */
	public $difficulty_level;

	//------------------------------------------------------------------------------ $equipment_cards
	/**
	 * @link Map
	 * @var Card\Equipment[]
	 */
	public $equipment_cards;

	//------------------------------------------------------------------------------------- $material
	/**
	 * @link Map
	 * @var Box[]
	 */
	public $material;

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
