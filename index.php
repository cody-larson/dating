<?php

/**
 * Index.php will handle routing using the Fat-Free framework
 * @author Cody Larson
 * @date 04-14-19
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Define a default route
$f3->route('GET /', function () {

    //Display a view
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define personal route
$f3->route('GET /personal', function () {

    //Display a view
    $view = new Template();
    echo $view->render('views/personal.php');
});

//Define profile route
$f3->route('GET /profile', function () {

    //Display a view
    $view = new Template();
    echo $view->render('views/profile.php');
});

//Run Fat-Free
$f3->run();