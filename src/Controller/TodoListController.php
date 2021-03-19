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
        $response->getBody()->write(json_encode($todoLists));

        return $response;
    }
}
