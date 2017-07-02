<?php
namespace Tickleman\ZombicideRocks\Mission;

use ITRocks\Framework\Mapper\Component;
use ITRocks\Framework\Tools\Has_Ordering;
use Tickleman\ZombicideRocks\Mission;

/**
 * A paragraph into the description of a mission
 *
 * @display_order title, description
 * @representative title
 */
trait Paragraph
{
	use Component;
	use Has_Ordering;

	//---------------------------------------------------------------------------------- $description
	/**
	 * @max_length 65535
	 * @multiline
	 * @var string
	 */
	public $description;

	//-------------------------------------------------------------------------------------- $mission
	/**
	 * @composite
	 * @link Object
	 * @var Mission
	 */
	public $mission;

	//---------------------------------------------------------------------------------------- $title
	/**
	 * @var string
	 */
	public $title;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->title);
	}

}
