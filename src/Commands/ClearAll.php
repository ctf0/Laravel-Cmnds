<?php

namespace ctf0\LaravelHelperCmnds\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class ClearAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ex:clear';

    protected $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear bootstrap-files/cache/config/route/view/compiled/pass-resets';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        $this->files = app('files');

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->callSilent('optimize:clear');

        // cache
        app('cache')->store('file')->flush();

        // session
        session()->flush();
        $this->files->cleanDirectory(config('session.files'));
        
        $table = config('session.table');
        
        if (Schema::hasTable($table)) {
            \DB::table($table)->truncate();
        }

        // log
        $this->files->put(storage_path('logs/laravel.log'), '');

        // password_resets
        $guard = config('auth.defaults.passwords');
        $table = config("auth.passwords.$guard.table");
        
        if (Schema::hasTable($table)) {
            $this->callSilent('auth:clear-resets');
        }

        // add any extra cmnds to run
        event('clearAll.done');

        // composer dump-autoload.
        shell_exec('composer dump-autoload');

        $this->info('All Done');
    }
}
