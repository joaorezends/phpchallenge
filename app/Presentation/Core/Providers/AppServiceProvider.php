<?php

namespace App\Presentation\Core\Providers;

use App\Presentation\Api\ServiceProvider as ApiServiceProvider;
use App\Presentation\Web\ServiceProvider as WebServiceProvider;
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
        $this->app->register(ApiServiceProvider::class);
        $this->app->register(WebServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->instance("path.lang", app_path("Presentation/Core/resources/lang"));
    }
}
