# orlo_todo_api
## INTRODUCTION
This is my implementation of the Todo API as part of the programming assessment for Orlo. It is written in PHP using the Slim framework. Although I am familiar with PHP, this is my first time using the Slim framework, although I decided it was a good reason to try and learn something new - however, this means that it may not quite be structured correctly. This API enables users to:
* List all Todo lists
* Create Todo lists
* Delete Todo lists (and their associated Todo items)
* Rename Todo lists
* Create Todo items
* Update Todo items
* Delete Todo items
* List Todo Items
  * Filtered by Todo list
  * Filtered by Overdue
  * Filtered by completion status

## PREREQUISITES
In order to use this program, you must have minimum:
* PHP version 5.5
* Composer Dependency Manager for PHP
* Web server (eg. Apache)
* MySQL

Setup and usage instructions for this program were tested on a Windows 10 system. Modify as appropriate for different systems.

## SETUP
When using the app for the first time, `cd` into the `orlo_todo_api` directory and run
<br>
`composer install`
<br>
to install the relevant composer imports.

### DATABASE
The API is built with MySQL and will require some simple commands during setup for it to work properly.
<br>
Within whatever MySQL environment you are using (command line, phpMyAdmin etc.) run:
<br>
`CREATE DATABASE todo_api;`
<br>
<br>
Once the database has been created, navigate into it (or use `USE todo_api;` if doing it programatically), and run the following two commands:
<br>
`
CREATE TABLE todo_list (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (id)
);
`
<br>
<br>
`
CREATE TABLE todo_items (
    id INT NOT NULL AUTO_INCREMENT,
    description VARCHAR(255),
    due_date DATE,
    is_completed BOOLEAN,
    list_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (list_id) REFERENCES todo_list(id)    
);
`
<br>
MySQL must be running in order for the app to work. Please refer to your web servers documentation for full instructions on this.

<br>
<b>IMPORTANT</b> - in the `src\Config\Database.php` file, you must update the values of `$host, $username, $password` in order for the database connection to work. It is configured by default to run with the root user, with no password, on localhost.

## USAGE
Once all the setup has been complete, you can launch the API using PHPs inbuilt web server by running in the command line:
<br>
`php -S localhost:8888 -t public public/index.php`

### API REQUESTS
You can use any platform for testing the API but I would recommend Postman or Curl. All requests shown below should be preceded by the URL that you are running the API on (http://localhost:8888 if running the same command as above). The HTTP command (GET, POST, PUT, etc.) is shown before each URL path.

#### LIST ALL TODO LISTS
`GET /lists`

#### CREATE TODO LIST
`POST /lists?name=TODO_LIST_NAME`
<br>
Replace `TODO_LIST_NAME` with the name you would like to give your new Todo list

#### DELETE TODO LIST
`DELETE /lists/LIST_ID`
<br>
Replace `LIST_ID` with the ID of the Todo list you would like to delete

#### RENAME TODO LIST
`PUT /lists/LIST_ID?name=TODO_LIST_NAME`
<br>
Replace `LIST_ID` with the ID of the Todo list you would like to rename, and replace `TODO_LIST_NAME` with the name you would like to give the Todo list

#### CREATE TODO ITEM
`POST /lists/LIST_ID/items?due_date=ITEM_DATE&is_completed=ITEM_COMPLETION&description=ITEM_DESCRIPTION`
<br>
Replace `LIST_ID` with the ID of the Todo list you would like to add the item to, replace `ITEM_DATE` with the due date of the item (in the format `dd-mm-yyyy`), replace `ITEM_COMPLETION` with 1 for completed, 0 for incomplete, and replace `ITEM_DESCRIPTION` with the description of the new item

#### UPDATE TODO ITEM
`PUT /lists/LIST_ID/items/ITEM_ID?due_date=ITEM_DATE&is_completed=ITEM_COMPLETION&description=ITEM_DESCRIPTION`
<br>
Replace `LIST_ID` with the ID of the Todo list that the item is in, replace `ITEM_ID` with the ID of the item you would like to update, replace `ITEM_DATE` with the due date of the item (in the format `dd-mm-yyyy`), replace `ITEM_COMPLETION` with 1 for completed, 0 for incomplete, and replace `ITEM_DESCRIPTION` with the description of the item

#### DELETE TODO ITEM
`DELETE /lists/LIST_ID/items/ITEM_ID`
<br>
Replace `LIST_ID` with the ID of the Todo list that the item is in and replace `ITEM_ID` with the ID of the item you would like to delete

#### LIST TODO ITEMS BY TODO LIST
`GET /lists/LIST_ID/items`
<br>
Replace `LIST_ID` with the ID of the Todo list that you want to fetch the items from

#### LIST OVERDUE TODO ITEMS FROM A TODO LIST
`GET /lists/LIST_ID/items/overdue`
<br>
Replace `LIST_ID` with the ID of the Todo list that you want to fetch the items from

#### LIST COMPLETED/INCOMPLETED TODO ITEMS FROM A TODO LIST
`GET /lists/LIST_ID/items/ITEM_COMPLETION`
<br>
Replace `LIST_ID` with the ID of the Todo list that you want to fetch the items from and replace `ITEM_COMPLETION` with true or false, depending on if you want to get complete or incomplete items.


## TROUBLESHOOTING
If you have any problems with setting up, running, or using this application, please do not hesitate to get in touch.