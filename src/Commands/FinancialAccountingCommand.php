<?php

namespace Rutatiina\FinancialAccounting\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FinancialAccountingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rutatiina:install {--bundle=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to install and setup the accounting app depending on the environment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //By default it will install the accouting app i.e. --accountant

        $bundle = $this->option('bundle');

        if (!$bundle)
        {
            $bundle = $this->anticipate('Using up / down keys, please choose bundle to install?', ['accountant']);
        }

        $this->info('- Bundle choosen is:: '.$bundle);

        //confirm if the db config is setup
        try
        {
            DB::connection('system')->getDatabaseName();
            DB::connection('tenant')->getDatabaseName();
        }
        catch (\Throwable $e)
        {
            $this->error('Please set DB connections as required.');
            return false;
        }

        $this->info('- Requirements for installation are all available.');

        $this->info('- Running migrations.');

        //php artisan db:wipe --database system && php artisan db:wipe --database tenant && php artisan migrate:fresh --seed
        //$this->call('db:wipe --database system');
        //$this::call('db:wipe --database tenant');
        //$this::call('php artisan migrate:fresh --seed');

        $this->info('- Running seeders.');

        $this->call('db:seed', [
            '--class' => 'Rutatiina\Item\Seeders\ItemCategoriesSeeder',
        ]);

        /*
        $this->info('- Publishing resources.');

        $this->call('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider',
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'rutatiina/item',
            //'--force' => true
        ]);
        $this->call('vendor:publish', [
            '--tag' => 'rutatiina/configs',
            //'--force' => true
        ]);
        $this->call('vendor:publish', [
            '--tag' => 'rutatiina/ui',
            //'--force' => true
        ]);

        $this->info('- Setup the storage folder link');
        $this->call('storage:link');
        //*/

        $this->info('- Installation complete successfuly.');

        return 0;
    }
}
