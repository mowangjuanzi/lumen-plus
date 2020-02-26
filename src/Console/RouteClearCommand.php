<?php
namespace Mowangjuanzi\Plus;

use Illuminate\Console\Command;

class RouteClearCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'route:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the route cache file';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $router_path = $this->laravel->basePath("bootstrap/cache/routes.php");

        if (file_exists($router_path)) {
            unlink($router_path);
        }

        $this->info('Route cache cleared!');
    }
}
