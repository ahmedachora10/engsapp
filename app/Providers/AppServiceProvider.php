<?php

namespace App\Providers;

use App\Models\WebsiteContentModel;
use App\Models\WebsiteLinksModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        //
        // fixing a problem on server older verison of mysql
        Schema::defaultStringLength(125);


        Paginator::useBootstrap();

        $footer_data = WebsiteContentModel::where([
            'page_name' => 'all_website',
            'section_name' => 'footer',
            'paragraph_name' => 'footer_para'
        ])->first();
        // dd($footer_data);
        View::share('footer_para', $footer_data);

        $website_links = WebsiteLinksModel::first();
        View::share('website_links', $website_links);
    }
}
