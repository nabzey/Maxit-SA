<?php

require_once dirname(__DIR__) . '/src/controller/PersonneController.php';
require_once dirname(__DIR__) . '/app/config/env.php';

$baseUrl = rtrim(APP_URL, '/');


$path = [
    $baseUrl . '/' => [
        'controller' => 'App\\Controller\\PersonneController',
        'action' => 'index',
    ],
    $baseUrl . '/login' => [
        'controller' => 'App\\Controller\\PersonneController',
        'action' => 'login',
    ],
     $baseUrl .'/acceuil' => [
    'controller' => 'App\\Controller\\PersonneController',
    'action' => 'afficher',
],
    $baseUrl .'/logout' => [
    'controller' => 'App\\Controller\\PersonneController',
    'action' => 'deconnexion',
],
  $baseUrl .'/register' => [
    'controller' => 'App\\Controller\\PersonneController',
    'action' => 'create',
],
//   $baseUrl .'/secondaire' => [
//     'controller' => 'App\\Controller\\CompteController',
//     'action' => 'Secondaire',
// ],
  $baseUrl .'/pageacceuil' => [
    'controller' => 'App\\Controller\\CompteController',
    'action' => 'create',
],
  $baseUrl .'/transaction' => [
    'controller' => 'App\\Controller\\PersonneController',
    'action' => 'lister',
],
];