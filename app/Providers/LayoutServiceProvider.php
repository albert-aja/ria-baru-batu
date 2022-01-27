<?php

namespace App\Providers;

use App\Models\Config\Menu as ConfigMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Spatie\Menu\Laravel\Facades\Menu;
use Spatie\Menu\Laravel\Html;

class LayoutServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Menu::macro('main', function ($controller) {
            $role_id = Auth::user()->getRoleId();
            $menu_items = ConfigMenu::where('role', '=', $role_id)->orderBy('created_at', 'asc')->get();
            Session::put('activecontroller', $controller);

            return Menu::build($menu_items, function ($menu, $menu_item) {

                $menu->setAttribute('data-widget', 'tree')
                    ->addClass('sidebar-menu')
                    ->add(
                        Html::raw('<a href="' . (config('app.url')) . '/' . $menu_item->link . '"><i class="' . $menu_item->icon . '"></i> <span>' . $menu_item->judul . '</span></a>')
                            ->addParentClass(($menu_item->source == Session::get('activecontroller') ? 'active' : '')));
            });
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app('view')->composer('layouts.app', function ($view) {
            $action = app('request')->route()->getAction();
            $identifier = explode('Controllers\\' . str_replace(' ', '', Auth::user()->getRoleNames()->first()), $action['controller']);
            $identifier = $identifier[1];
            $identifier = Str::of($identifier)->ltrim('\\');
            $menus = ConfigMenu::withCount('get_child')->where('role', Auth::user()->getRoleId()->first())->whereNull('parent')->orderBy('created_at', 'asc')->get();

            //$controller = class_basename($action['controller']);

            list($controller, $action) = explode('@', $identifier);
            $active_menu = ConfigMenu::where('source', '=', $controller)->first();

            if ($controller == 'Profil') {
                $page_title = 'Profil';
                $page_icon = 'far fa-user';
            } else {
                $page_title = (!is_null($active_menu) ? $active_menu->judul : '');
                $page_icon = (!is_null($active_menu) ? $active_menu->icon : '');
            }

            $view->with(compact('controller', 'action', 'page_title', 'page_icon', 'menus'));
        });
    }
}
