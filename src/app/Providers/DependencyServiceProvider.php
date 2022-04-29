<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class DependencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Global register
        $app = $this->app;
        $path = app_path('Temanhewan/dependencies.php');
        require "{$path}";
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
