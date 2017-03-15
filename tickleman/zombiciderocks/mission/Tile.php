<?php
namespace Tickleman\ZombicideRocks\Mission;

use ITRocks\Framework\Mapper\Component;
use Tickleman\ZombicideRocks\Mission;
use Tickleman\ZombicideRocks;

/**
 * A zombicide tile into a mission
 *
 * @display_order tile, top, left, orientation
 * @link ZombicideRocks\Tile
 * @set Missions_Tiles
 * @sort top, left
 */
class Tile extends ZombicideRocks\Tile
{
	use Component;

	//----------------------------------------------------------------------------------------- $left
	/**
	 * @mandatory
	 * @max_value 99
	 * @var integer
	 */
	public $left = 1;

	//-------------------------------------------------------------------------------------- $mission
	/**
	 * @composite
	 * @link Object
	 * @mandatory
	 * @var Mission
	 */
	public $mission;

	//---------------------------------------------------------------------------------- $orientation
	/**
	 * @mandatory
	 * @values Orientation::const
	 * @var string
	 */
	public $orientation = Orientation::NORTH;

	//----------------------------------------------------------------------------------------- $tile
	/**
	 * @composite
	 * @link Object
	 * @mandatory
	 * @var ZombicideRocks\Tile
	 */
	public $tile;

	//------------------------------------------------------------------------------------------ $top
	/**
	 * @mandatory
	 * @max_value 99
	 * @var integer
	 */
	public $top = 1;

}
