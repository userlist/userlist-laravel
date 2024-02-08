<?php

namespace Userlist\Laravel\Services;

use Illuminate\Support\Str;
use Userlist\Laravel\Contracts\EventTransform as Transform;
use Userlist\Laravel\Contracts\UserTransform;
use Userlist\Laravel\Contracts\CompanyTransform;

class EventTransform implements Transform {
    public function __construct(UserTransform $userTransform, CompanyTransform $companyTransform)
    {
        $this->userTransform = $userTransform;
        $this->companyTransform = $companyTransform;
    }

    public function transform($entity) {
        if (method_exists($entity, 'toUserlist')) {
            return $entity->toUserlist();
        }

        if ($entity instanceof \Illuminate\Contracts\Support\Arrayable) {
            return $entity->toArray();
        }

        // If the event doesn't have a way to give us data, we'll attempt to build it
        // from the available information.
        // The event ideally has a public property "user", "team", or "company"
        $data = [];

        // An event should only have a user OR a company identifier
        if (property_exists($entity, 'user')) {
            $data['user'] = $this->userTransform->transform($entity->user)['identifier'];
        } elseif (property_exists($entity, 'company')) {
            $data['company'] = $this->companyTransform->transform($entity->company)['identifier'];
        } elseif (property_exists($entity, 'team')) {
            $data['company'] = $this->companyTransform->transform($entity->team)['identifier'];
        }

        $modelName = Str::slug((class_basename(get_class($entity))));
        $data['name'] = "event-$modelName";

        return $data;
    }
}
