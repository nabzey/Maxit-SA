<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/config/helpers.php';

use App\core\Router;
use App\Core\App;

App::initDependencies();

\App\Core\Router::resolvePath();

