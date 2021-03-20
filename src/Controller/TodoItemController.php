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

    public function createTodoItem(Request $request, Response $response)
    {
        // Get the fields to be inserted
        $list_id = $request->getAttribute("id");
        $description = $request->getParam("description");
        $due_date = $request->getParam("due_date");
        $is_completed = $request->getParam("is_completed");        

        $added = $this->todoItemRepository->create($description, $due_date, $is_completed, $list_id);
        $response->getBody()->write($added);

        return $response;
    }

    public function updateTodoItem(Request $request, Response $response)
    {
        // Get the ID and name of the item to be updated
        $id = $request->getAttribute("id");
        $description = $request->getParam("description");
        $due_date = $request->getParam("due_date");
        $is_completed = $request->getParam("is_completed"); 

        $updated = $this->todoItemRepository->update($id, $description, $due_date, $is_completed);
        $response->getBody()->write($updated);

        return $response;
    }

    public function deleteTodoItem(Request $request, Response $response) 
    {
        // Get the ID of the item to be deleted
        $id = $request->getAttribute("id");

        $deleted = $this->todoItemRepository->delete($id);
        $response->getBody()->write($deleted);

        return $response;
    }

    public function getAllTodoItemsFromList(Request $request, Response $response)
    {
        // Get the ID of the list to look on
        $id = $request->getAttribute("id");

        // Retrieve and encode to JSON the TodoItems
        $todoLists = $this->todoItemRepository->fetchAllFromList($id);
        $response->getBody()->write(json_encode($todoLists, JSON_NUMERIC_CHECK));

        return $response;
    }

    public function getAllTodoItemsOverdue(Request $request, Response $response)
    {
        // Get the ID of the list to look on
        $id = $request->getAttribute("id");

        // Retrieve and encode to JSON the TodoItems
        $todoLists = $this->todoItemRepository->fetchAllOverdue($id);
        $response->getBody()->write(json_encode($todoLists, JSON_NUMERIC_CHECK));

        return $response;
    }

    public function getAllTodoItemsCompleted(Request $request, Response $response)
    {
        // Get the ID of the list to look on
        $id = $request->getAttribute("id");
        $is_completed = $request->getAttribute("is_completed"); 

        // Retrieve and encode to JSON the TodoItems
        $todoLists = $this->todoItemRepository->fetchAllCompleted($id, $is_completed);
        $response->getBody()->write(json_encode($todoLists, JSON_NUMERIC_CHECK));

        return $response;
    }
}