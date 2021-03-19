<?php

class Database {
    // Database properties - REPLACE WITH YOUR DB PROPERTIES    
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'todo_api';

    /**
     * Connect to the database
     */ 
    public function connect() {
        // Create the connection string
        $connString = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        // Initialise the connection
        $dbConnection = new PDO($connString, $this->username, $this->password);
        // Set the attributes
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $dbConnection;
    }

}