<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\EventTransform as Transform;

class EventTransform implements Transform {

    public function transform($event) {

        $event['user'] = $event['user']->transformForUserlist();
        $event['company'] = $event['company']->transformForUserlist();

        return $event;
    }
}
