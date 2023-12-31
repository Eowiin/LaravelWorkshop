# LaravelWorkshop

## Initialization

Follow the instructions in [SETUP.md](setup/SETUP.md) before doing the workshop

## What is Laravel ?

Laravel, created by Taylor Otwell in 2011, is a powerful and widely-used PHP web application framework known for its elegant syntax and robust features. This open-source framework simplifies web development by offering a range of tools and libraries for building modern, maintainable web applications. <br>
Laravel is celebrated for its intuitive MVC (Model-View-Controller) architecture, expressive syntax, and extensive ecosystem, making it a top choice for developers worldwide.

## Step 1: Creation of the project

Firstly, we have to create a project. To do that, run this command:
```
composer create-project laravel/laravel [appname]
```
To launch your dev server:
```
php artisan serve
```

## Step 2: Database's setup

Create a database.sqlite file in database directory of your project. <br>
Go to your .env file and replace these lines:
```
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1 
DB_PORT=3306 
DB_DATABASE=laravel 
DB_USERNAME=root 
DB_PASSWORD=
```
By this line:
```
DB_CONNECTION=sqlite
```

Run this command to confirm database's creation:
```
php artisan migrate
```

## Step 3: Authentification

In this workshop we will use breeze to simplify the authentification part.<br>
All you need to do, is to install breeze.<br>
<br>
You can install it with this [link](https://laravel.com/docs/10.x/starter-kits#laravel-breeze-installation)

## Step 4: Creation ads page

Here, we will create our first page ! This one will display all our ads posted by users.<br>

### Model creation

To stock your ads in database, you'll need to create a Model. In this Model, add these fields:
* title (string)
* category (string)
* description (string)
* price (integer)
* locaiton (integer)
* photo (string)

> [This](https://laravel.com/docs/10.x/eloquent#generating-model-classes) may help <br>
> Other way to do this [here](https://laravel.com/docs/10.x/migrations#generating-migrations)
<br>
> Don't forget to apply migration

### Controller creation

To display your page, you need to use a controller. It will also allows you to get ads from database before displaying your page.
<br>
Create an index function. It will get ads from out database then return the associated html page

> See the [documentation](https://laravel.com/docs/10.x/controllers)

### Route creation

In the routes/web.php file, create a /ads route.
<br>
It is a GET method. Add to this route a middleware that check if user is authentificated. Add a 'ads' as name of the route.
<br>
In app/Providers/RouteServiceProvider.php, replace the value of const HOME variable by '/ads'.

> Checking the [documentation](https://laravel.com/docs/10.x/routing) may help again.

### View creation

Create your view in resources/views. Inside it you need:
<br>
* Display your ads
* Button that allows user to add an new ad
* Form to filter displayed ads
* Searchbar
<br>
> Be careful, css and js files must be placed in public directory.
<br>
You have now completed your first page !

## Step 5: Other functionnalities

In the former step we had a searchbar, form, etc... Implement these functionnalities.
