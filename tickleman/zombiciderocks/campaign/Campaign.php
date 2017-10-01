<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Traits\Has_Name;
use Tickleman\ZombicideRocks\Campaign\Campaign_Mission;

/**
 * A campaign is an ordered group of missions
 *
 * @display_order name, missions
 */
class Campaign
{
	use Has_Name;

	//------------------------------------------------------------------------------------- $missions
	/**
	 * @link Collection
	 * @var Campaign_Mission[]
	 */
	public $missions;

}
