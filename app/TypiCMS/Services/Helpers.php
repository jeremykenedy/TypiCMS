<?php namespace TypiCMS\Services;

use DB;
use Route;
use Sentry;
use Config;
use Request;

class Helpers {
	
	public function __construct()
	{
	}

	/**
	 * I have slug, give me id.
	 *
	 * @param string $module
	 * @param string $slug
	 * @return integer
	 */
	public static function getIdFromSlug($module = null, $slug = null)
	{
		if ( ! $module or ! $slug) return false;

		$moduleSingular = str_singular($module);

		return DB::table($module)
				->join($moduleSingular.'_translations', $module.'.id', '=', $moduleSingular.'_translations.'.$moduleSingular.'_id')
				->where('slug', $slug)
				->remember(10)
				->pluck($module.'.id');
	}


	/**
	 * I have id, give me slugs.
	 *
	 * @param string $module
	 * @param int    $id
	 * @return Array
	 */
	public static function getSlugsFromId($module = null, $id = null)
	{
		if ( ! $module or ! $id) return false;

		$moduleSingular = str_singular($module);

		return DB::table($module)
				->join($moduleSingular.'_translations', $module.'.id', '=', $moduleSingular.'_translations.'.$moduleSingular.'_id')
				->where($module.'.id', $id)
				->where($moduleSingular.'_translations.status', 1)
				->remember(10)
				->lists('slug', 'locale');
	}


	/**
	 * Give me the default page id.
	 *
	 * @return integer
	 */
	public static function getHomepageId()
	{
		return DB::table('pages')
				->where('is_home', 1)
				->remember(10)
				->pluck('id');
	}


	/**
	 * Get admin url from current page.
	 *
	 * @return String
	 */
	public static function getAdminUrl()
	{
		$routeArray = explode('.', Route::current()->getName());

		$module = isset($routeArray[1]) ? $routeArray[1] : 'pages' ;

		switch (count($routeArray)) {
			case 1: // ex. root - en
				$id = Helpers::getHomepageId();
				if ( ! $id or $routeArray[0] == 'root') {
					$routeName = 'dashboard';
					$route = route($routeName);
				} else {
					$routeName = 'admin.' . $module . '.edit';
					$route = route($routeName, $id);
				}
				break;
			
			case 2: // ex. en.news
				$routeName = 'admin.' . $module . '.index';
				$route = route($routeName);
				break;
			
			default: // ex. en.pages.1 - en.news.slug - en.projects.categories(.slug)
				if (end($routeArray) == 'categories') {
					$routeName = 'admin.' . $module . '.index';
					$route = route($routeName);
				} else {
					$id = end($routeArray);
					if (end($routeArray) == 'slug') {
						$segments = Request::segments();
						$slug = end($segments);
						$id = Helpers::getIdFromSlug($module, $slug);
					}
					$routeName = 'admin.' . $module . '.edit';
					$route = route($routeName, $id);
				}
				break;
			
		}

		if (Sentry::getUser()->hasAccess($routeName)) {
			if (in_array($routeArray[0], Config::get('app.locales'))) {
				$route .= '?locale='.$routeArray[0];
			}
			return $route;
		}

		return route('dashboard');

	}


	/**
	 * Get public url from current page.
	 *
	 * @return String
	 */
	public static function getPublicUrl()
	{
		$segments = Request::segments();
		array_shift($segments);
		$lang = Config::get('app.locale');
		
		switch (count($segments)) {
			case 0:
				return '';
				break;

			case 1:
				try {
					return route($lang.'.'.$segments[0]);
				} catch (\InvalidArgumentException $e) {
					return route($lang);
				}
				break;

			default:
				try {
					return route($lang.'.'.$segments[0].'.'.$segments[1]);
				} catch (\InvalidArgumentException $e) {
					try {
						return route($lang.'.'.$segments[0]);
					} catch (\InvalidArgumentException $e) {
						return route($lang);
					}
				}
				break;
		}
	}

}
