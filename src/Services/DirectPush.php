<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\Push;

class DirectPush implements Push {
    public function __construct(\Userlist\Push $push)
    {
        $this->push = $push;
    }

    public function user($user) {
        $payload = $user->transformForUserlist();

        if ($payload != null) {
            try {
                $this->push->user($payload);
            } catch (\RuntimeException $e) {
                report($e);
            }
        }
    }

    public function company($company) {
        $payload = $company->transformForUserlist();

        if ($payload != null) {
            try {
                $this->push->company($payload);
            } catch (\RuntimeException $e) {
                report($e);
            }
        }
    }

    public function event($event){
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
