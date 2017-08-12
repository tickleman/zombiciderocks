# Zombicide Rocks !

The [https://zombicide.rocks] website source code.

J'ai découvert ce jeu en mars 2017. Un jeu bac à sables avec des zombies ? Obligé que je craque.

J'enchaîne donc avec la création d'un fansite (de plus) qui me servira de base de données de référence, de wiki et de blog.

## Changelog

14/03/2017 - Je viens à peine de commencer ce site internet, un peu de patience !

16/03/2017 - Design de base, structure de données pour les données de missions, et le [blog des survivants](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Blog/Entries), et un menu

18/03/2017 - Image et tags liés aux [tuiles](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Tiles)

19/03/2017 - Ajout de la section [liens](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Links) et [outils](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Link/Tools)

26/03/2017 - Ajout d'une légende pour les images liées au [blog](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Blog/Entries)

07/05/2017 - Ajout de la section "news" sur la [page d'accueil](https://zombicide.rocks/index)

02/07/2017 - Ajout des textes de [missions](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Missions) : introduction, objectifs, règles spéciales

03/07/2017 - Affichage des [missions](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Missions) sympa avec un design proche de celui du manuel du jeu

09/07/2017 - Affichage du plan dans les [missions](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Missions), structure de donées pour le placement des jetons sur le plan

16/07/2017 - Organisation des données dans le formulaire de création de [mission](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Missions)

26/07/2017 - Editeur de [missions](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Missions) : vue latérale des tuiles des boîtes de jeu, vue de la carte dans l'éditeur

12/08/2017 - Editeur de [misions](https://zombicide.rocks/index/Tickleman/ZombicideRocks/Missions) : glisser-déposer des tuiles, rotations, ajout de lignes et de colonnes sur le plan, favicon pour le site

## Roadmap

- Des bases de données toutes saisons et extensions confondues :

  - une base de données missions permettant des recherches multi-critères pour trouver chaussure à son pied plus rapidement qu'en fouillant une par une les missions disponibles un peu partout,

  - une base de données de toutes les cartes de spawn de zombies,

  - une base de données de toutes les cartes d'équipements,

  - une base de données des survivants,

  - une base de données de toutes les dalles,

  - sûrement d'autres : pions, etc... tout sur Zombicide !

Pour trouver tout ça, j'irais chercher chez ceux qui ont déjà réuni ces données sur le web, et je les rassemblerai ici, sans oublier de les créditer.

Pour maîtriser les règles :

  - une FAQ sous forme de base de données multi-critères, pour tout savoir sur tout. Chaque règle de cette FAQ qui se voudra géante sera accompagnée pour référence d'un lien précis vers sa source, afin que chaque point soit justifié et vérifié avec soin,
 
  - des liens entre les règles qui se contredisent d'une version à l'autre.
  
- Des maps et scénarios créés par les joueurs (moi et mes potes).

- Un éditeur de scénarios le plus simple possible d'utilisation pour faire vos propres scénarios, et les visualiser avec un look similaire au manuel du jeu.

## Install a development environment

- You need MySQL 5.5+, Apache 2.2+ and PHP 7.1+ running as an Apache Module. Look at [https://itrocks.org/wiki/creer-une-application] for a french tutorial about prerequisites.

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

## How did you...

- Create my favicons for all platforms ?
  Turned the biohazard logo black and generated favicons using [http://realfavicongenerator.net/]

## Disclaimer

Je n'ai aucune affiliation avec Edge Entertainement, Cool Mini or Not, le jeu Zombicide. Les noms et marques, le jeu, sont la propriété leurs ayant-droits respectifs. 

## MIT License

This program and its documentation are released into MIT License :

« Copyright © Baptiste Pillot - baptiste at pillot dot fr

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions :

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

The Software is provided "as is", without warranty of any kind, express or implied, including but not limited to the warranties of merchantability, fitness for a particular purpose and noninfringement. In no event shall the authors or copyright holders be liable for any claim, damages or other liability, whether in an action of contract, tort or otherwise, arising from, out of or in connection with the software or the use or other dealings in the Software. »
