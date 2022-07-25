<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\UserTransform as Transform;
use Illuminate\Support\Str;

class UserTransform implements Transform {

    /**
     * @param $user
     * @return array
     */
    public function transform($user) {
        $modelName = Str::slug((class_basename(get_class($user))));

        return [
            'identifier' => "$modelName-$user->id",
            'email' => $user->email,
            'signed_up_at' => $user->created_at,
            'properties' => [
                'name' => $user->name
            ]
        ];
    }
}
