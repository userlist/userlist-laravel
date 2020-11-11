<?php

namespace Userlist\Laravel\Contracts;

interface Push {
    public function user($user);
    public function company($company);
    public function event($event);
}
