<?php

namespace Userlist\Laravel\Console\Commands;

class ImportCompaniesCommand extends ImportBaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userlist:import:companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports all existing companies into Userlist';

    protected function import($company) {
      $this->userlist->company($company);
    }

    protected function modelClass() {
      return config('userlist.company_model');
    }
}
