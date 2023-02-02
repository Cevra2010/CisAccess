<?php namespace Cis\CisAccess;

use Illuminate\Contracts\Http\Kernel;
use Cis\CisAccess\Http\Middleware\DefineArea;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
class CisAccessServiceProvider extends ServiceProvider {

    public function register()
    {

    }

    public function boot(Kernel $kernel)
    {
        /* Adding route middleware */
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('define-area',DefineArea::class);

        /* set path to migration files */
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');

        /* register blade access statement */
        Blade::if('hasAccess',function($areaSlug) {
            return auth()->user()->hasAccess($areaSlug);
        });
    }

}
