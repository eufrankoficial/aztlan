<?php

namespace App\Services\Auth;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthService
{

    public function __construct()
    {

    }


    function authenticate(array $credentials, bool $rememberToken): bool
    {
        $authenticad = Auth::attempt($credentials, $rememberToken);
        return $authenticad;
    }

    function cacheConfigsUser()
    {
        $user = current_user();
        $key = Str::random();

        Cache::forget('key_'.$user->id);
        Cache::rememberForever('key_'.$user->id, function() use ($key) {
            return $key;
        });

        Cache::rememberForever('menus_'.$key, function() use ($user) {
            if($user->isSuperAdmin()) {
                return Menu::with(['parents'])->get();
            }

            $menus = $user->group->map(function($group)  {
                return $group->menus->map(function($menu) {
                    return $menu;
                });
            });

            $menusids = collect([]);
            $menus->map(function($menu) use (&$menusids){
                $menu->map(function($menu) use (&$menusids) {
                    $menusids[] = $menu->id;
                });
            });

            $menusids = $menusids->toArray();

            if(count($menusids) > 0) {
                return Menu::with(['parents' => function($query) use ($menusids){
                    $query->whereIn('id', $menusids);
                }])->where('parent_id', null)
                    ->get();
            }

            return collect([]);
        });
    }

    function logout(): void
    {
        Auth::logout();
    }
}
