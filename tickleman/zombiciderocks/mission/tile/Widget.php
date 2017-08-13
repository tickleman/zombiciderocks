<?php
namespace Tickleman\ZombicideRocks\Mission\Tile;

use ITRocks\Framework\Dao;
use ITRocks\Framework\Locale\Loc;
use ITRocks\Framework\View;
use ITRocks\Framework\View\Html\Builder\Property;
use Tickleman\ZombicideRocks;
use Tickleman\ZombicideRocks\Mission;
use Tickleman\ZombicideRocks\Mission\Tile;

/**
 * Mission tile map widget : everything to build a map with your mouse
 *
 * @override value @var Tile[]
 * @property Tile[] value
 */
class Widget extends Property
{

	//--------------------------------------------------------------------------------------- FEATURE
	const FEATURE = 'tile_widget';

	//----------------------------------------------------------------------------------------- $grid
	/**
	 * @var Grid
	 */
	public $grid;

	//-------------------------------------------------------------------------------------- $mission
	/**
	 * @var Mission
	 */
	public $mission;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return Loc::tr('!' . count($this->value) . '! tiles');
	}

	//------------------------------------------------------------------------------------- buildHtml
	/**
	 * @return string
	 */
	public function buildHtml()
	{
		$this->mission = $this->template->getParameter(Mission::class);
		$this->grid    = new Grid($this->mission);
		array_unshift($this->parameters, $this);
		return View::run($this->parameters, [], [], get_class($this), static::FEATURE);
	}

	//------------------------------------------------------------------------------------ buildValue
	/**
	 * @param $object        object
	 * @param $null_if_empty boolean
	 * @return Tile[]
	 */
	public function buildValue($object, $null_if_empty)
	{
		$top   = 0;
		$tiles = [];
		foreach (json_decode($this->value) as $row) {
			$left = 0;
			$top ++;
			foreach ($row as $cell) {
				if ($cell) {
					list($code, $orientation) = $cell;
					$left ++;
					$tile              = new Tile();
					$tile->left        = $left;
					$tile->orientation = $orientation;
					$tile->tile        = Dao::searchOne(['code' => $code], ZombicideRocks\Tile::class);
					$tile->top         = $top;
					$tiles[]           = $tile;
				}
			}
		}
		return $tiles;
	}

}
