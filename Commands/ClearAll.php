<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;
use Schema;
use Session;

class ClearAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ex:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cache/config/route/view/compiled/pass-resets';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->callSilent('clear-compiled');
        $this->callSilent('cache:clear');
        $this->callSilent('config:clear');
        $this->callSilent('route:clear');
        $this->callSilent('view:clear');
        Session::flush();
        File::put(storage_path('logs/laravel.log'), '');

        if (Schema::hasTable('password_resets')) {
            $this->callSilent('auth:clear-resets');
        }

        $this->info('All Done');
    }
}
