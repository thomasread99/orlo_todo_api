<?php

namespace TodoApi\Controller;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use TodoApi\TodoItemRepository;

class TodoItemController
{
    /**
     * @var TodoItemRepository
     */
    private $todoItemRepository;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->todoItemRepository = $container->get(TodoItemRepository::class);
    }    

    /**
     * Function to create a new TodoItem
     */
    public function createTodoItem(Request $request, Response $response)
    {
        // Get the fields to be inserted
        $list_id = $request->getAttribute("id");
        $description = $request->getParam("description");
        $due_date = $request->getParam("due_date");
        $is_completed = $request->getParam("is_completed");        

        // Call the create function in the repository and return the response
        $added = $this->todoItemRepository->create($description, $due_date, $is_completed, $list_id);
        $response->getBody()->write($added);

        return $response;
    }

    /**
     * Function to update an existing TodoItem
     */
    public function updateTodoItem(Request $request, Response $response)
    {
        // Get the ID and the fields to be updated
        $id = $request->getAttribute("id");
        $description = $request->getParam("description");
        $due_date = $request->getParam("due_date");
        $is_completed = $request->getParam("is_completed"); 

        // Call the update function in the repository and return the response
        $updated = $this->todoItemRepository->update($id, $description, $due_date, $is_completed);
        $response->getBody()->write($updated);

        return $response;
    }

    /**
     * Function to delete a TodoItem
     */
    public function deleteTodoItem(Request $request, Response $response) 
    {
        // Get the ID of the item to be deleted
        $id = $request->getAttribute("id");

        // Call the delete function in the repository and return the response
        $deleted = $this->todoItemRepository->delete($id);
        $response->getBody()->write($deleted);

        return $response;
    }

    /**
     * Function to filter the TodoItems by TodoList
     */
    public function getAllTodoItemsFromList(Request $request, Response $response)
    {
        // Get the ID of the list to look in
        $id = $request->getAttribute("id");

        // Call the function to fetch the items from the list and return the response
        $todoLists = $this->todoItemRepository->fetchAllFromList($id);
        $response->getBody()->write(json_encode($todoLists, JSON_NUMERIC_CHECK));

        return $response;
    }

    /**
     * Function to filter the TodoItems that are overdue
     */
    public function getAllTodoItemsOverdue(Request $request, Response $response)
    {
        // Get the ID of the list to look in
        $id = $request->getAttribute("id");

        // Call the function to fetch the items from the list that are overdue and return the response
        $todoLists = $this->todoItemRepository->fetchAllOverdue($id);
        $response->getBody()->write(json_encode($todoLists, JSON_NUMERIC_CHECK));

        return $response;
    }

    /**
     * Function to filter the TodoItems by completion
     */
    public function getAllTodoItemsCompleted(Request $request, Response $response)
    {
        // Get the ID of the list to look in
        $id = $request->getAttribute("id");
        $is_completed = $request->getAttribute("is_completed"); 

        // Call the function to fetch the items from the list that are completed/uncompleted and return the response
        $todoLists = $this->todoItemRepository->fetchAllCompleted($id, $is_completed);
        $response->getBody()->write(json_encode($todoLists, JSON_NUMERIC_CHECK));

        return $response;
    }
}