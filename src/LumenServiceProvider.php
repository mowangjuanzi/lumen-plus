<?php
namespace Mowangjuanzi\Plus;

use Illuminate\Database\Console\Factories\FactoryMakeCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Console\ControllerMakeCommand;
use Mowangjuanzi\Plus\Console\ConsoleMakeCommand;
use Mowangjuanzi\Plus\Console\EventGenerateCommand;
use Mowangjuanzi\Plus\Console\EventMakeCommand;
use Mowangjuanzi\Plus\Console\ModelMakeCommand;
use Mowangjuanzi\Plus\Console\ResourceMakeCommand;
use Mowangjuanzi\Plus\Console\RouteCacheCommand;
use Mowangjuanzi\Plus\Console\RouteClearCommand;

class LumenServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'ConsoleMake' => 'command.console.make',
        'ControllerMake' => 'command.controller.make',
        'EventGenerate' => 'command.event.generate',
        'EventMake' => 'command.event.make',
        'FactoryMake' => 'command.factory.make',
        'ModelMake' => 'command.model.make',
        'ResourceMake' => 'command.resource.make',
        'RouteCache' => 'command.route.cache',
        'RouteClear' => 'command.route.clear',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands($this->commands);
    }

    /**
     * Register the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            call_user_func_array([$this, "register{$command}Command"], []);
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerControllerMakeCommand()
    {
        $this->app->singleton('command.controller.make', function ($app) {
            return new ControllerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerModelMakeCommand()
    {
        $this->app->singleton('command.model.make', function ($app) {
            return new ModelMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerFactoryMakeCommand()
    {
        $this->app->singleton('command.factory.make', function ($app) {
            return new FactoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRouteCacheCommand()
    {
        $this->app->singleton('command.route.cache', function ($app) {
            return new RouteCacheCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRouteClearCommand()
    {
        $this->app->singleton('command.route.clear', function ($app) {
            return new RouteClearCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerConsoleMakeCommand()
    {
        $this->app->singleton('command.console.make', function ($app) {
            return new ConsoleMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerResourceMakeCommand()
    {
        $this->app->singleton('command.resource.make', function ($app) {
            return new ResourceMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventMakeCommand()
    {
        $this->app->singleton('command.event.make', function ($app) {
            return new EventMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventGenerateCommand()
    {
        $this->app->singleton('command.event.generate', function () {
            return new EventGenerateCommand();
        });
    }
}
