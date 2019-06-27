<?php

namespace Jeylabs\DropBox;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Class DropBoxServiceProvider
 * @package Jeylabs\DropBox
 */
class DropBoxServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        $source = __DIR__ . '/config/dropbox.php';
        $this->publishes([$source => config_path('dropbox.php')]);
        $this->mergeConfigFrom($source, 'dropbox');
    }

    /**
     *
     */
    public function register()
    {
        $this->registerBindings($this->app);
    }

    /**
     * @param Application $app
     */
    protected function registerBindings(Application $app)
    {
        $app->singleton('DropBox', function ($app) {
            $config = $app['config'];
            return new DropBox(
                $config->get('dropbox.access_token', null)
            );
        });
        $app->alias('DropBox', DropBox::class);
    }
}