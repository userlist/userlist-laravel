<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\Push;
use Userlist\Laravel\Contracts\UserTransform;
use Userlist\Laravel\Contracts\CompanyTransform;
use Userlist\Laravel\Contracts\EventTransform;

class NullPush implements Push {
    public function __construct(UserTransform $userTransform, CompanyTransform $companyTransform, EventTransform $eventTransform)
    {
        $this->userTransform = $userTransform;
        $this->companyTransform = $companyTransform;
        $this->eventTransform = $eventTransform;
    }

    public function user($user) {
        $this->userTransform->transform($user);
    }

    public function company($company) {
        $this->companyTransform->transform($company);
    }

    public function event($event) {
        $this->eventTransform->transform($event);
    }
}
