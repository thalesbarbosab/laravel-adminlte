<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Paginator::useBootstrap();

        $events->listen(BuildingMenu::class, function (BuildingMenu $event ) {
            $items = app(Menu::class)::where('actived',true)->get()->map(function(Menu $menu){
                return [
                    'key'    =>  'menu-'.$menu['id'],
                    'text'   =>  $menu['description'],
                    'route'  =>  ['menu',['id'=>$menu['id']]],
                    'active' =>  ['menu/'.$menu['id'].'/*'],
                    'icon'   =>  $menu['icon'],
                ];
            });
            $event->menu->addIn('dynamic_menus',
                ...$items
            );
        });
    }
}
