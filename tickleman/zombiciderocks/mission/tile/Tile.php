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
 * @unique left, mission, tile, top
 */
class Tile extends ZombicideRocks\Tile
{
	use Component;
	use Has_Image_And_Orientation;

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
