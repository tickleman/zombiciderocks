<?php
namespace Tickleman\ZombicideRocks;

use ITRocks\Framework\Configuration;
use ITRocks\Framework\Dao\Mysql\File_Logger;
use ITRocks\Framework\Locale;
use ITRocks\Framework\Locale\Language;
use ITRocks\Framework\Locale\Number_Format;
use ITRocks\Framework\Plugin\Priority;
use ITRocks\Framework\View;
use ITRocks\Framework\Widget\Menu;

global $loc;
require __DIR__ . '/../../loc.php';
require __DIR__ . '/../../itrocks/framework/config.php';

$config['Tickleman/ZombicideRocks'] = [
	Configuration::APP         => Application::class,
	Configuration::ENVIRONMENT => $loc[Configuration::ENVIRONMENT],
	Configuration::EXTENDS_APP => 'ITRocks/Framework',

	//------------------------------------------------------------------------------ Priority::NORMAL
	Priority::NORMAL => [
		Application\Routes::class,
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
		File_Logger::class,
		Menu::class => [
			Menu::TITLE => [SL, 'Home', '#main'],
			'Databases' => [
				'/Tickleman/ZombicideRocks/Missions'             => 'Missions',
				'/Tickleman/ZombicideRocks/Boxes'                => 'Boxes',
				'/Tickleman/ZombicideRocks/Tiles'                => 'Tiles',
				'/Tickleman/ZombicideRocks/Tokens'               => 'Tokens',
				'/Tickleman/ZombicideRocks/Card/Equipment_Cards' => 'Equipment cards',
				'/Tickleman/ZombicideRocks/Card/Zombie_Cards'    => 'Zombie cards'
			],
			'Stories' => [
				'/Tickleman/ZombicideRocks/Blog/Entries' => 'Survivors missions blog'
			],
			'Links' => [
				'/Tickleman/ZombicideRocks/Links'      => 'Links to other sites',
				'/Tickleman/ZombicideRocks/Link/Tools' => 'Links to tools'
			]
		],
		View::class => [
			View\Html\Engine::CSS => 'zombicide'
		]
	]
];
