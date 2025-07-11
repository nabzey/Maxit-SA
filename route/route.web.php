<?php
use App\Core\Router;
use App\Controller\ClientController;
use App\Controller\CompteController;

Router::get('/', ClientController::class, 'index');
Router::get('/acceuil', ClientController::class, 'index');

Router::get('/login', ClientController::class, 'login');
Router::post('/login', ClientController::class, 'login');
Router::get('/register', ClientController::class, 'create');
Router::post('/register', ClientController::class, 'create');
Router::get('/home', ClientController::class, 'dashboard');
Router::resolve();

