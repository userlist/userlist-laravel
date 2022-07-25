# Userlist Laravel [![Build Status](https://travis-ci.com/userlist/userlist-laravel.svg?branch=master)](https://travis-ci.com/userlist/userlist-laravel)

This library helps with integrating Userlist into Laravel applications.

## Installation

This library can be installed via [Composer](https://getcomposer.org):

```bash
composer require userlist/userlist-laravel
```

## Configuration

There are 2 configuration steps.

**First, publish the configuration file:**

After installation, you can publish the configuration file for Userlist:

```bash
php artisan vendor:publish --provider Userlist\Laravel\UserlistServiceProvider
```

You can then edit the `config/userlist.php` file if needed:

```php
# Adjust if your User/Team models are found elsewhere
return [
    'user_model' => \App\Models\User::class,
    'company_model' => \App\Models\Team::class,
    'push_id' => env('USERLIST_PUSH_ID'),
    'push_key' => env('USERLIST_PUSH_KEY')
];
```

**Second, add the Userlist trait to your models:**

```php
# Other items omitted
use Userlist\Laravel\ImportsToUserlist;

class User extends Authenticatable
{
    # Other items omitted
    use ImportsToUserlist;
    
    ...
}
```

User and Team (Company) models need to be transformed to data Userlist can understand (https://userlist.com/docs/getting-started/integration-guide/).

If you need to customize how Userlist transforms your models data, you can add a `toUserlist()` method to your classes:

```php
# Other items omitted
use Userlist\Laravel\ImportsToUserlist;

class User extends Authenticatable
{
    # Other items omitted
    use ImportsToUserlist;
    
    public function toUserlist()
    {
        $modelName = Str::slug((class_basename(get_class($user))));

        return [
            'identifier' => "user-$this->getKey()",
            'email' => $user->email,
            'signed_up_at' => $user->created_at,
            'properties' => [
                'name' => $user->name
            ],
            'companies' => $this->allTeams()->map(function(Team $team) {
                // Assuming the team also uses uses `ImportsToUserlist`
                return $team->transformForUserlist();
            })->toArray();
        ];
    }
}
```

## Usage

### Importing Current Data

### Tracking Companies


### Tracking Users


### Tracking Events


## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/userlist/userlist-laravel. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.

## License

The library is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).

## Code of Conduct

Everyone interacting in the Userlist project’s codebases, issue trackers, chat rooms and mailing lists is expected to follow the [code of conduct](https://github.com/userlist/userlist-php/blob/master/CODE_OF_CONDUCT.md).

## What is Userlist?

[![Userlist](https://userlist.com/images/external/userlist-logo-github.svg)](https://userlist.com/)

[Userlist](https://userlist.com/) allows you to onboard and engage your SaaS users with targeted behavior-based campaigns using email or in-app messages.

Userlist was started in 2017 as an alternative to bulky enterprise messaging tools. We believe that running SaaS products should be more enjoyable. Learn more [about us](https://userlist.com/about-us/).
