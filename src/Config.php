<?php

namespace Roy688\Config;

use Roy688\Admin;
use Roy688\Extension;

class Config extends Extension
{
    /**
     * Load configure into laravel from database.
     *
     * @return void
     */
    public static function load()
    {
        foreach(ConfigModel::all(['name', 'value']) as $config) {
            config([$config['name'] => $config['value']]);
        }
    }

    /**
     * Bootstrap this package.
     *
     * @return void
     */
    public static function boot()
    {
        static::registerRoutes();

        Admin::extend('config', __CLASS__);
    }

    /**
     * Register routes for laravel-admin.
     *
     * @return void
     */
    protected static function registerRoutes()
    {
        parent::routes(function ($router) {
            /**
             * @var \Illuminate\Routing\Router $router
             */
            $router->resource(
                config('admin.extensions.config.name', 'config'),
                config('admin.extensions.config.controller', 'Roy688\Config\ConfigController')
            );
        });
    }

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        parent::createMenu('Config', 'config', 'fa-toggle-on');
        parent::createPermission('Admin Config', 'ext.config', 'config*');
    }
}
