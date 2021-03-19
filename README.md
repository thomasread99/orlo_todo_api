# orlo_todo_api
This repository is my implementation of the Todo API as part of the programming assessment for Orlo. It is written in PHP using the Slim framework.

CREATE DATABASE todo_api;

USE todo_api;
CREATE TABLE todo_list (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (ID)
);