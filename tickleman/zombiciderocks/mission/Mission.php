<?php
namespace Tickleman\ZombicideRocks;

use Box;
use ITRocks\Framework\User;
use Tickleman\ZombicideRocks\Card;

/**
 * A mission for Zombicide
 *
 * @business
 */
class Mission
{

	//--------------------------------------------------------------------------------------- $author
	/**
	 * @link Object
	 * @var User
	 */
	public $author;

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

	//---------------------------------------------------------------------------------------- $tiles
	/**
	 * @link Collection
	 * @var Tile[]
	 */
	public $tiles;

	//--------------------------------------------------------------------------------- $zombie_cards
	/**
	 * @link Map
	 * @var Card\Zombie[]
	 */
	public $zombie_cards;

}
