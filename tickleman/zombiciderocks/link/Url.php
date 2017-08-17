<?php
namespace Tickleman\ZombicideRocks\Link;

use ITRocks\Framework\View\Html\Builder\Property;
use ITRocks\Framework\View\Html\Builder\Value_Widget;
use ITRocks\Framework\View\Html\Dom\Anchor;
use ITRocks\Framework\Widget\Edit\Html_Template;

/**
 * URL Widget
 */
class Url extends Property implements Value_Widget
{

	//------------------------------------------------------------------------------------- buildHtml
	/**
	 * @return string
	 */
	public function buildHtml()
	{
		return ($this->template instanceof Html_Template)
			? $this->value
			: strval(new Anchor($this->value, $this->value));
	}

}
