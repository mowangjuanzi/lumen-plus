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
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new console command instance.
     *
     * @return void
     */
    public function __construct($files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $routes_path = $this->laravel->basePath("bootstrap/cache/routes.php");

        if ($this->files->exists($routes_path)) {
            $this->files->delete($routes_path);
        }

        $this->info('Route cache cleared!');
    }
}
