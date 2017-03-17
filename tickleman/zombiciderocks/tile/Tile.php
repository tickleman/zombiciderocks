<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Traits\Has_Code;
use Tickleman\ZombicideRocks\Tile\Tag;

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

	//----------------------------------------------------------------------------------------- $tags
	/**
	 * @link Map
	 * @var Tag[]
	 */
	public $tags;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->code);
	}

}
