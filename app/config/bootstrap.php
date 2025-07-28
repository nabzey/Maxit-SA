<?php
// Chargement du Dotenv et des dépendances globales
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
require_once __DIR__ . '/env.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/../core/Router.php';

use App\core\Router;
use App\Core\App;

App::initDependencies();

\App\Core\Router::resolvePath();