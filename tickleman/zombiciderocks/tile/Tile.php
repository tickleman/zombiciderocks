<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Mapper\Component;
use ITRocks\Framework\Traits\Has_Code;
use ITRocks\Framework\Tools\Paths;
use Tickleman\ZombicideRocks\Tile\Tag;

/**
 * A tile for Zombicide
 *
 * @business
 * @display_order box, code, image, tags
 * @list box.name, code, image.name
 * @representative code
 * @sort box.name, code
 */
class Tile
{
	use Component;
	use Has_Code;

	//------------------------------------------------------------------------------------------ $box
	/**
	 * @composite
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

	/**
	 * Keep tiles with missing legacy uploads selectable in the map editor.
	 */
	public function imageUri() : string
	{
		$content = $this->image ? $this->image->getContent() : null;
		return ($content && @getimagesizefromstring($content))
			? $this->image->link()
			: Paths::$project_uri . '/tickleman/zombiciderocks/img/missing-image.svg';
	}

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->code);
	}

}
