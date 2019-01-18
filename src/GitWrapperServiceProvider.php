<?php

namespace CupOfTea\GitWrapper;

use GitWrapper\GitWrapper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;

class GitWrapperServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }
    
    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath($raw = __DIR__ . '/../config/git.php') ?: $raw;
        
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('git.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('git');
        }
        
        $this->mergeConfigFrom($source, 'git');
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }
    
    /**
     * Register the factory class.
     *
     * @return void
     */
    public function registerFactory()
    {
        $this->app->singleton('git.factory', function (Container $app) {
            return new GitWrapperFactory($app);
        });
        
        $this->app->alias('git.factory', GitWrapperFactory::class);
    }
    
    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('git', function (Container $app) {
            $config = $app['config'];
            $factory = $app['git.factory'];
            
            return new GitWrapperManager($config, $factory);
        });
        
        $this->app->alias('git', GitWrapperManager::class);
    }
    
    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('git.connection', function (Container $app) {
            $manager = $app['git'];
            
            return $manager->connection();
        });
        
        $this->app->alias('git.connection', GitWrapper::class);
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'git.factory',
            'git',
            'git.connection',
        ];
    }
}
