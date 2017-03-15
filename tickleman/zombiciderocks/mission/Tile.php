<?php
namespace Tickleman\ZombicideRocks\Mission;

use ITRocks\Framework\Mapper\Component;
use Tickleman\ZombicideRocks\Mission;
use Tickleman\ZombicideRocks;

/**
 * A zombicide tile into a mission
 *
 * @link ZombicideRocks\Tile
 */
class Tile extends ZombicideRocks\Tile
{
	use Component;

	//-------------------------------------------------------------------------------------- $mission
	/**
	 * @component
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

	//----------------------------------------------------------------------------------------- $left
	/**
	 * @mandatory
	 * @max_value 99
	 * @var integer
	 */
	public $left = 1;

	//----------------------------------------------------------------------------------------- $tile
	/**
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
