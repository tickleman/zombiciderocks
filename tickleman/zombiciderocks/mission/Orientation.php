<?php
namespace Tickleman\ZombicideRocks\Mission;

/**
 * A Zombicide tile and token orientation
 */
class Orientation
{

	//------------------------------------------------------------------------------------------ EAST
	const EAST = 'east';

	//----------------------------------------------------------------------------------------- NORTH
	const NORTH = 'north';

	//----------------------------------------------------------------------------------------- SOUTH
	const SOUTH = 'south';

	//------------------------------------------------------------------------------------------ WEST
	const WEST = 'west';

	//----------------------------------------------------------------------------------------- angle
	/**
	 * @param $orientation string @values self::const
	 * @return float
	 */
	public static function angle($orientation)
	{
		switch ($orientation) {
			case self::EAST:  return 270;
			case self::NORTH: return 0;
			case self::SOUTH: return 180;
			case self::WEST:  return 90;
		}
		return null;
	}

}
