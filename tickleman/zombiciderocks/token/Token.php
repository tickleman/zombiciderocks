<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Objects\Code;
use Tickleman\ZombicideRocks\Box\Token_Box;

/**
 * Zombicide game token
 *
 * @business
 * @display_order boxes, name, image, code
 * @list boxes.name, name, image.name
 * @representative name
 */
class Token extends Code
{

	//---------------------------------------------------------------------------------------- $boxes
	/**
	 * @link Collection
	 * @var Token_Box[]
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
