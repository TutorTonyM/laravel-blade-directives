<?php

namespace TutorTonyM\BladeDirectives;

use Blade;
use Illuminate\Support\ServiceProvider;

class TtmBladeDirectivesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ttm-blade-directives.php',
            'ttm-blade-directives'
        );

        $directives = require __DIR__.'/Directives.php';
        collect($directives)->each(function($function, $name){
            Blade::directive($name, $function);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ttm-blade-directives.php' => config_path('ttm-blade-directives.php')
        ], 'config');

        $this->register();
    }
}
