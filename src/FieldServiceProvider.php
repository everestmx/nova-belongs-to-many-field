<?php

namespace Everestmx\BelongsToManyField;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

/**
 * Class FieldServiceProvider
 * @package Everestmx\BelongsToManyField
 */
class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('belongs-to-many-tags', __DIR__ . '/../dist/js/field.js');
            Nova::style('belongs-to-many-tags', __DIR__ . '/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
