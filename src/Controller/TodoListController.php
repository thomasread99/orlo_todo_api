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
        $data = [];
        $items = $this->todoListRepository->fetchAll();
        foreach ($items as $item) {
            $data[] = [
                'id' => $item->id(),
                'name' => $item->name(),
            ];
        }
        return $response->withJson(['data' => $data]);
    }
}
