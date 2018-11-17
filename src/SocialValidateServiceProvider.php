<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 17/11/2018
 * Time: 19:40
 */

namespace SocialValidate;


use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * Class SocialValidateServiceProvider
 *
 * @package SocialValidate
 */
class SocialValidateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $source = realpath(__DIR__ . '/../config/social-validate.php');
        // Check if the application is a Laravel OR Lumen instance to properly merge the configuration file.
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('social-validate.php')]);
        }

        if ($this->app instanceof LumenApplication) {
            $this->app->configure('social-validate');
        }

        $this->mergeConfigFrom($source, 'social-validate');

        $this->publishes([$source => config_path('social-validate')]);
    }

    public function register()
    {
        $this->app->singleton(
            Validator::class, function (Container $app) {
            return new Validator($app['config']['social-validate']);
        }
        );
    }

    public function provides()
    {
        return ['social-validate'];
    }
}