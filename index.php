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

ob_start();
session_start();

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
$f3->route('GET|POST /personal', function () {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];
    }

    //Display a view
    $view = new Template();
    echo $view->render('views/personal.php');
});

//Define profile route
$f3->route('GET|POST /profile', function () {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];
    }

    //Display a view
    $view = new Template();
    echo $view->render('views/profile.php');
});

//Define interests route
$f3->route('GET /interests', function () {

    //Display a view
    $view = new Template();
    echo $view->render('views/interests.php');
});

//Run Fat-Free
$f3->run();