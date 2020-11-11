<?php

namespace Userlist\Laravel\Console\Commands;

use Illuminate\Console\Command;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userlist:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports all existing users and companies into Userlist';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('userlist:import:users');
        $this->call('userlist:import:companies');
    }
}
