<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\UserTransform as Transform;
use Illuminate\Support\Str;

class UserTransform implements Transform {

    /**
     * @param $entity
     * @return array
     */
    public function transform($entity) {
        if (method_exists($entity, 'toUserlist')) {
            return $entity->toUserlist();
        }

        $modelName = Str::slug((class_basename(get_class($entity))));

        return [
            'identifier' => "$modelName-$entity->id",
            'email' => $entity->email,
            'signed_up_at' => $entity->created_at,
            'properties' => [
                'name' => $entity->name
            ]
        ];
    }
}
