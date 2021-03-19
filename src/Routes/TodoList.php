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
// Add a new TodoList
$app->post('/list/add', TodoListController::class . ':createTodoList');
// Delete a TodoList
$app->delete('/list/delete/{id}', TodoListController::class . ':deleteTodoList');
