<?php

namespace Userlist\Laravel\Services;

use Userlist\Laravel\Contracts\CompanyTransform as Transform;
use Illuminate\Support\Str;

class CompanyTransform implements Transform {

    /**
     * @param $company
     * @return array
     */
    public function transform($company) {
        $modelName = Str::slug((class_basename(get_class($company))));

        return [
            'identifier' => "$modelName-$company->id",
            'name' => $company->name,
            'signed_up_at' => $company->created_at,
        ];
    }
}
