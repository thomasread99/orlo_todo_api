<?php

namespace TodoApi;

use Slim\Http\Request;
use Database;
use PDO;

class TodoItemRepository
{
    /**
     * Create a new TodoItem
     */
    public function create(string $description, string $due_date, int $is_completed, int $list_id)
    {
        // Query to insert new TodoItem
        $sql = "INSERT INTO todo_items (description, due_date, is_completed, list_id)
                    VALUES (:description, :due_date, :is_completed, :list_id)";
        
        // Convert the input date into date format
        $date = strtotime($due_date);
        $dateformat = date('Y-m-d', $date);

        try {
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();

            // Add the parameters to the query
            $stmt = $database->prepare($sql);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":due_date", $dateformat);
            $stmt->bindParam(":is_completed", $is_completed);
            $stmt->bindParam(":list_id", $list_id);

            // Run the query
            $stmt->execute();
            $db = null;

            return '{"notice": {"text": "TodoItem Added"}';
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }
    }

    /**
     * Update a TodoItem
     */
    public function update(int $id, string $description, string $due_date, int $is_completed) {
        // Query to update the specified TodoItem
        $sql = "UPDATE todo_items SET
                    description = :description,
                    due_date = :due_date,
                    is_completed = :is_completed
                WHERE id = $id";

        // Convert the input date into date format
        $date = strtotime($due_date);
        $dateformat = date('Y-m-d', $date);

        try {
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();

            // Add the parameters to the query
            $stmt = $database->prepare($sql);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":due_date", $dateformat);
            $stmt->bindParam(":is_completed", $is_completed);

            // Run the query
            $stmt->execute();
            $db = null;

            return '{"notice": {"text": "TodoItem Updated"}';
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }

    }

    /**
     * Delete a specific TodoItem
     */
    public function delete(int $id) {
        // Query to delete the specified TodoItem
        $sql = "DELETE FROM todo_items WHERE id = $id";

        try {            
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();
    
            // Run the query
            $stmt = $database->prepare($sql);
            $stmt->execute();
            $db = null;

            return '{"notice": {"text": "TodoItem Deleted"}';
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }
    }

    /**
     * Return all TodoItems associated with a TodoList
     */
    public function fetchAllFromList(int $id)
    {
        // Query to select all the TodoItems associated with a TodoList
        $sql = "SELECT ti.id, ti.description, ti.due_date, CASE WHEN ti.is_completed = 1 THEN 'True' ELSE 'False' END AS is_completed, tl.name AS list_name FROM todo_items ti
                JOIN todo_list tl ON ti.list_id = tl.id
                WHERE ti.list_id = $id";

        try {
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();

            // Run the query
            $stmt = $database->query($sql);
            $todoItems = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $todoItems;
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }
    }

    /**
     * Return all overdue TodoItems associated with a TodoList
     */
    public function fetchAllOverdue(int $id)
    {
        // Query to select all the TodoItems that are overdue from a TodoList
        $sql = "SELECT ti.id, ti.description, ti.due_date, CASE WHEN ti.is_completed = 1 THEN 'True' ELSE 'False' END AS is_completed, tl.name AS list_name FROM todo_items ti
                JOIN todo_list tl ON ti.list_id = tl.id
                WHERE ti.list_id = $id AND ti.due_date < CURRENT_DATE AND ti.is_completed = 0";

        try {
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();

            // Run the query
            $stmt = $database->query($sql);
            $todoItems = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $todoItems;
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }
    }

    /**
     * Return all completed/uncompleted TodoItems associated with a TodoList
     */
    public function fetchAllCompleted(int $id, string $completed)
    {
        // Query to select all the TodoItems that are completed/uncompleted from a TodoList
        $sql = "SELECT ti.id, ti.description, ti.due_date, CASE WHEN ti.is_completed = 1 THEN 'True' ELSE 'False' END AS is_completed, tl.name AS list_name FROM todo_items ti
                JOIN todo_list tl ON ti.list_id = tl.id
                WHERE ti.list_id = $id AND ti.is_completed IS $completed";

        try {
            // Get database object
            $database = new Database();
            // Connect to the database
            $database = $database->connect();

            // Run the query
            $stmt = $database->query($sql);
            $todoItems = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $todoItems;
        }
        catch (PDOException $exception) {
            echo '{"error": {"text": '.$exception->getMessage().'}';
            return null;
        }
    }
}