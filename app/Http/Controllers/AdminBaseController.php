<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AdminBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $name = Route::currentRouteName();

        App::setLocale('ar');
        $menuOpened = '';
        $menuSubOpened = '';
        $cms_page_name = '';

        switch ($name) {
            case Str::contains($name, 'settings'):
                $menuOpened = "settingsMenu";
                break;
            case Str::contains($name, 'cms'):
                $menuOpened = "cmsMenu";
                break;
            case Str::contains($name, 'news'):
                $menuOpened = "blogNewsMenu";
                break;
            case Str::contains($name, 'articles'):
                $menuOpened = "blogArticlesMenu";
                break;
        }

        if ($menuOpened == "cmsMenu") {
            $cms_page_name = request()->route()->parameter('page_name');
            if ($cms_page_name == "main_page_subscriptions") {
                $menuOpened = "admin.subs";
            }
        }

        $totalContactNewMsgs = DB::table('contact_us')
            ->where('isread', false)
            ->count();


        // dd($contains);
        View::share([
            'totalContactNewMsgs' => $totalContactNewMsgs,
            'currentRoute' => $name,
            'cms_page_name' => $cms_page_name,
            'menuOpened' => $menuOpened,
            'menuSubOpened' => $menuSubOpened,
            'menuOpenedClasses' => 'menu-item-here menu-item-open'
        ]);
    }

    public function reNamePermissions($permissions)
    {
        $permissions = $permissions->map(function ($item, $key) {
            $item->name = __('main.admin.' . $item->id);
            return $item;
        });

        return $permissions;
    }
}
