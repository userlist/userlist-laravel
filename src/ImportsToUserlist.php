<?php

namespace Userlist\Laravel;


use Userlist\Laravel\Services\CompanyTransform;
use Userlist\Laravel\Services\EventTransform;
use Userlist\Laravel\Services\UserTransform;
use Userlist\Push;

trait ImportsToUserlist
{
    /**
     * Transform a model to a Userlist object
     * @return array|void
     */
    public function transformForUserlist()
    {
        if (method_exists($this, 'toUserlist')) {
            return $this->toUserlist();
        }

        if (__CLASS__ == config('userlist.user_model')) {
            return (new UserTransform)->transform($this);
        } else if (__CLASS__ == config('userlist.company_model')) {
            return (new CompanyTransform)->transform($this);
        } else {
            return (new EventTransform)->transform($this);
        }
    }
}