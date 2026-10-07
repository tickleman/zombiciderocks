# Zombicide Rocks !

The [https://zombicide.rocks] website source code.

J'ai découvert ce jeu en mars 2017. Un jeu bac à sables avec des zombies ? Obligé que je craque.

J'enchaîne donc avec la création d'un fansite (de plus) qui me servira de base de données de référence, de wiki et de blog.

## Changelog

07/10/2026 - Réouverture du site, migration vers PHP 8.1 et le framework it.rocks 0.2.2303

08/10/2017 - Fiches de [missions](https://zombicide.rocks/missions) : affichage du nombre maximum de survivants, de la campagne associée et du matériel nécessaire, numérotation des objectifs, présentation sur deux colonnes sur les grands écrans

06/10/2017 - Éditeur de [missions](https://zombicide.rocks/missions) : affichage du code de chaque tuile dans le menu du matériel

01/10/2017 - Ajout des campagnes, du nombre maximum de survivants, range correctement les liens de mission, saisie de nouvelles missions issues du Compendium #2

24/08/2017 - Révision les URI pour qu'elles soient plus compactes, Ctrl+click sur une liste modifiable pour avoir une fenêtre popup

13/08/2017 - Editeur de [missions](https://zombicide.rocks/missions) : sauvegarde de la disposition des tuiles

12/08/2017 - Editeur de [missions](https://zombicide.rocks/missions) : glisser-déposer des tuiles, rotations, ajout de lignes et de colonnes sur le plan, favicon pour le site

26/07/2017 - Editeur de [missions](https://zombicide.rocks/missions) : vue latérale des tuiles des boîtes de jeu, vue de la carte dans l'éditeur

16/07/2017 - Organisation des données dans le formulaire de création de [mission](https://zombicide.rocks/missions)

09/07/2017 - Affichage du plan dans les [missions](https://zombicide.rocks/missions), structure de donées pour le placement des jetons sur le plan

03/07/2017 - Affichage des [missions](https://zombicide.rocks/missions) sympa avec un design proche de celui du manuel du jeu

02/07/2017 - Ajout des textes de [missions](https://zombicide.rocks/missions) : introduction, objectifs, règles spéciales

07/05/2017 - Ajout de la section "news" sur la [page d'accueil](https://zombicide.rocks)

26/03/2017 - Ajout d'une légende pour les images liées au [blog](https://zombicide.rocks/blog)

19/03/2017 - Ajout de la section [liens](https://zombicide.rocks/liens) et [outils](https://zombicide.rocks/outils)

18/03/2017 - Image et tags liés aux [tuiles](https://zombicide.rocks/tuiles)

16/03/2017 - Design de base, structure de données pour les données de missions, et le [blog des survivants](https://zombicide.rocks/blog), et un menu

14/03/2017 - Début du projet site

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

- You need MySQL 5.5+, Apache 2.2+ and PHP 8.1+ with the GD extension running as an Apache Module. Look at [https://itrocks.org/wiki/creer-une-application] for a french tutorial about prerequisites.

- Copy the development configuration to the project root :

```sh
cp environment/loc.dev.php loc.php
cp environment/pwd.blank.php pwd.php
```

- Adjust the database name, host and login in `loc.php`, and fill in the database password in `pwd.php`. These two local files are ignored by Git. The versioned templates in `environment/` must contain no passwords.

- create your database with MySQL, and give all access to this database to your database user.

- install dependencies :\
```php composer.phar update```

## Deploy to production

The `environment/` directory contains the development and production configurations. The framework reads `loc.php` and `pwd.php` from the project root.

```sh
cp environment/loc.prod.php loc.php
```

Adjust the database settings in `loc.php` for the server. Verify contained values before deployment.

On the first installation only, copy `environment/pwd.blank.php` to `pwd.php` and fill in the password. Preserve the existing `pwd.php` on subsequent deployments.

After installing the code and selecting or changing the environment, request a framework cache update :

```sh
touch update
```

## How did you...

- Create my favicons for all platforms ?
  Turned the biohazard logo black and generated favicons using [realfavicongenerator](http://realfavicongenerator.net/).

## Disclaimer

Je n'ai aucune affiliation avec Edge Entertainement, Cool Mini or Not, le jeu Zombicide. Les noms et marques, le jeu, sont la propriété leurs ayant-droits respectifs.

## MIT License

This program and its documentation are released into MIT License :

« Copyright © Baptiste Pillot - baptiste at pillot dot fr

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions :

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

The Software is provided "as is", without warranty of any kind, express or implied, including but not limited to the warranties of merchantability, fitness for a particular purpose and noninfringement. In no event shall the authors or copyright holders be liable for any claim, damages or other liability, whether in an action of contract, tort or otherwise, arising from, out of or in connection with the software or the use or other dealings in the Software. »
