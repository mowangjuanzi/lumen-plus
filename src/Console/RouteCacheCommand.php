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
     * Execute the console command.
     *
     * @return void
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
            return $this->error("Your application doesn't have any routes.");
        }

        $path = $this->laravel->basePath("bootstrap/cache/routes.php");

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path));
        }

        file_put_contents($path, str_replace("{{routes}}", base64_encode(serialize($routes)), file_get_contents(__DIR__ . "/stubs/routes.stub")));

        $this->info('Routes cached successfully!');
    }
}
