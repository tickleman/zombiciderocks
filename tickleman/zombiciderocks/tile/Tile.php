<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Traits\Has_Code;
use Tickleman\ZombicideRocks\Tile\Tag;

/**
 * A tile for Zombicide
 *
 * @business
 * @display_order box, code, image, tags
 * @list box, code, image.name
 * @representative code
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

	//---------------------------------------------------------------------------------------- $image
	/**
	 * @link Object
	 * @var File
	 */
	public $image;

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
