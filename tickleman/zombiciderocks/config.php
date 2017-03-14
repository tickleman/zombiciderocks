<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Configuration;
use ITRocks\Framework\Locale;
use ITRocks\Framework\Locale\Language;
use ITRocks\Framework\Locale\Number_Format;
use ITRocks\Framework\Plugin\Priority;
use ITRocks\Framework\View;

global $loc;
require __DIR__ . '/../../loc.php';
require __DIR__ . '/../../itrocks/framework/config.php';

$config['Tickleman/ZombicideRocks'] = [
	Configuration::APP         => Application::class,
	Configuration::ENVIRONMENT => $loc[Configuration::ENVIRONMENT],
	Configuration::EXTENDS_APP => 'ITRocks/Framework',

	//------------------------------------------------------------------------------ Priority::NORMAL
	Priority::NORMAL => [
		Locale::class => [
			Locale::DATE     => 'd/m/Y',
			Locale::LANGUAGE => Language::FR,
			Locale::NUMBER   => [
				Number_Format::DECIMAL_MINIMAL_COUNT => 2,
				Number_Format::DECIMAL_MAXIMAL_COUNT => 4,
				Number_Format::DECIMAL_SEPARATOR     => ',',
				Number_Format::THOUSAND_SEPARATOR    => SP
			]
		],
		View::class => [
			View\Html\Engine::CSS => 'zombicide'
		]
	]
];
