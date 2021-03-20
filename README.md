# orlo_todo_api
This repository is my implementation of the Todo API as part of the programming assessment for Orlo. It is written in PHP using the Slim framework.

php -S localhost:8888 -t public public/index.php

CREATE DATABASE todo_api;

USE todo_api;
CREATE TABLE todo_list (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE todo_items (
    id INT NOT NULL AUTO_INCREMENT,
    description VARCHAR(255),
    due_date DATE,
    is_completed BOOLEAN,
    list_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (list_id) REFERENCES todo_list(id)    
);