<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class IsDebug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:is-debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if app is in debug and local mode';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if(!app()->isProduction() && env('APP_DEBUG')){
            $this->info("App is in local mode.");
        }else{
            $this->warn("!!! App is in production !!!");
        }
    }
}
