<?php
namespace Mowangjuanzi\Plus;

use Illuminate\Console\Command;

class RouteListCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'route:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all registered routes';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info("TODO");
    }
}
