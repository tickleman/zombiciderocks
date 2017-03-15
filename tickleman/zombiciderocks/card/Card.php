<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Traits\Has_Code;

/**
 * A card for Zombicide
 *
 * @business
 */
abstract class Card
{
	use Has_Code;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->code);
	}

}
