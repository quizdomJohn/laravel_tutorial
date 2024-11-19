## Initial Installations
- `brew install php`
- `brew install composer`

## Usefull Commands
- `php artisan view:clear` 
This will clear any cached views, and you can then rest assured that you'll see your newest HTML templates in the browser.

## Usefull Extensions
- `laravel blade snippets'

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

<br><hr><hr>

## View - Blade
Create a new .blade.php file in `views` folder
Call the new file in your controller you created

Blade can dipslay dynamic content by using {{}}

#### <u>Seperation of concerns</u>
Controller must have all the complexility and not the blade file
inside the return of the controller,you pass the data in the view

### Avoid Duplication (1st way)
Create another .blade.php file (header.blade.php) where will contain the HTML for the header and import it to other views like this
`@include ('header')`

### Avoid Duplication (2nd way)
Create a folder components and in there a file 'layout.blade.php'  
In there will be the header AND the footer and between them there will be a `{{$slot}}`

<br><hr><hr>


## Connect to database (SQL)
Go to .env and modify accordingly the lines
```
DB_DATABASE=laravel # replace with the actual database name
DB_USERNAME=root
DB_PASSWORD= # fill in with the actual password
```

### Use a migration of laravel
There are located in `database -> migrations`  
In order to use them,type in the terminal:  
`php artisan migrate`  
This will create the tables that are in the migrations (users)

### Modifying the migrations tables
Go the migrations 'create_users' and add or modify a field.  
How to update the fields of the 'users' table??? (CAREFULL)

<b>WARNING!!!</b>  
<U>ONLY ON EMPTY DATABASES</U>

```
!!!!!!!!WARNING!!!!!!!!!!!

php artisan migrate:fresh

!!!!!!!!WARNING!!!!!!!!!!!
```
<b>WARNING!!!</b>  
<U>ONLY ON EMPTY DATABASES</U>

In case our database is not empty,we don't want to lose the data.  
Solution: create a new migration  
`php artisan make:migration <name>`  
<i>eg: php artisan make:migration add_favorite_color_column</i>   
and a new migration will be created

In there you create the function up so it will add the new column and function down in case you want to delete it  
``` php
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // create the new column you want to add
        Schema::table('user',function($table){
            $table->string('favoriteColor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('user',function($table){
            $table->dropColumn('favoriteColor');
        });
    }
};
```
if you type in terminal  
`php artisan migrate`  
the database will see the new migration and update it  
If you changed your mind you can type  
`php artisan migrate:rollback`  
to undo it
