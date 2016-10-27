# v5.2
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
>  - php artisan make:model -m
>
>  - php artisan make:seeder [y/N]
>   - create seeder file & register it into `DatabaseSeeder::run()`.
>
> - Rotues [y/N]
>  - creates a new folder `App/Http/Routes/ClassName.php`.
>  - append a loop to `App/Http/routes.php` to include all the files from the `App/Http/Routes` folder.
>
> - Views [y/N]
>  - create a new folder in `Resources/Views/ClassName/` + files for **'create/show/edit'**.
>
> - Validation "**FormRequest** or **CustomValidation** or **Non**"
>  - create `App/Http/Requests/Request.php` if not found, create a new folder `App/Http/Requests/ClassName/` + `php artisan make:request {name}` [Read More](https://ctf0.wordpress.com/2016/10/17/extend-formrequest-to-allow-more-functionality-in-laravel-v5-2/)
>  - create a new folder `App/Http/Validations/ClassName/` + the validation class name [Read More](https://ctf0.wordpress.com/2016/10/01/custom-validation-with-the-same-workflow-laravel-v5-2/).
>  - dont include any validation "default".

4- ex:re:migrate [Also Check](http://code4fun.io/post/how-to-share-data-with-all-views-in-laravel-5-3-the-right-way)
>  - php artisan migrate:refresh --seed
>  - php artisan cache:clear

# v5.3
**#Installation & #Usage** same as v5.2

3- ex:make:all
> - Rotues [y/N]
>  - creates a new folder in `routes/Routes/ClassName.php`.
>  - append a loop to `web.php` to include all the files from the `routes/Routes` folder.
>
> - Validation
>  - create a new folder `App/Http/Requests/ClassName/` + `php artisan make:request {name}` [Read More](https://ctf0.wordpress.com/2016/10/16/extend-formrequest-to-allow-more-functionality-in-laravel-v5-3/).


# ToDo

* [ ] Make `Models Folder` and add **BaseModel** while make others extend it.
* [ ] Turn into Package.
