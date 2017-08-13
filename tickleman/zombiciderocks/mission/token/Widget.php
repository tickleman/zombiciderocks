<?php
namespace Tickleman\ZombicideRocks\Mission\Token;

use ITRocks\Framework\Dao;
use ITRocks\Framework\Locale\Loc;
use ITRocks\Framework\View;
use ITRocks\Framework\View\Html\Builder\Property;
use Tickleman\ZombicideRocks;
use Tickleman\ZombicideRocks\Mission;
use Tickleman\ZombicideRocks\Mission\Token;

/**
 * Mission token map widget : graphical tokens display and value building
 *
 * @override value @var Token[]
 * @property Token[] value
 */
class Widget extends Property
{

	//--------------------------------------------------------------------------------------- FEATURE
	const FEATURE = 'token_widget';

	//-------------------------------------------------------------------------------------- $mission
	/**
	 * @var Mission
	 */
	public $mission;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return Loc::tr('!' . count($this->value) . '! tokens');
	}

	//------------------------------------------------------------------------------------- buildHtml
	/**
	 * @return string
	 */
	public function buildHtml()
	{
		$this->mission = $this->template->getParameter(Mission::class);
		array_unshift($this->parameters, $this);
		return View::run($this->parameters, [], [], get_class($this), static::FEATURE);
	}

	//------------------------------------------------------------------------------------ buildValue
	/**
	 * @param $object        object
	 * @param $null_if_empty boolean
	 * @return Token[]
	 */
	public function buildValue($object, $null_if_empty)
	{
		$tokens = [];
		foreach (json_decode($this->value) as $value) {
			list($code, $left, $top, $orientation) = $value;
			$token              = new Token();
			$token->left        = $left;
			$token->orientation = $orientation;
			$token->token       = Dao::searchOne(['code' => $code], ZombicideRocks\Token::class);
			$token->top         = $top;
			$tokens[]           = $tokens;
		}
		return $tokens;
	}

}
