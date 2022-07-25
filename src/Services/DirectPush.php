<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\Push;
use Userlist\Laravel\Contracts\UserTransform;
use Userlist\Laravel\Contracts\CompanyTransform;
use Userlist\Laravel\Contracts\EventTransform;

class DirectPush implements Push {
    public function __construct(\Userlist\Push $push, UserTransform $userTransform, CompanyTransform $companyTransform, EventTransform $eventTransform)
    {
        $this->push = $push;

        $this->userTransform = $userTransform;
        $this->companyTransform = $companyTransform;
        $this->eventTransform = $eventTransform;
    }

    public function user($user) {
        $payload = $this->userTransform->transform($user);

        if ($payload != null) {
            try {
                $this->push->user($payload);
            } catch (\RuntimeException $e) {
                report($e);
            }
        }
    }

    public function company($company) {
        $payload = $this->companyTransform->transform($company);

        if ($payload != null) {
            try {
                $this->push->company($payload);
            } catch (\RuntimeException $e) {
                report($e);
            }
        }
    }

    public function event($event) {
        $payload = $this->eventTransform->transform($event);

        if ($payload != null) {
            try {
                $this->push->event($payload);
            } catch (\RuntimeException $e) {
                report($e);
            }
        }
    }
}
