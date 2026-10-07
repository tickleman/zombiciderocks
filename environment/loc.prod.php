<?php
use ITRocks\Framework\Configuration;
use ITRocks\Framework\Configuration\Environment;
use ITRocks\Framework\Dao\Mysql\Link;

$loc = [
	Configuration::ENVIRONMENT => Environment::PRODUCTION,
	Link::class => [
		Link::DATABASE => 'zombicide_crafter',
		Link::HOST     => 'localhost',
		Link::LOGIN    => 'zombicide_crafter'
	]
];
