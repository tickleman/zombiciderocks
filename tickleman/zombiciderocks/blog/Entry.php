<?php
namespace Tickleman\ZombicideRocks\Blog;

use ITRocks\Framework\Locale\Loc;
use ITRocks\Framework\Tools\Date_Time;
use ITRocks\Framework\User;
use Tickleman\ZombicideRocks\Mission;

/**
 * Zombicide missions blog entry
 *
 * @display_order title, mission, date, user, players_count, survivors_count, duration
 * @representative user.login, title
 * @set Blog_Entries
 */
class Entry
{

	//----------------------------------------------------------------------------------------- $date
	/**
	 * @default Date_Time::now
	 * @link DateTime
	 * @mandatory
	 * @var Date_Time
	 */
	public $date;

	//------------------------------------------------------------------------------------- $duration
	/**
	 * @null
	 * @var integer
	 */
	public $duration;

	//--------------------------------------------------------------------------------------- $images
	/**
	 * @link Collection
	 * @var Image[]
	 */
	public $images;

	//-------------------------------------------------------------------------------------- $mission
	/**
	 * @link Object
	 * @mandatory
	 * @representative code, title
	 * @setter setMission
	 * @var Mission
	 */
	public $mission;

	//-------------------------------------------------------------------------------- $players_count
	/**
	 * @mandatory
	 * @var integer
	 */
	public $players_count;

	//---------------------------------------------------------------------------------------- $story
	/**
	 * @max_length 1000000
	 * @multiline
	 * @var string
	 */
	public $story;

	//------------------------------------------------------------------------------ $survivors_count
	/**
	 * @mandatory
	 * @var integer
	 */
	public $survivors_count;

	//---------------------------------------------------------------------------------------- $title
	/**
	 * @mandatory
	 * @var string
	 */
	public $title;

	//----------------------------------------------------------------------------------------- $user
	/**
	 * @link Object
	 * @mandatory
	 * @var User
	 */
	public $user;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return Loc::dateToLocale($this->date) . $this->title ? (SP . $this->title) : '';
	}

	//------------------------------------------------------------------------------------ setMission
	/**
	 * @param $mission Mission
	 */
	protected function setMission(Mission $mission = null)
	{
		$this->mission = $mission;
		if ($mission) {
			if (!$this->survivors_count) {
				$this->survivors_count = $this->mission->survivors_count;
			}
			if (!$this->title) {
				$this->title = $this->mission->title;
			}
		}
	}

}
