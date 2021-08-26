<?php
    
/* Define the source database */
define("SOURCE_DB_NAME", 'database_name'); //Source Database Name
define("SOURCE_DB_USER", 'user_name'); //Source Database User Name
define("SOURCE_DB_PASSWORD", 'user_password'); //Source Database User Password
define("SOURCE_DB_HOST", '111.11.1.11'); // Source Database Host Address

/* Define the target database */
define("TARGET_DB_NAME", 'database_name'); //Target Database Name
define("TARGET_DB_USER", 'user_name'); //Target Database User Name
define("TARGET_DB_PASSWORD", 'user_password'); //Target Database User Password
define("TARGET_DB_HOST", 'localhost'); // Target Database Host Address

/* Tables to synchronize */
define("TABLES", 'Departments, Brands');

/* The sql file for storing backup */
define("OUTPUT_DIR", __DIR__ . '/sql/'); 
define("OUTPUT_FILE", OUTPUT_DIR . 'tables.sql'); 



//Autoload required classes
spl_autoload_register(function($class){
    include __DIR__ .'/classes/'. $class . '.php';
});