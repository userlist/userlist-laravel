# Userlist Laravel [![Build Status](https://travis-ci.com/userlist/userlist-laravel.svg?branch=master)](https://travis-ci.com/userlist/userlist-laravel)

This library helps with integrating Userlist into Laravel applications.

## Installation

This library can be installed via [Composer](https://getcomposer.org):

```bash
composer require userlist/userlist-laravel
```

## Configuration

After installation, you can publish the configuration file for Userlist:

```bash
php artisan vendor:publish --provider Userlist\Laravel\UserlistServiceProvider
```

You can then edit the `config/userlist.php` file if needed.

```php
# Adjust if your User/Team models are found elsewhere
return [
    'user_model' => \App\Models\User::class,
    'company_model' => \App\Models\Team::class,
    'push_id' => env('USERLIST_PUSH_ID'),
    'push_key' => env('USERLIST_PUSH_KEY'),
];
```

Userlist will attempt to transform your `User` and `Team` (Company) models to data it can understand automatically (an associated array that can be encoded as JSON)..

However, if you need or want to customize the User/Team (Company)/Event objects sent to Userlist, you can add a public `toUserList()` method to your Model or Event classes:

```php
class User extends Authenticatable
{    
    public function toUserlist()
    {
        return [
            'identifier' => "user-$this->getKey()",
            'email' => $user->email,
            'signed_up_at' => $user->created_at,
            'properties' => [
                'name' => $user->name
            ],
            // Assuming allTeams() is a method of this class
            'companies' => $this->allTeams()->map(function(Team $team) {
                // Assuming the team also has a `toUserList()` method
                return $team->toUserList();
            })->toArray();
        ];
    }
}
```

## Usage

### Importing Current Data

This package includes some commands to help you load your current data (users and companies) into Userlist. After using these commands, you should also implement code
to register users and companies to Userlist as they are created or updated.

The `userlist:import` command imports all users and companies into Userlist. These uses the configuration for `user_model` 
and `company_model` to decide which Eloquent models to include.

```bash
# This command calls the following under the hood
#  userlist:import:companies
#  userlist:import:users
php artisan userlist:import
```

The `userlist:import:companies` command will use the Eloquent model defined by the `company_model` configuration to import all companies.

In Laravel, this is often the `App\Models\Team` model.

```bash
php artisan userlist:import:companies
```

The `userlist:import:users` command will use the Eloquent model defined by the `user_model` configuration to import all users.

In Laravel, this is often the `App\Models\User` model.

```bash
php artisan userlist:import:users
```

### Tracking Companies

You can track companies (adding and updating) by "pushing" their records to Userlist.


```php
// In Laravel, Userlist companies are often "teams"
$team = App\Models\Team::find(1);
app(Userlist\Laravel\Contracts\Push::class)->company($team);
```

These will transform the model to a "jsonable" associated array using the model's `toUserList()` method (if defined), else fall back to its default transformation logic for the class.

### Tracking Users

You can track users (adding and updating) by "pushing" their records to Userlist.


```php
$user = App\Models\User::find(1);
app(Userlist\Laravel\Contracts\Push::class)->user($user);
```

These will transform the model to a "jsonable" associated array using the model's `toUserList()` method (if defined), else fall back to its default transformation logic for the class.

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
