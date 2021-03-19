<?php

use Slim\App;
use TodoApi\Controller\TodoListController;
use TodoApi\TodoListRepository;

// Create a new instance of the app
$app = new App();

// Get the container and give it a TodoListRepository
$container = $app->getContainer();
$container[TodoListRepository::class] = function() {
    return new TodoListRepository();
};

// Get all the TodoLists
$app->get('/list', TodoListController::class . ':getAllTodoLists');
