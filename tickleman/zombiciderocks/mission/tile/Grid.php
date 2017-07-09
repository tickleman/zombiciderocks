<?php
namespace Tickleman\ZombicideRocks\Mission\Tile;

use ITRocks\Framework\Tools\Image;
use Tickleman\ZombicideRocks\Mission;
use Tickleman\ZombicideRocks\Mission\Orientation;
use Tickleman\ZombicideRocks\Mission\Tile;

/**
 * Two-dimensional grid representation of tiles
 */
class Grid
{

	//--------------------------------------------------------------------------------------- $height
	/**
	 * @getter
	 * @var integer
	 */
	public $height;

	//-------------------------------------------------------------------------------------- $mission
	/**
	 * @mandatory
	 * @var Mission
	 */
	public $mission;

	//---------------------------------------------------------------------------------------- $width
	/**
	 * @getter
	 * @var integer
	 */
	public $width;

	//----------------------------------------------------------------------------------- __construct
	/**
	 * @param $mission Mission
	 */
	public function __construct(Mission $mission = null)
	{
		if (isset($mission)) {
			$this->mission = $mission;
		}
	}

	//------------------------------------------------------------------------------------ dimensions
	/**
	 * @return integer[] [0 => $width, 1 => $height]
	 */
	protected function dimensions()
	{
		$height = 0;
		$width  = 0;
		foreach ($this->mission->tiles as $tile) {
			$height = max($height, $tile->top);
			$width  = max($width,  $tile->left);
		}
		$this->height = $height;
		$this->width  = $width;
		return [$width, $height];
	}

	//------------------------------------------------------------------------------------- getHeight
	/**
	 * @return integer
	 */
	protected function getHeight()
	{
		if (!isset($this->height)) {
			$this->height = 0;
			foreach ($this->mission->tiles as $tile) {
				$this->height = max($this->height, $tile->top);
			}
		}
		return $this->height;
	}

	//-------------------------------------------------------------------------------------- getWidth
	/**
	 * @return integer
	 */
	protected function getWidth()
	{
		if (!isset($this->width)) {
			$this->width = 0;
			foreach ($this->mission->tiles as $tile) {
				$this->width = max($this->width, $tile->left);
			}
		}
		return $this->width;
	}

	//-------------------------------------------------------------------------------------- initGrid
	/**
	 * @return array null[1..height][1..width]
	 */
	protected function initGrid()
	{
		list($width, $height) = $this->dimensions();
		return ($height && $width) ? array_fill(0, $height - 1, array_fill(0, $width - 1, null)) : [];
	}

	//---------------------------------------------------------------------------------------- toGrid
	/**
	 * @return array Tile[integer $row][integer $column] dimensions are 0..n
	 */
	public function toGrid()
	{
		$grid = $this->initGrid();
		foreach ($this->mission->tiles as $tile) {
			$grid[$tile->top - 1][$tile->left - 1] = $tile;
		}
		return $grid;
	}

	//--------------------------------------------------------------------------------------- toImage
	/**
	 * @return Image|null Is null if there are no tiles
	 */
	public function toImage()
	{
		$grid = $this->toGrid();
		if ($grid) {
			/** @var $tile Tile */
			$tile       = $grid[0][0];
			$tile_image = Image::createFromFile($tile->image);
			$image      = $tile_image->newImageKeepsAlpha(
				$this->width  * $tile_image->width,
				$this->height * $tile_image->height
			);
			foreach ($grid as $top => $row) {
				foreach ($row as $left => $tile) {
					if ($left || $top) {
						$tile_image = Image::createFromFile($tile->image);
					}
					$tile_image = $tile_image->rotate(Orientation::angle($tile->orientation));
					$image->paste($tile_image, $left * $tile_image->width, $top * $tile_image->height);
				}
			}
			return $image;
		}
		return null;
	}

}
