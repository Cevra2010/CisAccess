<?php namespace Cis\CisAccess;

use Cis\CisAccess\View\Components\RoleAccessManager;
use Illuminate\Contracts\Http\Kernel;
use Cis\CisAccess\Http\Middleware\DefineArea;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class CisAccessServiceProvider extends ServiceProvider {

    public function register()
    {

    }

    public function boot(Kernel $kernel)
    {
        // Check DB-Migration
        if(Schema::hasTable('areas')) {
            CisAccess::init();
        }
        /* Adding route middleware */
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('define-area',DefineArea::class);

        /** register views and view components */
        $this->loadViewsFrom(__DIR__.'/resources/views', 'cis-access');
        $this->loadViewComponentsAs('cis-access', [
            RoleAccessManager::class,
        ]);

        /* set path to migration files */
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');

        /* define cis access routes */
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        /* register blade access statement */
        Blade::if('hasAccess',function($areaSlug) {
            return auth()->user()->hasAccess($areaSlug);
        });
    }

}
