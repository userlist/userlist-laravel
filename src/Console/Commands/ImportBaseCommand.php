<?php

namespace Userlist\Laravel\Console\Commands;

use Illuminate\Console\Command;
use Userlist\Laravel\Contracts\Push as Userlist;

class ImportBaseCommand extends Command
{
    /**
     * The userlist client
     *
     * @var Userlist\Laravel\Contracts\Push
     */
    protected $userlist;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Userlist $userlist)
    {
        $this->userlist = $userlist;
        $modelClass = $this->modelClass();

        $this->info("Importing all $modelClass...");

        foreach ($modelClass::cursor() as $entity) {
            $this->line("Importing $modelClass $entity->id...");
            $this->import($entity);
        }
    }
}
