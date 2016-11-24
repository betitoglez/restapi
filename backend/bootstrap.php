<?php

function unauthorized(){
    header('WWW-Authenticate: Basic realm="Rest API"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}

function login () {
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ) {
        unauthorized();
    }else{
        if ($_SERVER['PHP_AUTH_USER'] != 'user' || $_SERVER['PHP_AUTH_PW'] != 'password'){
            unauthorized();
        }
    }
}


login();

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['data']))
    $_SESSION['data'] = [];


/**
 * An example of a project-specific implementation.

 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = '';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/src/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});