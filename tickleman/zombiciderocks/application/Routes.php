<?php
namespace Tickleman\ZombicideRocks\Application;

use ITRocks\Framework\Controller\Uri;
use ITRocks\Framework\Plugin\Register;
use ITRocks\Framework\Plugin\Registerable;
use ITRocks\Framework\Tools\Paths;
use ITRocks\Framework\User\Authenticate\Controller as Authenticate_Controller;
use ITRocks\Framework\View;
use ITRocks\Framework\View\Html\Template;

/**
 * The Redirect plugin allows articles containing #REDIRECT [Another article title]
 */
class Routes implements Registerable
{

	/** Authentication return URLs from Uri::previous() omit the application base path. */
	public function authenticationReturn(string $uri, &$result) : void
	{
		$path = parse_url($uri, PHP_URL_PATH) ?: $uri;
		if (preg_match('~^/membre/(authenticate|disconnect|login)(?:/|$)~', $path)) {
			$result = '/';
		}
	}

	//---------------------------------------------------------------------------------------- ROUTES
	const ROUTES = [
		'/ITRocks/Framework/User/(.*)'                      => '/membre/$1',
		'/ITRocks/Framework/Users'                          => '/membres',
		'/ITRocks/Framework/Users/dataList(.*)'             => '/membres$1',
		// Resolve the blog list before individual entries. dataList was renamed to list.
		'/Tickleman/ZombicideRocks/Blog/Blog_Entries/list'         => '/blog',
		'/Tickleman/ZombicideRocks/Blog/Blog_Entries/list(.*)'     => '/blog/list$1',
		'/Tickleman/ZombicideRocks/Blog/Entry/(.*)'                => '/blog/$1',
		'/Tickleman/ZombicideRocks/Blog/Blog_Entries/dataList(.*)' => '/blog$1',
		'/Tickleman/ZombicideRocks/Blog/Entries'                   => '/blog',
		'/Tickleman/ZombicideRocks/Blog/Entries/dataList(.*)'      => '/blog$1',
		'/Tickleman/ZombicideRocks/Box/(.*)'                       => '/boite/$1',
		'/Tickleman/ZombicideRocks/Boxes'                          => '/boites',
		'/Tickleman/ZombicideRocks/Boxes/dataList(.*)'             => '/boites$1',
		'/Tickleman/ZombicideRocks/Campaign/(.*)'                  => '/campagne/$1',
		'/Tickleman/ZombicideRocks/Campaigns'                      => '/campagnes',
		'/Tickleman/ZombicideRocks/Campaigns/dataList(.*)'         => '/campagnes$1',
		'/Tickleman/ZombicideRocks/Token/(.*)'                     => '/jeton/$1',
		'/Tickleman/ZombicideRocks/Tokens'                         => '/jetons',
		'/Tickleman/ZombicideRocks/Tokens/dataList(.*)'            => '/jetons$1',
		// author before mission, because conflict
		'/Tickleman/ZombicideRocks/Mission/Author/(.*)'            => '/auteur/$1',
		'/Tickleman/ZombicideRocks/Mission/Authors'                => '/auteurs',
		'/Tickleman/ZombicideRocks/Mission/Author/dataList(.*)'    => '/auteurs$1',
		'/Tickleman/ZombicideRocks/Mission/(.*)'                   => '/mission/$1',
		'/Tickleman/ZombicideRocks/Missions'                       => '/missions',
		'/Tickleman/ZombicideRocks/Missions/dataList(.*)'          => '/missions$1',
		// tag before tile, because conflict
		'/Tickleman/ZombicideRocks/Tile/Tag/(.*)'                  => '/tag/$1',
		'/Tickleman/ZombicideRocks/Tile/Tags'                      => '/tags',
		'/Tickleman/ZombicideRocks/Tile/Tags/dataList(.*)'         => '/tags$1',
		'/Tickleman/ZombicideRocks/Tile/(.*)'                      => '/tuile/$1',
		'/Tickleman/ZombicideRocks/Tiles'                          => '/tuiles',
		'/Tickleman/ZombicideRocks/Tiles/dataList(.*)'             => '/tuiles$1',
		// tools before links, because conflict
		'/Tickleman/ZombicideRocks/Link/Tool/(.*)'                 => '/outil/$1',
		'/Tickleman/ZombicideRocks/Link/Tools'                     => '/outils',
		'/Tickleman/ZombicideRocks/Link/Tools/dataList(.*)'        => '/outils$1',
		'/Tickleman/ZombicideRocks/Link/(.*)'                      => '/lien/$1',
		'/Tickleman/ZombicideRocks/Links'                          => '/liens',
		'/Tickleman/ZombicideRocks/Links/dataList(.*)'             => '/liens$1',
		'/Tickleman/ZombicideRocks/Member/(.*)'                    => '/membre/$1',
		'/Tickleman/ZombicideRocks/Members'                        => '/membres',
		'/Tickleman/ZombicideRocks/Members/dataList(.*)'           => '/membres$1'
	];

	//----------------------------------------------------------------------------------- linkToRoute
	/**
	 * @param $result string The 'native' URI to transform into a route
	 */
	public function linkToRoute(&$result)
	{
		foreach (static::ROUTES as $link => $route) {
			$link = Paths::$uri_base . $link;
			if (preg_match('~' . $link . '$~', $result)) {
				$uri_base = lParse(Paths::$uri_base, '/index');
				$result   = preg_replace('~' . $link . '$~', $uri_base . $route, $result);
				break;
			}
		}
	}

	//-------------------------------------------------------------------------------------- register
	/**
	 * Registration code: thread of #REDIRECT
	 *
	 * @param $register Register
	 */
	public function register(Register $register) : void
	{
		$register->aop->afterMethod(
			[Authenticate_Controller::class, 'reserved'], [$this, 'authenticationReturn']
		);
		$register->aop->afterMethod ([View::class, 'link'], [$this, 'linkToRoute']);
		$register->aop->afterMethod ([Template::class, 'replaceLink'], [$this, 'linkToRoute']);
		$register->aop->beforeMethod([Uri::class, '__construct'],      [$this, 'routeToUri']);
	}

	//------------------------------------------------------------------------------------ routeToUri
	/**
	 * @param $uri string The route URI to transform into a 'native' URI
	 */
	public function routeToUri(&$uri)
	{
		foreach (static::ROUTES as $link => $route) {
			$route_match = preg_replace('~\$[0-9]+~', '(.*)', $route);
			if (preg_match('~^' . $route_match . '$~', $uri)) {
				$replace_count = 0;
				$start         = strpos($link, '(');
				while ($start !== false) {
					$replace_count ++;
					$stop  = strpos($link, ')', $start);
					$link  = substr($link, 0, $start) . '$' . $replace_count . substr($link, $stop + 1);
					$start = strpos($link, '(', $start + strlen($replace_count) + 1);
				}
				$uri = preg_replace('~^' . $route_match . '$~', $link, $uri);
			}
		}
	}

}
