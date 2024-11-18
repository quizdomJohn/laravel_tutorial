## Initial Installations
- `brew install php`
- `brew install composer`

## Terminal Commands
### Creating a new project
<u>Step 1</u>: Navigate to the folder using a terminal  
<u>Step 2</u>: Copy paste the following command  
The course is currently designed for you to follow along with it using Laravel version 10, so in the next lesson when you learn how to install a Laravel project you'd typically use a command like this:

`composer create-project laravel/laravel folder-name`

However, to insure that you're using version 10 and not version 11, you can use a slightly modified version of the command like this:

`composer create-project laravel/laravel=10 folder-name`

The only difference is the =10 after the laravel/laravel package name.

### Running a project
- `php -S localhost:8000`  
for running the application to a browser (needs an index file in order to run)
- `php artisan serve`

# Branches
## Route
Create routes in <i>web.php</i>
```php
Route::get('/', function () {
    return '<h1>Home Page</h1><a href="/about">View the About page</a>';
});
```
```php
Route::get('/about', function () {
    return '<h1>About Page</h1><a href="/">View the Home page</a>';
});
```

Create Controllers

in terminal: `php artisan make:controller <controllerName>`
eg. `php artisan make:controller ExampleController`

Go in app/Http/Controllers/ and see your new controller

Inside the new controller make a public function (name of your choice) where will return the html that the web.php contains

Inside the <i>web.php</i> we import the new controller
` use App\Http\Controllers\ExampleController` (with backslash)
and we use it in the routes
```php
Route::get('/',[ExampleController::class,"homepage"])
```