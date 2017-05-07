<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Locale\Loc;
use ITRocks\Framework\Tools\Date_Time;

/**
 * A news item
 *
 * @display_order date, title, story
 * @representative date, title
 * @sort -date, title
 */
class News
{

	//----------------------------------------------------------------------------------------- $date
	/**
	 * @default Date_Time::now
	 * @link DateTime
	 * @mandatory
	 * @var Date_Time
	 */
	public $date;

	//---------------------------------------------------------------------------------------- $story
	/**
	 * @max_length 60000
	 * @multiline
	 * @textile
	 * @var string
	 */
	public $story;

	//---------------------------------------------------------------------------------------- $title
	/**
	 * @mandatory
	 * @var string
	 */
	public $title;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->date ? join(SP, [Loc::dateToLocale($this->date), $this->title]) : 'news';
	}

}
