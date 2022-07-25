<?php

return [
    'user_model' => \App\Models\User::class,
    'company_model' => \App\Models\Team::class,
    'push_id' => env('USERLIST_PUSH_ID'),
    'push_key' => env('USERLIST_PUSH_KEY')
];
