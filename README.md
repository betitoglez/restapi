# Rest Api

Rest Api is a CRUD api to manage events. 

## Creating a lite server instance

Move to the project path and run the following command
```sh
$ php -S <your_ip>:<your_port>
```

Navigate to http://<your_ip>:<your_port>/frontend and start working there with the CRUD Interface

## Basic Auth

Default credentials are **user** and **password**. God forgive me for this! ;-)

## Available Webservices
 **Base Url** 
 ***/backend/***
| URL        | HTTP METHOD           | Mandatory Parameters  |
| ------------- |:-------------:| -----:|
| list.php   | GET | |
| add.php   | POST | name , type , date |
| edit.php      | PUT      |   id |
| delete.php | DELETE     |    id |