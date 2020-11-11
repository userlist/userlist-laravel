<?php

namespace Userlist\Laravel\Console\Commands;

class ImportUsersCommand extends ImportBaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userlist:import:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports all existing users into Userlist';

    protected function import($user) {
      $this->userlist->user($user);
    }

    protected function modelClass() {
      return config('userlist.user_model');
    }
}
