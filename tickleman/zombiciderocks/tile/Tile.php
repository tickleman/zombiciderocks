<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Traits\Has_Code;

/**
 * A tile for Zombicide
 *
 * @business
 */
class Tile
{
	use Has_Code;

	//------------------------------------------------------------------------------------------ $box
	/**
	 * @link Object
	 * @var Box
	 */
	public $box;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->code);
	}

}
