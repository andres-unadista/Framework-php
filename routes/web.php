<?php

use Lib\Router;
use App\Controllers\ContactController;

Router::get('/', function () {
  return ['Bienvenido' => 'Cafre'];
});

Router::get('/about', function () {
  return ['About', 'Two'];
});

Router::get('/contact/:id', [ContactController::class, 'index']);

Router::dispatch();
