
# CisAccess

CisAccess is an package to extend laravel.
It´s an easy to use database-based roles system.
You are able to define areas into your route middleware and in your blade templates.


## Installation


## Documentation


## Installation

Install CisAccess with composer

```bash
composer require cis/cis-access
```

Register the service provider in your laravel application´s configuration

config/app.php

```php
...
/*
*    Package Service Providers...
*/
\Cis\CisAccess\CisAccessServiceProvider::class,
...
```

Migrate the database
```bash
php artisan migrate
```

Add the "WithCisAccess" trait to your User Model
```php
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, WithCisAccess;
    ...
}
```



## Base-Configuration

At this point, there is no base configuration. You can create areas and roles only in the database.
A console-based and gui-based configation manager will come very soon.




## Usage/Examples

Blade directive
```php
@hasAccess("user.create")
    <a href="#">Add new User</a>
@endHasAccess
```

Route middleware
```php
Route::get("/dashbaord",function() {
    return 'Hello Dash!';
})->middleware("define-area:dashbaord")
```

User model
```php
$user = User::first();
if($user->hasAccess("dashbaord")) {
    dd("Hello Dash!");
}
```


