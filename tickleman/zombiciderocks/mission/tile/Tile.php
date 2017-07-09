<?php
namespace Tickleman\ZombicideRocks\Mission;

use ITRocks\Framework\Dao\File\Session_File\Files;
use ITRocks\Framework\Mapper\Component;
use ITRocks\Framework\Session;
use ITRocks\Framework\Tools\Image;
use Tickleman\ZombicideRocks\Mission;
use Tickleman\ZombicideRocks;

/**
 * A zombicide tile into a mission
 *
 * @display_order tile, top, left, orientation
 * @link ZombicideRocks\Tile
 * @set Missions_Tiles
 * @sort top, left
 */
class Tile extends ZombicideRocks\Tile
{
	use Component;

	//----------------------------------------------------------------------------------------- $left
	/**
	 * @mandatory
	 * @max_value 99
	 * @var integer
	 */
	public $left = 1;

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

	//----------------------------------------------------------------------------------------- $tile
	/**
	 * @composite
	 * @link Object
	 * @var ZombicideRocks\Tile
	 */
	public $tile;

	//------------------------------------------------------------------------------------------ $top
	/**
	 * @mandatory
	 * @max_value 99
	 * @var integer
	 */
	public $top = 1;

	//------------------------------------------------------------------------------------------- uri
	/**
	 * Generates the tile image with the right orientation, and returns an URI to this image
	 */
	public function uri()
	{
		$image = Image::createFromFile($this->image);
		if ($this->orientation !== Orientation::NORTH) {
			$image = $image->rotate(Orientation::angle($this->orientation));
		}
		/** @var $session_files Files */
		$session_files          = Session::current()->get(Files::class, true);
		$session_files->files[] = $file = $image->asFile();
		return $file->getTemporaryFileUri();
	}

}
