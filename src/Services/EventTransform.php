<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\EventTransform as Transform;
use Userlist\Laravel\Contracts\UserTransform;
use Userlist\Laravel\Contracts\CompanyTransform;

class EventTransform implements Transform {
    public function __construct(UserTransform $userTransform, CompanyTransform $companyTransform)
    {
        $this->userTransform = $userTransform;
        $this->companyTransform = $companyTransform;
    }

    public function transform($event) {
        $event['user'] = $this->userTransform->transform($event['user']);
        $event['company'] = $this->companyTransform->transform($event['company']);

        return $event;
    }
}
