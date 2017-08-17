<?php
namespace Tickleman\ZombicideRocks;

use /** @noinspection PhpUnusedAliasInspection $url @widget */ Tickleman\ZombicideRocks\Link\Url;
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
	 * @widget Url
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
