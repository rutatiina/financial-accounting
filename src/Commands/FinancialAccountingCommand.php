<?php

namespace Rutatiina\FinancialAccounting\Commands;

use Illuminate\Console\Command;

class FinancialAccountingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rutatiina:install {--B|bundle=}';

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
            $bundle = $this->anticipate('Using up / down keys, please choose bundle to install?', ['--accountant']);
        }

        $this->info('Bundle choosen is:: '.$bundle);

        return 0;
    }
}
