<?php

namespace TodoApi;

use Slim\Http\Request;
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
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }
    }

    /**
     * Create a new TodoList
     */
    public function create(string $name)
    {
        // Query to insert new TodoList
        $sql = "INSERT INTO todo_list (name)
                    VALUES (:name)";

        try {
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();

            // Add the parameters to the query
            $stmt = $database->prepare($sql);
            $stmt->bindParam(":name", $name);

            // Run the query
            $stmt->execute();
            $db = null;

            return '{"notice": {"text": "TodoList Added"}';
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }
    }

    /**
     * Delete a specific TodoList
     */
    public function delete(int $id) {
        // Query to delete the specified TodoList and its associated TodoItems
        $sql = " DELETE FROM todo_items WHERE list_id = $id; DELETE FROM todo_list WHERE id = $id";

        try {            
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();
    
            // Run the query
            $stmt = $database->prepare($sql);
            $stmt->execute();
            $db = null;

            return '{"notice": {"text": "TodoList Deleted"}';
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }
    }

    /**
     * Update the name of a TodoList
     */
    public function update(int $id, string $name) {
        // Query to update the name of the specified TodoList
        $sql = "UPDATE todo_list SET
                    name = :name
                WHERE id = $id";

        try {
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();

            // Add the parameters to the query
            $stmt = $database->prepare($sql);
            $stmt->bindParam(":name", $name);

            // Run the query
            $stmt->execute();
            $db = null;

            return '{"notice": {"text": "TodoList Updated"}';
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }

    }
}
