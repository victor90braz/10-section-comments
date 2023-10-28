````markdown
# Laravel Database Interaction README

**GitHub Repository:** [09-section Repository](https://github.com/victor90braz/09-section-register.git)

## Introduction

Welcome to the Laravel Database Interaction README! This guide provides comprehensive instructions for setting up your Laravel project, connecting to a MySQL database, and creating and interacting with users, posts, and categories using the Tinker tool.

## Installation

To create a new Laravel project named "app-example," run the following command:

```bash
composer create-project laravel/laravel app-example
```
````

## Running the Application

Start the development server with the following command:

```bash
php artisan serve
```

## Connect to the Database

To connect to your MySQL database, use the following command:

```bash
mysql -u root -p
```

## Migrate the Database

Create the necessary database tables by running the migration:

```bash
php artisan migrate
```

## Creating a New User and Adding It to the Database Using Tinker

Create a new user and add it to the database using Laravel's Tinker. First, run Tinker with the following command:

```bash
php artisan tinker
```

1. Create a migration for the "categories" table:

```bash
php artisan make:migration create_categories_table
```

2. Create a model for the "Category" entity:

```bash
php artisan make:model Category
```

3. Run the migration to create the "categories" table:

```bash
php artisan migrate
```

4. Retrieve a post with its associated category:

```php
$post = \App\Models\Post::with('category')->first();
```

5. Access the post's category name:

```php
$post->category->name;
```

## Working with the Database

Here are some useful commands for working with the database:

-   **Refresh and seed the database:**

```bash
php artisan migrate:refresh
php artisan db:seed
```

-   **Add fake data to the database:**

```bash
php artisan tinker
$cat = \App\Models\Category::factory(30)->create();
```

## Notes

```html
<form action="/" method="POST">@csrf</form>
```

-   `@csrf` -> always have to add it to the form to avoid error 419

-   `store` function:

```php
public function store()
{
    request()->validate([
        'name' => 'required:max:255',
        'username' => 'required|max:255|min:3',
        'email' => 'required|email|max:255',
        'password' => 'required|max:255|min:7',
    ]);

    ddd(request()->all());
}
```

-   `Rule::unique('users', 'username')`

```php
'username' => [
    'required',
    'min:3',
    'max:255',
    Rule::unique('users', 'username')
],
```

Important to know, Laravel doesn't allow sending the form if it doesn't match.

```php
protected $fillable = [
    'name',
    'username',
    'email',
    'password',
];
```

Option is to disable it and add `guarded = []`:

```php
/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $guarded = [];
```

Find an ID in the DB:

```php
> \App\Models\User::find(62)
> = App\Models.User {#6468
    id: 62,
    username: "ronaldinho10",
    name: "ronaldinho",
    email: "ronaldinho@gmail.com",
    email_verified_at: null,
    #password: "$2y$10$sESFNsEe8KCgyw4AGe2CJetr1N0nXeSxezjHam9rtVy.CFJBUlUBS",
    #remember_token: null,
    created_at: "2023-10-27 10:12:33",
    updated_at: "2023-10-27 10:12:33",
}
```

Very important to use the convention `set[Attribute]`:

```php
public function setPasswordAttribute($password) {
    $this->attributes['password'] = bcrypt($password);
}
```

Handle errors:

```php
@error('name')
<p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
```

or at the end of form

<div class="mb-6">
    @foreach ($errors->all() as $error)
        <li class="text-red-500 text-xs">{{ $error }}</li>
    @endforeach
</div>

Handle input values:

```html
<input
    class="border border-gray-400 p-2 w-full"
    type="email"
    name="email"
    id="email"
    required
    value="{{ old('name') }}"
/>
```
