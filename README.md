# Zombicide Rocks !

The http://zombicide.rocks website source code.

## Install a development environment

- You need MySQL 5.5+, Apache 2.2+ and PHP 7.1+ running as an Apache Module. Look at https://itrocks.org/itrocks-wiki/creer-une-application for a french tutorial about prerequisites.

- Create a loc.php file containing (replace database name and login with yours) :

```php
use ITRocks\Framework\Configuration;
use ITRocks\Framework\Configuration\Environment;
use ITRocks\Framework\Dao\Mysql\Link;

$loc = [
	Configuration::ENVIRONMENT => Environment::DEVELOPMENT,
	Link::class => [
		Link::DATABASE => 'tickleman_zombiciderocks',
		Link::LOGIN    => 'tickleman_zombic'
	]
];
```

- create a pwd.php file containing (replace password with yours) :
```php
<?php
use ITRocks\Framework\Dao\Mysql\Link;

$pwd = [
	Link::class => 'apasswordfordatabase'
];
```

- create your database with MySQL, and give all access to this database to your database user.

- install dependencies :\
```php composer.phar update```

## MIT License

This program and its documentation are released into MIT License :

« Copyright © Baptiste Pillot - baptiste at pillot dot fr

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions :

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

The Software is provided "as is", without warranty of any kind, express or implied, including but not limited to the warranties of merchantability, fitness for a particular purpose and noninfringement. In no event shall the authors or copyright holders be liable for any claim, damages or other liability, whether in an action of contract, tort or otherwise, arising from, out of or in connection with the software or the use or other dealings in the Software. »
