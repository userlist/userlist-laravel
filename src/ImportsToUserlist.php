<?php

namespace Userlist\Laravel;


use Userlist\Laravel\Services\UserTransform;

trait ImportsToUserlist
{
    /**
     * T
     * @return array|void
     */
    public function transformForUserlist()
    {
        if (method_exists($this, 'toUserlist')) {
            return $this->toUserlist();
        }

        if (__CLASS__ == config('userlist.user_model')) {
            return (new UserTransform())->transform($this);
        }
    }
}