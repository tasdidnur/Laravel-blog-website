<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Setting;

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
        $categorys=Category::where('cat_status',1)->get();
        View::share('categorys',$categorys);

        $setting=Setting::where('setting_id',1)->firstOrFail();
        View::share('setting',$setting);

        Paginator::useBootstrap();
    }

}
