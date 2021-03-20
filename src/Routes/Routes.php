<?php

use Slim\App;
use TodoApi\Controller\TodoListController;
use TodoApi\TodoListRepository;
use TodoApi\Controller\TodoItemController;
use TodoApi\TodoItemRepository;

// Create a new instance of the app
$app = new App();

// Get the container and give it a TodoListRepository
$container = $app->getContainer();
$container[TodoListRepository::class] = function() {
    return new TodoListRepository();
};
$container[TodoItemRepository::class] = function() {
    return new TodoItemRepository();
};

// Get all the TodoLists
$app->get('/lists', TodoListController::class . ':getAllTodoLists');
// Add a new TodoList
$app->post('/lists', TodoListController::class . ':createTodoList');
// Delete a TodoList
$app->delete('/lists/{id}', TodoListController::class . ':deleteTodoList');
// Update a TodoList
$app->put('/lists/{id}', TodoListController::class . ':updateTodoList');

// Add a new TodoItem
$app->post('/lists/{id}/items', TodoItemController::class . ':createTodoItem');
// Update a TodoItem
$app->put('/lists/{list_id}/items/{id}', TodoItemController::class . ':updateTodoItem');
// Delete a TodoItem
$app->delete('/lists/{list_id}/items/{id}', TodoItemController::class . ':deleteTodoItem');
// Get all the TodoItems from a TodoList
$app->get('/lists/{id}/items', TodoItemController::class . ':getAllTodoItemsFromList');
// Get all the overdue TodoItems from a TodoList
$app->get('/lists/{id}/items/overdue', TodoItemController::class . ':getAllTodoItemsOverdue');
// Get all the completed/incompleted TodoItems from a TodoList
$app->get('/lists/{id}/items/{is_completed}', TodoItemController::class . ':getAllTodoItemsCompleted');