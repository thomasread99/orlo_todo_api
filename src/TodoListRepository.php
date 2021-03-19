<?php

namespace TodoApi;

use Database;
use PDO;

class TodoListRepository
{

    /**
     * Return all TodoLists in the database
     */
    public function fetchAll()
    {
        // Query to select all the TodoLists
        $sql = "SELECT * FROM todo_list";

        try {
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();

            // Run the query
            $stmt = $database->query($sql);
            $todoLists = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $todoLists;
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$e->getMessage().'}';
            return null;
        }
    }
}
