<?php

/**
 * Index.php will handle routing using the Fat-Free framework
 * @author Cody Larson
 * @date 04-14-19
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Required files
require_once('vendor/autoload.php');
require_once('model/valid.php');

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

    $f3->set('isValid', TRUE);

    $f3->set('genders', array('Male', 'Female'));

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['fname']) && $_POST['fname'] != "") {
            $f3->set('first', $_POST['fname']);
        }

        if (empty($_POST['fname'])) {
            $f3->set('fNameErr', "First name is required");
            $f3->set('isValid', FALSE);
        } else {
            if (validName($_POST['fname'])) {
                $_SESSION['fname'] = $_POST['fname'];
            } else {
                $f3->set('fNameErr', "Not a valid first name");
                $f3->set('isValid', FALSE);
            }
        }

        if (isset($_POST['lname']) && $_POST['lname'] != "") {
            $f3->set('last', $_POST['lname']);
        }

        if (empty($_POST['lname'])) {
            $f3->set('lNameErr', "Last name is required");
            $f3->set('isValid', FALSE);
        } else {
            if (validName($_POST['lname'])) {
                $_SESSION['lname'] = $_POST['lname'];
            } else {
                $f3->set('lNameErr', "Not a valid last name");
                $f3->set('isValid', FALSE);
            }
        }

        if (isset($_POST['age']) && $_POST['age'] != "") {
            $f3->set('age', $_POST['age']);
        }

        if (empty($_POST['age'])) {
            $f3->set('ageErr', "Age is required");
            $f3->set('isValid', FALSE);
        } else {
            if (validAge($_POST['age'])) {
                $_SESSION['age'] = $_POST['age'];
            } else {
                $f3->set('ageErr', "Must enter a valid age over 18");
                $f3->set('isValid', FALSE);
            }
        }

        if (isset($_POST['phone']) && $_POST['phone'] != "") {
            $f3->set('phone', $_POST['phone']);
        }

        if (empty($_POST['phone'])) {
            $f3->set('phoneErr', "Phone number is required");
            $f3->set('isValid', FALSE);
        } else {
            if (validPhone($_POST['phone'])) {
                $_SESSION['phone'] = $_POST['phone'];
            } else {
                $f3->set('phoneErr', "Please enter a valid phone number");
                $f3->set('isValid', FALSE);
            }
        }

        $f3->set('gend', $_POST['gender']);
        $_SESSION['gender'] = $_POST['gender'];

        $valid = $f3->get('isValid');
        if ($valid) {
            $f3->reroute('./profile');
        }
    }

    echo Template::instance()->render('views/personal.php');
});

//Define profile route
$f3->route('GET|POST /profile', function ($f3) {

    $f3->set('states', array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Puerto Rico', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'));

    $f3->set('isValid', TRUE);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['email']) && $_POST['email'] != "") {
            $f3->set('email', $_POST['email']);
        }

        if (empty($_POST['email'])) {
            $f3->set('emailErr', "Email is required");
            $f3->set('isValid', FALSE);
        } else {
            if (validEmail($_POST['email'])) {
                $_SESSION['email'] = $_POST['email'];
            } else {
                $f3->set('emailErr', "Not a valid email address");
                $f3->set('isValid', FALSE);
            }
        }

        if (!empty($_POST['state'])) {
            $_SESSION['state'] = $_POST['state'];
        }

        if (!isset($_POST['seeking'])) {
            $f3->set('seekingErr', "Please select Male or Female");
            $f3->set('isValid', FALSE);
        } else {
            $_SESSION['seeking'] = $_POST['seeking'];
        }

        if (isset($_POST['bio']) && $_POST['bio'] != "") {
            $f3->set('bio', $_POST['bio']);
        }

        if (!empty($_POST['bio'])) {
            $_SESSION['bio'] = $_POST['bio'];
        }

        $valid = $f3->get('isValid');

        if ($valid) {
            $f3->reroute('./interests');
        }
    }

    echo Template::instance()->render('views/profile.php');
});

//Define interests route
$f3->route('GET|POST /interests', function ($f3) {
    $f3->set('indoor', array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading', 'playing cards', 'video games'));
    $f3->set('outdoor', array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing'));

    $f3->set('isValid', FALSE);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $f3->set('indoorArray', $_POST['indoorInterests']);
        $f3->set('outdoorArray', $_POST['outdoorInterests']);

        if (validIndoor($_POST['indoorInterests'])) {
            $_SESSION['indoor'] = $_POST['indoorInterests'];
            $f3->set('isValid', TRUE);
        } else {
            $f3->set('isValid', FALSE);
        }

        if (validOutdoor($_POST['outdoorInterests'])) {
            $_SESSION['outdoor'] = $_POST['outdoorInterests'];
            $f3->set('isValid', TRUE);
        } else {
            $f3->set('isValid', FALSE);
        }

        $valid = $f3->get('isValid');

        if ($valid) {
            $f3->reroute('./summary');
        }
    }

    echo Template::instance()->render('views/interests.php');
});

//Define the summary route
$f3->route('GET|POST /summary', function ($f3) {

    $f3->set('firstName', $_SESSION['fname']);
    $f3->set('lastName', $_SESSION['lname']);
    $f3->set('memberAge', $_SESSION['age']);
    $f3->set('memberGender', $_SESSION['gender']);
    $f3->set('memberPhone', $_SESSION['phone']);
    $f3->set('memberEmail', $_SESSION['email']);
    $f3->set('memberState', $_SESSION['state']);
    $f3->set('memberSeeking', $_SESSION['seeking']);
    $f3->set('memberBio', $_SESSION['bio']);

    $indoor = implode(', ', $_SESSION['indoor']);
    $outdoor = implode(', ', $_SESSION['outdoor']);
    $f3->set('memberOutdoor', $outdoor);
    $f3->set('memberIndoor', $indoor);

    //Display summary view
    $view = new Template();
    echo $view->render('views/summary.php');
});

//Run Fat-Free
$f3->run();