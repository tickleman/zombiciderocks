<?php
use ITRocks\Framework\Configuration;
use ITRocks\Framework\Configuration\Environment;
use ITRocks\Framework\Dao\Mysql\Link;

$loc = [
	Configuration::ENVIRONMENT => Environment::DEVELOPMENT,
	Link::class => [
		Link::DATABASE => 'tickleman_zombiciderocks',
		Link::HOST     => 'localhost',
		Link::LOGIN    => 'baptiste.pillot'
	]
];
