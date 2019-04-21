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
$f3->route('GET|POST /personal', function ($f3) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];
        $f3->reroute('./profile');
    }

    //Display a view
    $view = new Template();
    echo $view->render('views/personal.php');
});

//Define profile route
$f3->route('GET|POST /profile', function ($f3) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];
        $f3->reroute('./interests');
    }

    $f3->set('states', array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Puerto Rico', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'));

    //Display a view
    $view = new Template();
    echo $view->render('views/profile.php');
});

//Define interests route
$f3->route('GET|POST /interests', function ($f3) {
    $f3->set('indoor', array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading', 'playing cards', 'video games'));
    $f3->set('outdoor', array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing'));

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['indoor'] = $_POST['indoorInterests'];
        $_SESSION['outdoor'] = $_POST['outdoorInterests'];
        $f3->reroute('./summary');
    }

    //Display a view
    $view = new Template();
    echo $view->render('views/interests.php');
});

//Define the summary route
$f3->route('GET|POST /summary', function () {


    //Display summary view
    $view = new Template();
    echo $view->render('views/summary.php');
});

//Run Fat-Free
$f3->run();