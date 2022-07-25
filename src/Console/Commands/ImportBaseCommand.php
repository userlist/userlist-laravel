<?php

namespace Userlist\Laravel\Console\Commands;

use Illuminate\Console\Command;
use Userlist\Laravel\Contracts\Push as Userlist;

abstract class ImportBaseCommand extends Command
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

    /**
     * Import some data based on an Eloquent model
     * @param $model
     * @return null
     */
    abstract protected function import($model);

    /**
     * Return a full-qualified class name
     * e.g. \App\Models\User
     * @return string
     */
    abstract protected function modelClass();
}
