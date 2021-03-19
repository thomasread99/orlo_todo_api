<?php

use Slim\App;
use TodoApi\Controller\TodoListController;
use TodoApi\TodoListRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new App();

$container = $app->getContainer();

$container[TodoListRepository::class] = function() {
    return new TodoListRepository();
};

$app->get('/list', TodoListController::class . ':getAllTodoLists');

$app->run();