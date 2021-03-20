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
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function getAllTodoLists(Request $request, Response $response)
    {
        // Retrieve and encode to JSON the TodoLists
        $todoLists = $this->todoListRepository->fetchAll();
        $response->getBody()->write(json_encode($todoLists, JSON_NUMERIC_CHECK));

        return $response;
    }

    public function createTodoList(Request $request, Response $response)
    {
        // Get the name to be added from the parameters
        $name = $request->getParam("name");

        $added = $this->todoListRepository->create($name);
        $response->getBody()->write($added);

        return $response;
    }

    public function deleteTodoList(Request $request, Response $response) 
    {
        // Get the ID of the list to be deleted
        $id = $request->getAttribute("id");

        $deleted = $this->todoListRepository->delete($id);
        $response->getBody()->write($deleted);

        return $response;
    }

    public function updateTodoList(Request $request, Response $response)
    {
        // Get the ID and name of the list to be updated
        $id = $request->getAttribute("id");
        $name = $request->getParam("name");

        $updated = $this->todoListRepository->update($id, $name);
        $response->getBody()->write($updated);

        return $response;
    }
}
