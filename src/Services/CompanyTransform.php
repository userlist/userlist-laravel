<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\CompanyTransform as Transform;
use Illuminate\Support\Str;

class CompanyTransform implements Transform {

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
            'name' => $entity->name,
            'signed_up_at' => $entity->created_at,
        ];
    }
}
