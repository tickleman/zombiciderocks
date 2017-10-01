<?php
namespace Tickleman\ZombicideRocks\Campaign;

use ITRocks\Framework\Mapper\Component;
use ITRocks\Framework\Tools\Has_Ordering;
use Tickleman\ZombicideRocks\Campaign;
use Tickleman\ZombicideRocks\Mission;

/**
 * Mission linked to a campaign, with ordering
 */
class Campaign_Mission
{
	use Component;
	use Has_Ordering;

	//------------------------------------------------------------------------------------- $campaign
	/**
	 * @composite
	 * @link Object
	 * @var Campaign
	 */
	public $campaign;

	//-------------------------------------------------------------------------------------- $mission
	/**
	 * @link Object
	 * @mandatory
	 * @var Mission
	 */
	public $mission;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->mission);
	}

}
