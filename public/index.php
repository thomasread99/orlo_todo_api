<?php

use Slim\App;
use TodoApi\Controller\TodoListController;
use TodoApi\TodoListRepository;

require_once __DIR__ . '/../vendor/autoload.php';

// Database
require __DIR__ . '/../src/config/Database.php';

// Create a new instance of the app
$app = new App();

// Routes file
require __DIR__ . '/../src/routes/Routes.php';

// Run the app
$app->run();