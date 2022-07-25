<?php

namespace Userlist\Laravel;


use Userlist\Laravel\Services\CompanyTransform;
use Userlist\Laravel\Services\UserTransform;

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
        }

        if (__CLASS__ == config('userlist.company_model')) {
            return (new CompanyTransform)->transform($this);
        }

        // todo: Auto Event transform based on class namespace,
        //       or existence of $this['user'] / $this['company']
    }
}