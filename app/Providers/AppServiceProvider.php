<?php

namespace App\Providers;

use App\Models\Content;
use App\Models\Statistic;
use App\Observers\ContentObserver;
use App\Observers\StatisticObserver;
use Illuminate\Support\Facades\Schema;
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
        Content::observe(ContentObserver::class);
//        Statistic::observe(StatisticObserver::class);
    }
}
