<?php
namespace Tickleman\ZombicideRocks\Box;

use ITRocks\Framework\Mapper\Component;
use Tickleman\ZombicideRocks\Box;
use Tickleman\ZombicideRocks;

/**
 * Box token
 *
 * @display_order box, token, count
 * @set Boxes_Tokens
 * @sort box.name, token.code, token.name
 */
trait Token
{
	use Component;

	//------------------------------------------------------------------------------------------ $box
	/**
	 * @composite
	 * @link Object
	 * @var Box
	 */
	public $box;

	//---------------------------------------------------------------------------------------- $count
	/**
	 * @var integer
	 */
	public $count;

	//---------------------------------------------------------------------------------------- $token
	/**
	 * @composite
	 * @link Object
	 * @var ZombicideRocks\Token
	 */
	public $token;

}
