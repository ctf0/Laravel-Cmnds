# v5.2
### Installation
1- copy the folder into `App/Console`

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

### Usage
now you have 3 new cmnds.

```shell
ex:clear:all   Clear (Cache/Config/Route-Cache/View/Compiled/Pass-Resets)
ex:fine:tune   optimize & cache config
ex:make:all    Make (Controller/Model/Migration/Seeder/Route/View/Validation)
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
>  - php artisan optimize
>  - php artisan config:cache

3- ex:make:all

`any exisitng files wont be changed even when re-entering the same class name over and over`
>  - php artisan make:controller --resource
>  - php artisan make:model -m
>
>  - php artisan make:seeder [y/N]
>   - create seeder file & register it into `DatabaseSeeder::run()`.
>
> - Rotues [y/N]
>  - creates a new folder `App/Http/Routes` & add new route file equal to the class name **"routes now are added along with as / uses"**
>  - append a loop to `App/Http/routes.php` to include all the files from the `App/Http/Routes` folder **"happens only once"**
>
> - Views [y/N]
>  - create a new folder in `Resources/Views` equal to the class name + files for **'create/show/edit'**
>
> - Validation [y/N]
>  - create a new folder `App/Http/Validations` equal to the class name + files for **'Store & Update Validation'** [Read More](https://ctf0.wordpress.com/2016/10/01/custom-validation-with-the-same-workflow-laravel-v5-2/)
>  - for authorization [Read More](https://gist.github.com/ctf0/5cde91273c33ade6da6e2a0c8b7f47bf)

4- ex:re:migrate
>  - php artisan migrate:refresh --seed
>  - php artisan cache:clear


# v5.3
**Installation & Usage** same as v5.2 except **#3- ex:make:all (Rotues [y/N])**
>  - creates a new folder in `routes/Routes`.
>  - append a loop to `web.php` to include all the files from the `routes/Routes` folder "happens only once"


### #ToDo

* [ ] Make `Models Folder` and add **BaseModel** while make others extend it.
* [ ] Turn into Package.
