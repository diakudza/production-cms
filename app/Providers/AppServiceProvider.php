<?php

namespace App\Providers;

use App\View\Composers\AppComposer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Vite;
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
        View::composer('*', AppComposer::class);

        Vite::macro('image', fn($asset) => $this->asset("resources/image/{$asset}"));
        Vite::macro('imageLoaded', fn($asset) => $this->asset("public/image/{$asset}"));

        Model::preventLazyLoading(!app()->isProduction());

        if (app()->isProduction()) {
            \Debugbar::disable();
        }
    }

}
