<?php
namespace Tickleman\ZombicideRocks\Mission\Tile;

use ITRocks\Framework\Locale\Loc;
use ITRocks\Framework\View;
use ITRocks\Framework\View\Html\Builder\Property;
use Tickleman\ZombicideRocks\Mission;
use Tickleman\ZombicideRocks\Mission\Tile;

/**
 * Mission tile map widget : everything to build a map with your mouse
 *
 * @override value @var Tile[]
 * @property Tile[] value
 */
class Map_Widget extends Property
{

	//--------------------------------------------------------------------------------------- FEATURE
	const FEATURE = 'widget';

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

}
