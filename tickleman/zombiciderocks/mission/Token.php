<?php
namespace Tickleman\ZombicideRocks\Mission;

use ITRocks\Framework\Mapper\Component;
use Tickleman\ZombicideRocks;
use Tickleman\ZombicideRocks\Mission;

/**
 * A Zombicide token into a mission
 *
 * @display_order token, top, left, orientation
 * @link ZombicideRocks\Token
 * @set Missions_Tokens
 * @sort top, left
 */
class Token extends ZombicideRocks\Token
{
	use Component;

	//----------------------------------------------------------------------------------------- $left
	/**
	 * @mandatory
	 * @max_value 24750
	 * @var integer
	 */
	public $left = 0;

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

	//---------------------------------------------------------------------------------------- $token
	/**
	 * @composite
	 * @link Object
	 * @var ZombicideRocks\Token
	 */
	public $token;

	//------------------------------------------------------------------------------------------ $top
	/**
	 * @mandatory
	 * @max_value 24750
	 * @var integer
	 */
	public $top = 0;

}
