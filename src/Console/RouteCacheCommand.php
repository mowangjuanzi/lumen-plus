<?php
namespace Mowangjuanzi\Plus;

use Illuminate\Console\Command;

class RouteCacheCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'route:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a route cache file for faster route registration';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException | \LogicException
     */
    public function handle() {
        $this->call('route:clear');

        $routes = $this->laravel->router->getRoutes();

        foreach ($routes as $item) {
            $action = $item["action"];

            if (isset($action[0]) && $action[0] instanceof \Closure) {
                throw new \LogicException("Unable to prepare route [{$item['uri']}] for serialization. Uses Closure.");
            }
        }

        if (count($routes) === 0) {
            $this->error("Your application doesn't have any routes.");
            return ;
        }

        $path = $this->laravel->basePath("bootstrap/cache/routes.php");

        $this->files->put($path, str_replace("{{routes}}", base64_encode(serialize($routes)), $this->files->get(__DIR__ . "/stubs/routes.stub")));

        $this->info('Routes cached successfully!');
    }
}
