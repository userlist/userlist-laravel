<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\Push;
use Userlist\Laravel\Contracts\UserTransform;
use Userlist\Laravel\Contracts\CompanyTransform;
use Userlist\Laravel\Contracts\EventTransform;

class NullPush implements Push {

    public function user($user) {
        $user->transformForUserlist();
    }

    public function company($company) {
        $company->transformForUserlist();
    }

    public function event($event) {
        $event->transformForUserlist();
    }
}
