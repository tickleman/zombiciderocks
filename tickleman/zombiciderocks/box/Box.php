<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Traits\Has_Name;

/**
 * A material box for Zombicide
 *
 * @business
 * @set Boxes
 */
class Box
{
	use Has_Name;

	//---------------------------------------------------------------------------------------- $tiles
	/**
	 * @link Collection
	 * @var Tile[]
	 */
	public $tiles;

	//--------------------------------------------------------------------------------------- $tokens
	/**
	 * @link Collection
	 * @var Box\Box_Token[]
	 */
	public $tokens;

}
