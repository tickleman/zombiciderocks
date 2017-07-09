<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Traits\Has_Name;

/**
 * Zombicide game token
 *
 * @business
 * @display_order boxes, name, image
 * @list boxes.name, name, image.name
 * @representative name
 */
class Token
{
	use Has_Name;

	//---------------------------------------------------------------------------------------- $boxes
	/**
	 * @link Map
	 * @var Box[]
	 */
	public $boxes;

	//---------------------------------------------------------------------------------------- $image
	/**
	 * @link Object
	 * @var File
	 */
	public $image;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->name);
	}

}
