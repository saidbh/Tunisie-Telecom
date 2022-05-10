<?php

namespace App\Http\Middleware;

use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lavary\Menu\Facade as Menu;

class GenerateMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Menu::make('MyNavBar', function ($menu) {


            $authMenu = $this->generateAuthMenu();

            foreach ($authMenu as $categories) {
                if ($categories["submenu"] == null) {
                    $menu->add('<span>' . $categories["title"] . '</span>', ['class' => $categories["link"], 'route' => $categories["link"]])
                        ->prepend('<i class="' . $categories["icon"] . '"></i>')
                        ->active($categories["link"] . '/*')
                        ->link->attr(['class' => 'iq-waves-effect']);
                    /* ->href('/'.$categories["link"]); */
                } else {
                    $menu->add('<span>' . $categories["title"] . '</span>', ['class' => $categories["link"]])
                        ->prepend('<i class="' . $categories["icon"] . '"></i>')
                        ->nickname($categories["link"])
                        ->link->attr(["class" => "nav-link iq-waves-effect"])
                        ->href('#' . $categories["link"]);
                    foreach ($categories["submenu"] as $subCategories) {
                        $menu->get($categories["link"])
                            ->add('<span>' . $subCategories["title"] . '</span>', ['route' => $subCategories["link"]])
                            ->active($subCategories["link"])
                            ->link->attr(['class' => '']);
                    }
                }
            }
        });
        return $next($request);
    }
    private function generateAuthMenu()
    {
        $menu = array();

        if (!Auth::check()) return $menu = [];

        if (User::where('id', Auth::id())->first()->userRole == null) return $menu = [];

        $accesses  = User::where('id', Auth::id())->first()->userRole->role->access;

        foreach ($accesses as $access) {

            $permissions = User::where("id", Auth::id())->first()->userRole->role->permissions;

            $submenu = array();

            foreach ($permissions as $permission) {

                $subcat = SubCategories::select("title", "link", "icon", "categories_id")->where("id", $permission->sub_categories_id)->first();

                if ($subcat->categories_id === $access->categories_id) {
                    array_push($submenu, [
                        "title" => $subcat->title,
                        "link" => $subcat->link,
                        "icon" => $subcat->icon,
                    ]);
                };
            }

            $category = Categories::select("title", "link", "icon")->where("id", $access->categories_id)->first();

            array_push($menu, [
                "title" => $category->title,
                "link" => $category->link,
                "icon" => $category->icon,
                "submenu" => ($submenu != []) ? $submenu : null,
            ]);
        }

        return $menu;
    }
}
