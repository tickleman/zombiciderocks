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
 * @unique left, mission, token, top
 */
class Token extends ZombicideRocks\Token
{
	use Component;
	use Has_Image_And_Orientation;

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

	//---------------------------------------------------------------------------------------- left50
	/**
	 * Gets left plus a 50 pixels margin
	 *
	 * @return integer
	 */
	public function left50()
	{
		return $this->left + 50;
	}

	//----------------------------------------------------------------------------------------- top50
	/**
	 * Gets left plus a 50 pixels margin
	 *
	 * @return integer
	 */
	public function top50()
	{
		return $this->top + 50;
	}

}
