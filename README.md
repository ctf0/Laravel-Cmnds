### #Installation
1- copy the `Commands` folder to `App/Console`

2- add the below to `App/Console/Kernel.php`

```php
protected $commands = [
    Commands\ClearAll::class,
    Commands\MakeAll::class,
    Commands\FineTune::class,
    Commands\ReMigrate::class,
];
```

3- from the root of your project run `composer dump-autoload`

### #Usage
now you have 4 new cmnds.

```bash
ex:clear:all    # Clear (Cache/Config/Route-Cache/View/Compiled/Pass-Resets)
ex:fine:tune    # optimize & cache config
ex:make:all     # Make (Controller/Model/Migration/Seeder/Route/View/Validation)
ex:re:migrate   # migrate:refresh + seed & cache clear
```
> none of the cmnds require any interaction except the `ex:make:all` which will ask you for the class name.

1- ex:clear:all
>  - php artisan clear-compiled
>  - php artisan cache:clear
>  - php artisan config:clear
>  - php artisan route:clear
>  - php artisan view:clear
>  - php artisan auth:clear-resets `if the table was migrated`

2- ex:fine:tune
>  - composer dump-autoload
>  - php artisan optimize
>  - php artisan config:cache

3- ex:make:all
>  - php artisan make:controller --resource
>
>  - Model & Migration
    - create `App/Http/Models/BaseModel.php` if not found
    - create `App/Http/Models/ClassName.php`
    - `php artisan make:migration {name} --create`
>
>  - php artisan make:seeder [y/N]
    - create seeder file & register it into `DatabaseSeeder::run()`.
>
> - Rotues [y/N]
    - create `App/Http/Routes/ClassName.php`.
    - append a loop to `App/Http/routes.php` to include all the files from the `App/Http/Routes` folder.
>
> - Views [y/N]
    - create a new folder in `Resources/Views/ClassName/` + files for **'create/show/edit'**.
>
> - Validation **FormRequest** or **Non**
>  - FormRequest
    - create `App/Http/Requests/Request.php` if not found
    - create a new folder `App/Http/Requests/ClassName/`
    - `php artisan make:request {name}` [Read More](https://ctf0.wordpress.com/2016/10/17/extend-formrequest-to-allow-more-functionality-in-laravel-v5-2/)
>  - dont include any validation.

4- ex:re:migrate
>  - php artisan migrate:refresh --seed
>  - php artisan cache:clear
