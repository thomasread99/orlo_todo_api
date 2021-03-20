<?php

namespace TodoApi\Controller;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use TodoApi\TodoListRepository;

class TodoListController
{

    /**
     * @var TodoListRepository
     */
    private $todoListRepository;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->todoListRepository = $container->get(TodoListRepository::class);
    }

    /**
     * Function to get all the TodoLists
    */
    public function getAllTodoLists(Request $request, Response $response)
    {
        // Call the fetch function in the repository and return the response
        $todoLists = $this->todoListRepository->fetchAll();
        $response->getBody()->write(json_encode($todoLists, JSON_NUMERIC_CHECK));

        return $response;
    }

    /**
     * Function to create a TodoList
     */
    public function createTodoList(Request $request, Response $response)
    {
        // Get the name to be inserted
        $name = $request->getParam("name");

        // Call the create function in the repository and return the response
        $added = $this->todoListRepository->create($name);
        $response->getBody()->write($added);

        return $response;
    }

    /**
     * Function to delete a TodoList and its associated items
     */
    public function deleteTodoList(Request $request, Response $response) 
    {
        // Get the ID of the list to be deleted
        $id = $request->getAttribute("id");

        // Call the delete function in the repository and return the response
        $deleted = $this->todoListRepository->delete($id);
        $response->getBody()->write($deleted);

        return $response;
    }

    /**
     * Function to update an existing TodoList
     */
    public function updateTodoList(Request $request, Response $response)
    {
        // Get the ID and name of the list to be updated
        $id = $request->getAttribute("id");
        $name = $request->getParam("name");

        // Call the update function in the repository and return the response
        $updated = $this->todoListRepository->update($id, $name);
        $response->getBody()->write($updated);

        return $response;
    }
}
