<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        mb_internal_encoding('UTF-8');
        mb_http_output('UTF-8');
        mb_language('Japanese');
        mb_regex_encoding('UTF-8');

        Schema::defaultStringLength(191);

        ini_set('default_charset', 'UTF-8');
        DB::statement("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
    }
}
