<?php
namespace Tickleman\ZombicideRocks\Mission;

use ITRocks\Framework\Dao\File\Session_File\Files;
use ITRocks\Framework\Session;
use ITRocks\Framework\Tools\Image;

/**
 * For mission elements that have an image (Tile, Token)
 *
 * @extends Tile
 * @extends Token
 */
trait Has_Image_And_Orientation
{

	//------------------------------------------------------------------------------------------- uri
	/**
	 * Generates the tile image with the right orientation, and returns an URI to this image
	 */
	public function uri()
	{
		/** @var $this Tile|Token|self */
		$image = Image::createFromFile($this->image);
		/** @var $session_files Files */
		$session_files = Session::current()->get(Files::class, true);
		$uri           = $session_files->addAndGetLink($image->asFile($this->image->name));
		if ($this->orientation !== Orientation::NORTH) {
			$uri .= '?rotate=' . Orientation::angle($this->orientation);
		}
		return $uri;
	}

}
