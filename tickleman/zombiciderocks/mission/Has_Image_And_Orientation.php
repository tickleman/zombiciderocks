<?php
namespace Tickleman\ZombicideRocks\Mission;

use ITRocks\Framework\Dao;
use ITRocks\Framework\Dao\Data_Link;
use ITRocks\Framework\Tools\Image;
use ITRocks\Framework\Tools\Paths;

/**
 * For mission elements that have an image (Tile, Token)
 *
 * @extends Tile
 * @extends Token
 */
trait Has_Image_And_Orientation
{

	/**
	 * Saving a placement must not rewrite the shared tile or token and its box collections.
	 */
	public function writePlacementOnly(Data_Link $link, array &$options) : void
	{
		$options[] = Dao::linkClassOnly();
	}

	/**
	 * Old databases can contain empty uploads or files that are not images.
	 */
	public function mapImage() : ?Image
	{
		$content = $this->image ? $this->image->getContent() : null;
		return ($content && @getimagesizefromstring($content))
			? Image::createFromString($content)
			: null;
	}

	//------------------------------------------------------------------------------------------- uri
	/**
	 * Generates the tile image with the right orientation, and returns an URI to this image
	 */
	public function uri()
	{
		/** @var $this Tile|Token|self */
		$image = $this->mapImage();
		if (!$image) {
			return Paths::$project_uri . '/tickleman/zombiciderocks/img/missing-image.svg';
		}
		$uri = $image->asFile(uniqid() . DOT . rLastParse($this->image->name, DOT))->link();
		if ($this->orientation !== Orientation::NORTH) {
			$uri .= '?rotate=' . Orientation::angle($this->orientation);
		}
		return $uri;
	}

}
