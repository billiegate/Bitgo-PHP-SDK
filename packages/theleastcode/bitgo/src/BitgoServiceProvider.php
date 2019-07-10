<?php

//namespace App\Providers;
namespace TheListCode\Bitgo;

use Illuminate\Support\ServiceProvider;

class BitgoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Core/BitgoConfigManager.php' => config_path('bitgo.php'),
        ]);
    }
}
