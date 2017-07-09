<?php
namespace Tickleman\ZombicideRocks;

/**
 * Stores a link
 *
 * @display_order title, url, description
 * @list title, url
 * @representative title
 * @sort title
 */
class Link
{

	//---------------------------------------------------------------------------------- $description
	/**
	 * @max_length 65535
	 * @multiline
	 * @var string
	 */
	public $description;

	//---------------------------------------------------------------------------------------- $title
	/**
	 * @var string
	 */
	public $title;

	//------------------------------------------------------------------------------------------ $url
	/**
	 * @var string
	 */
	public $url;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->title);
	}

}
