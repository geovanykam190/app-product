<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Models\Menu;
use App\Models\PermissionProfile;
use Closure;
use Auth;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->authenticate($request, $guards) === 'authentication_error') {
            return response()->json(['error'=>'Unauthorized']);
        }

        if (auth()->user()->id != 1)
        {
            $menuUser = PermissionProfile::with("menus")->where('profile_id', "=", auth()->user()->profile_id)->get();
            $inIds    = array();
       
            foreach($menuUser AS $mu)
            {  
                $inIds[] = $mu->menu_id;
    
                if ($mu->menus && $mu->menus->menu_id)
                    $inIds[] = $mu->menus->menu_id;

            }
      
            $allMenus = Menu::whereNull('menu_id')
                                ->where(function($query) use($inIds)
            {
                $query->whereIn('id', $inIds)->orWhereNotNull('header');

            })->orderBy('order')->get();

            foreach($allMenus AS $k => $father) 
            {
                $allMenus[$k]['submenu']   = Menu::where('menu_id', $father->id)->whereIn('id', $inIds)->orderBy('order')->get();
            }
            
        } else {

            $allMenus = Menu::whereNull('menu_id')->orderBy('order')->get();

            foreach($allMenus AS $k => $father) 
            {
                $allMenus[$k]['submenu']   = Menu::where('menu_id', $father->id)->orderBy('order')->get();
            }
        }

    
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) use ($allMenus) {

            // Add some items to the menu...
            foreach($allMenus AS $menu)
            {
                // Se houver Header
                if ($menu->header)
                    $event->menu->add($menu->header);

                // Se houver submenus
                if ($menu->link === "#")
                {
                    $submenu = array();

                    foreach($menu->submenu AS $k => $subs)
                    {
                        $submenu[$k]['text'] = $subs->name;
                        $submenu[$k]['url']  = $subs->link;
                        $submenu[$k]['icon'] = $subs->icon;
                        $submenu[$k]['classes'] = trim(str_replace(" ", "", $subs->name));
                    } 

                    $event->menu->add([
                        'text'      => 'multilevel',
                        'icon'      => 'fas fa-fw fa-share',
                        'submenu'   => $submenu
                    ]); 

                } else {

                    $event->menu->add([
                        'text'  => $menu->name,
                        'url'   => $menu->link,
                        'icon'  => $menu->icon,
                        'classes'  => trim(str_replace(" ", "", $menu->name))
                    ]); 

                }

            }
    
            
        });

        return $next($request);
    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
