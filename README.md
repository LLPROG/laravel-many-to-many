# Progetto laravel con login

## Inizializzazione

1. creare cartella progetto

1. entrare dal terminale nella cartella

1. <code> composer create-project --prefer-dist laravel/laravel:^7.0 . </code>

1. Solo per laravel <= 7

    - <code> composer remove fzaninotto/faker</code>
    - <code> composer require fakerphp/faker</code>

1. Se volete usare laravel-debugbar

    - <code> composer require barryvdh/laravel-debugbar --dev</code>

1. <code> composer require laravel/ui:^2.4 </code>

1. <code> php artisan ui vue --auth </code>

1. (eventuali altre librerie)

1. Su package.json modificare:
   Aggiornare la versione di Bootstrap in **Bootstrap: "^5.1.3"** (o comunque la versione che si vuole aggiornare)
   Aggiunger la versione popperjs/core in **@popperjs/core: "2.11.5"**

1. Su bootstrap.js commentare:

    - window.popper...
    - window.$....

1. <code> npm install </code>

1. <code> php artisan make:model --all Nometabella (prima lettera maiuscola e singolare del nome della tabella) </code>

1. Spostare il file app\http\Controllers\NameController.php nella cartella Admin e:

    - modificare il namespace aggiungendo Admin alla fine
    - aggiungere use app\http\Controllers\Admin

1. Cancellare il controller generato e avviare il comando:

    - <code> php artisan make:controller --model=Post Admin/NometabellaController </code>

1. <code> composer dump-autoload </code>

1. Nel file **app/Providers/RouteServiceProvider.php** modificare:

    - **public const Home = '/home';** in **public const Home = '/admin';**

1. Se serve modificare il file **app/Http/Middleware/Authenticate.php** //DA COMPLETARE

## Preparare database

1. Creare database da PhpMyAdmin o da linea di comando

1. Nel file .env inserire il nome del database e agguingere la password ( files DB\_) e il NAME_DB

1. Aggiornare il file migration

1. Aggiornare il file DatabaseSeeder.php (decommentare e corregere $this-call con nome del seeder)

1. Aggiornare il file seeder:

    - aggiungere: <code> use Faker\Generator as Faker</code>
    - modificare: <code> Public function run()</code> in <code> Public function run(Faker $faker)</code>

1. (slug)

1. Nel model impostare proprietà $fillable (<code>protected $fillable = ['title',...]</code>)

1. <code> php artisan migrate:refresh --seed</code>

## Views

1. Organizzare la cartella resources/views:
    - una sottocartella admin(con un file per ciascun model risorsa) e spostare home.blade.php dentro admin

## Avviare ambiente locale

1. <code> npm run watch </code>
1. <code> php artisan serve </code>

**CHIUDERE TUTTE LE TAB DI VSCODE**

1. Creare le diverse view per resource:

    - index.blade.php
    - show.blade.php
    - create.blade.php
    - edit.blade.php

1. Creare il layout di base con admin.blade.php (prendere inspirazione da quelli gia esistenti)
