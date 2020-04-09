<?php

namespace Firumon\Makhzun\Middleware;

use Closure;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class HandleTopNavItems
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->segment(2) === 'page'){
            $item = $request->segment(3); $route_name = $request->route()->getName();
            $navs = collect(config("makhzun.page_routes.$item"))
                ->filter(function($item){ return isset($item[4]); })
                ->map(function($item)use($route_name){
                    return ($item[2] === $route_name)
                        ? ((isset($item[6]) && $item[6]) ? self::getSearch($route_name) : false)
                        : self::getMenu($item[2],$item[4],$item[5] ?? '');
                })
                ->filter()
                ->toArray();
            if(!empty($navs)){
                Event::listen(BuildingMenu::class,function(BuildingMenu $event) use($navs){
                    foreach ($navs as $nav) $event->menu->add($nav);
                });
            }
        }
        return $next($request);
    }

    private static $SEARCH_MENU_OPTIONS = ['key' => 'topnav_search', 'search' => true, 'method' => 'GET', 'input_name' => 'search_text', 'text' => 'Search', 'topnav_right' => true];
    private static function getSearch($route){ return array_merge(self::$SEARCH_MENU_OPTIONS,compact('route')); }
    private static function getMenu($route,$text,$icon = ''){ return compact('route','text')+['key' => $route, 'topnav' => true, 'icon' => 'fas fa-fw fa-' . $icon]; }
}
