<?php

namespace Jfreites\Luna;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Route;

class LunaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // use this if your package has views
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'luna');

        // use this if your package has lang files
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'luna');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/luna'),
            ], 'luna-views');

            $this->publishes([
                __DIR__ . '/../resources/assets/js/components' => base_path('resources/assets/js/components/luna'),
            ], 'luna-components');

            $this->publishes([
                __DIR__ . '/../resources/assets/sass' => base_path('resources/assets/sass/luna'),
            ], 'luna-sass');

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations')
            ], 'migrations');

            $this->publishes([
                __DIR__.'/../config/luna.php' => config_path('luna.php'),
            ]);
        }

        // use this if your package has routes
        $this->setupRoutes($this->app->router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // register the 'admin' middleware
        $router->middleware('admin', Http\Middleware\Admin::class);

        $router->group(['namespace' => 'Jfreites\Luna\Http\Controllers'], function ($router) {
            // Backend Routes
            Route::group(['middleware' => 'web', 'prefix' => 'admin'], function () {
                require __DIR__.'/Http/routes.php';
            });
            
            // Frontend Routes
            Route::group(['middleware' => 'web'], function () {
                Route::get('{slug}', 'FrontController@slug')->where('slug', '(.*)');
            });

            // API Routes
            Route::group(['middleware' => 'api'], function () {
                Route::post('luna/api/forms/{formId}', function ($formId) {
                    // use $formId to know who form we are to processed...

                    if (empty($_POST['email']) || empty($_POST['message'])) {
                        return back()->with('message', 'Llene todos los campos');
                    }
                });
            });
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('luna', function ($app) {
            return new Luna($app);
        });

        # register its dependencies
        $this->app->register(\Cartalyst\Sentinel\Laravel\SentinelServiceProvider::class);
        $this->app->register(\Jenssegers\Date\DateServiceProvider::class);
        //$this->app->register(\igaster\laravelTheme\themeServiceProvider::class);

        # register their aliases
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Date', \Jenssegers\Date\Date::class);
        $loader->alias('Activation', \Cartalyst\Sentinel\Laravel\Facades\Activation::class);
        $loader->alias('Reminder', \Cartalyst\Sentinel\Laravel\Facades\Reminder::class);
        $loader->alias('Sentinel', \Cartalyst\Sentinel\Laravel\Facades\Sentinel::class);
        //$loader->alias('Theme', \igaster\laravelTheme\Facades\Theme::class);
    }
}
