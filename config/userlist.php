<?php

return [
    'user_model' => \App\Model\User::class,
    'company_model' => \App\Model\Company::class,
    'push_id' => env('USERLIST_PUSH_ID'),
    'push_key' => env('USERLIST_PUSH_KEY')
];
