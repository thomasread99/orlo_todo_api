<?php

namespace TodoApi;

class TodoListRepository
{

    /**
     * @return TodoList[]
     */
    public function fetchAll() : array
    {
        return [
            new TodoList(1, 'Some List')
        ];
    }
}
