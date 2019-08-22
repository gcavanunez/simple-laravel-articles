Alright Frank esto es lo que tienes que hacer
Simple Compartir de articulos 
-> creamos projecto 
composer create-project --prefer-dist laravel/laravel simple-articulos

empezamos xampp -> phpmyadmin -> creamos una db 

luego entras a env para settear las variables de 

DB_DATABASE=simple_articles
DB_USERNAME=root
DB_PASSWORD=
(si copias projecto desde github porfavor copiar el archivo env y correr el comando php artisan key:generate )

como vamos a usar authenticacion usamos el comando 
php artisan mkae:auth 
para usar el mismo sistema de autenticacion que usa laravel

-> modelos mas migraciones 
en esta applicacion vamos a usar el tema de que un usuario tiene articulos entonces vamos a crear un modelo de Articulo corriendo el siguiente comando

php artisan make:model Article -m

ahora antes de correr la migration, cual crearia por nosotros la db, vamos a usar la migracion que esta para configurar la tabla de usaurios y tambien articulos 

entramos al archivo database/migrations/xxxxxx_create_articles_table.php
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('content');
            $table->timestamps();
basado en esto vamos a ahora hacer la migration 
php artisan migrate

antes de continuar a las vistas, vamos populando la base de datos con contenido falso, para esto usamos los siguientes comandos
 php artisan make:seeder ArticlesTableSeeder
php artisan make:seeder UsersTableSeeder

ingresamos a los archivos que acabamos de crear 
database/seeds

primera articlestableseeder 

use App\Article;

use App\User;
$faker = \Faker\Factory::create();

        User::all()->each(function ($user) use ($faker) {
            foreach (range(1, 5) as $i) {
                Article::create([
                    'user_id' => $user->id,
                    'title'   => $faker->sentence,
                    'content' => $faker->paragraphs(3, true),
                ]);
            }
        });

luego 


use App\User;
 $faker = \Faker\Factory::create();
        $password = bcrypt('secret');

        User::create([
            'name'     => $faker->name,
            'email'    => 'master@domain.com',
            'password' => $password,
        ]);

        for ($i = 0; $i < 10; ++$i) {
            User::create([
                'name'     => $faker->name,
                'email'    => $faker->email,
                'password' => $password,
            ]);
        }

finalmente en el archivo databaseseeder

dentro de la funccion run 

        $this->call(UsersTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);

ahora corremos el seeder usando 
php artisan db:seed

ahora con datos falsos vamos a ver controladores y vistas

-> creamos controlladores

hays dos tipos de controlladores que podemos ir creando 

php artisan make:controller PagesController
php artisan make:controller ArticlesController --resource --model=Article

ya que vamos a re-crear el app de mvc.nucliuz.com
tenemos que establecer los views

primero corremos 
php artisan serve
para poder visualizar nuestro app 

ahora entramos a la nutra a ver nuestra app

la vista presente viene desde routes/web.php
la function 
Route::get('/', function () {
    return view('welcome');
});
es la que esta dando la vista entonces tenemos que primero hacer que la ruta apunte a nuestro controlador de paginas luego modificar la vista para que se vea como la del ejemplo que estamos robando 
1. primero al archivo web.php cambiamos la ruta a esto
Route::get('/', 'PagesController@index')->name('index');
2. dentro del archivo pagescontroller incluimos esta function
    public function index(){
        return view('pages.index');
    }
3. luego vamos a crear y modificar nuestro layout
entramos a views creamos un archivo llamado pages->index.blade.php
y escribes hola

4. ahora creamos un archivo que se llama inc
y incluimos 
app.blade.php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="/css/custom.css" rel="stylesheet">
</head>

<body id="app">
  <div>
    @include('inc.nav')
    <main class="py-4">
      @yield('content')
    </main>
  </div>
</body>

</html>

tambien creamos nav.blade.php.
{{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" id="main-nav">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="/img/nucliuzMVC-logo.png" id="main-logo">
      {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/about">About</a>
        </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

el index.blade.php

@extends('inc.app')

@section('content')
<div class="container">
  <div class="jumbotron jumbotron-fluid text-center ">
    <div class="container">
      <h1 class="dislpay-3">
        <img src="/img/nucliuzMVC-logo.png" id="jumbo-logo" style="">
        {{$title}}
      </h1>
      <p class="lead">
        {{$description}}
      </p>
    </div>
  </div>
</div>
@endsection

abrimos nuevamente el pagescontroller
 public function index()
    {
        $data = array();
        $data['title'] = 'NucliuzMVC';
        $data['description'] = 'Simple social network built on the NucliuzMVC PHP framework';
        return view('pages.index', $data);
    }

at this point we got the layout down lets gets the simple about route path working 
dentro del pagescontroller
  public function about()
    {
        $data = array();
        $data['title'] = 'About Us';
        $data['description'] = 'This simple laravel app is the way we upgraded from the NucliuzmMVC';
        return view('pages.index', $data);
    }
luego dentro de views/pages/
creamos about.blade.php


-> vemos rutas
-> vistas en blade 
