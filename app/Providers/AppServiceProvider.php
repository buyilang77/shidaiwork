<?php

namespace App\Providers;

use App\Models\Manuscript;
use App\Models\Statistic;
use App\Observers\ManuscriptObserver;
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
        Manuscript::observe(ManuscriptObserver::class);
//        Statistic::observe(StatisticObserver::class);
    }
}
