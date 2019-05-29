<?php

/**
 * Index.php will handle routing using the Fat-Free framework
 * @author Cody Larson
 * @date 04-14-19
 */

//Start a session
ob_start();
session_start();

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Required files
require_once('vendor/autoload.php');
require_once('model/valid.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Define arrays
$f3->set('genders', array('Male', 'Female'));
$f3->set('states', array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Puerto Rico', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'));

//Define a default route
$f3->route('GET /', function () {

    //Display a view
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define admin route
$f3->route('GET|POST /admin', function ($f3) {
    $dbh = new Database();
    $dbh->connect();
    $members = $dbh->getMembers();
    $f3->set('members', $members);
    echo Template::instance()->render('views/admin.php');
});


//Define personal route
$f3->route('GET|POST /personal', function ($f3) {

    $f3->set('isValid', TRUE);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['premiumCheck'])) {
            $member = new PremiumMember();
        } else {
            $member = new Member();
        }

        if (isset($_POST['fname']) && $_POST['fname'] != "") {
            $f3->set('first', $_POST['fname']);
        }

        if (empty($_POST['fname'])) {
            $f3->set('fNameErr', "First name is required");
            $f3->set('isValid', FALSE);
        } else {
            if (validName($_POST['fname'])) {
                $member->setFname($_POST['fname']);
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
                $member->setLname($_POST['lname']);
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
                $member->setAge($_POST['age']);
            } else {
                $f3->set('ageErr', "Must enter a valid age over 18");
                $f3->set('isValid', FALSE);
            }
        }

        if (!empty($_POST['gender'])) {
            $f3->set('gend', $_POST['gender']);
            $member->setGender($_POST['gender']);
        }

        if (isset($_POST['phone']) && $_POST['phone'] != "") {
            $f3->set('phone', $_POST['phone']);
        }

        if (empty($_POST['phone'])) {
            $f3->set('phoneErr', "Phone number is required");
            $f3->set('isValid', FALSE);
        } else {
            if (validPhone($_POST['phone'])) {
                $member->setPhone($_POST['phone']);
            } else {
                $f3->set('phoneErr', "Please enter a valid phone number");
                $f3->set('isValid', FALSE);
            }
        }

        $f3->set('premium', $_POST['premiumCheck']);


        $_SESSION['member'] = serialize($member);

        $valid = $f3->get('isValid');

        if ($valid) {
            $f3->reroute('./profile');
        }
    }

    echo Template::instance()->render('views/personal.php');
});

//Define profile route
$f3->route('GET|POST /profile', function ($f3) {

    $f3->set('isValid', TRUE);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $member = unserialize($_SESSION['member']);

        if (isset($_POST['email']) && $_POST['email'] != "") {
            $f3->set('email', $_POST['email']);
        }

        if (empty($_POST['email'])) {
            $f3->set('emailErr', "Email is required");
            $f3->set('isValid', FALSE);
        } else {
            if (validEmail($_POST['email'])) {
                $member->setEmail($_POST['email']);
            } else {
                $f3->set('emailErr', "Not a valid email address");
                $f3->set('isValid', FALSE);
            }
        }

        if (!empty($_POST['state'])) {
            $member->setState($_POST['state']);
        }

        $f3->set('stateOption', $_POST['state']);
        $f3->set('seek', $_POST['seeking']);

        if (!isset($_POST['seeking'])) {
            $f3->set('seekingErr', "Please select Male or Female");
            $f3->set('isValid', FALSE);
        } else {
            $member->setSeeking($_POST['seeking']);
        }

        if (isset($_POST['bio']) && $_POST['bio'] != "") {
            $f3->set('bio', $_POST['bio']);
        }

        if (!empty($_POST['bio'])) {
            $member->setBio($_POST['bio']);
        }

        $_SESSION['member'] = serialize($member);
        $classType = get_class($member);

        $valid = $f3->get('isValid');

        if ($valid && $classType == 'Member') {
            $f3->reroute('./summary');
        }
        if ($valid && $classType == 'PremiumMember') {
            $f3->reroute('./interests');
        }
    }

    echo Template::instance()->render('views/profile.php');
});

//Define interests route
$f3->route('GET|POST /interests', function ($f3) {

    $dbh = new Database();
    $indoorInterests = $dbh->createIndoorInterests();
    $outdoorInterests = $dbh->createOutdoorInterests();
    $inInterests = array();
    $outInterests = array();

    $f3->set('indoors', $indoorInterests);
    $f3->set('outdoors', $outdoorInterests);

    $f3->set('isValid', FALSE);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $member = unserialize($_SESSION['member']);

        if (!empty($_POST['indoorInterests'])) {
            foreach ($_POST['indoorInterests'] as $id) {
                $i = $dbh->getInterest($id);
                array_push($inInterests, $i[0]);
            }
            $f3->set('indoorArray', $inInterests);
            if (validIndoor($inInterests)) {
                $indoors = implode(", ", $inInterests);
                $member->setInDoorInterests($indoors);
                $f3->set('isValid', TRUE);
            }
        }

        if (!empty($_POST['outdoorInterests'])) {
            foreach ($_POST['outdoorInterests'] as $id) {
                $i = $dbh->getInterest($id);
                array_push($outInterests, $i[0]);
            }
            $f3->set('outdoorArray', $outInterests);
            if (validOutdoor($outInterests)) {
                $outdoors = implode(", ", $outInterests);
                $member->setOutDoorInterests($outdoors);
                $f3->set('isValid', TRUE);
            }
        }

        if (!empty($_POST['outdoorInterests']) & !empty($_POST['indoorInterests'])) {
            $allInterests = array_merge($_POST['indoorInterests'], $_POST['outdoorInterests']);
            $_SESSION['interests'] = $allInterests;
        } elseif (!empty($_POST['indoorInterests'])) {
            $allInterests = $_POST['indoorInterests'];
        } elseif (!empty($_POST['outdoorInterests'])) {
            $allInterests = $_POST['outdoorInterests'];
        } else {
            $allInterests = NULL;
        }

        $first = $member->getFname();
        $last = $member->getLname();
        $age = $member->getAge();
        $gender = $member->getGender();
        $phone = $member->getPhone();
        $email = $member->getEmail();
        $state = $member->getState();
        $seeking = $member->getSeeking();
        $bio = $member->getBio();


        $classType = get_class($member);

        $image = NULL;

        if ($classType == 'PremiumMember') {
            $premium = 1;
            $memberKey = $dbh->insertMember($first, $last, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image);
            foreach ($allInterests as $id) {
                $dbh->insertInterests($memberKey, $id);
            }
        } else {
            $premium = 0;
            $dbh->insertMember($first, $last, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image);
        }

        $_SESSION['member'] = serialize($member);

        $valid = $f3->get('isValid');

        if ($valid) {
            $f3->reroute('./summary');
        }

    }

    echo Template::instance()->render('views/interests.php');
});

//Define the summary route
$f3->route('GET|POST /summary', function ($f3) {
    $dbh = new Database();
    $dbh->connect();

    $member = unserialize($_SESSION['member']);

    $first = $member->getFname();
    $f3->set('firstName', $first);
    $last = $member->getLname();
    $f3->set('lastName', $last);
    $age = $member->getAge();
    $f3->set('memberAge', $age);
    $gender = $member->getGender();
    $f3->set('memberGender', $gender);
    $phone = $member->getPhone();
    $f3->set('memberPhone', $phone);
    $email = $member->getEmail();
    $f3->set('memberEmail', $email);
    $state = $member->getState();
    $f3->set('memberState', $state);
    $seeking = $member->getSeeking();
    $f3->set('memberSeeking', $seeking);
    $bio = $member->getBio();
    $f3->set('memberBio', $bio);

    $classType = get_class($member);

    if ($classType == 'PremiumMember') {
        $f3->set('memberIndoor', $member->getInDoorInterests());
        $f3->set('memberOutdoor', $member->getOutDoorInterests());
    }

    $_SESSION['member'] = serialize($member);

    echo Template::instance()->render('views/summary.php');
});

$f3->route('GET|POST /member/@member_id', function($f3, $params) {
    $dbh = new Database();
    $dbh->connect();
    $id = $params['member_id'];
    $member = $dbh->getMember($id);
    $f3->set('firstName', $member[0]['fname']);
    $f3->set('lastName', $member[0]['lname']);
    $f3->set('memberAge', $member[0]['age']);
    $f3->set('memberGender', $member[0]['gender']);
    $f3->set('memberPhone', $member[0]['phone']);
    $f3->set('memberEmail', $member[0]['email']);
    $f3->set('memberState', $member[0]['state']);
    $f3->set('memberSeeking', $member[0]['seeking']);
    $f3->set('memberBio', $member[0]['bio']);
    if ($member[0]['premium'] == 1) {
        $f3->set('memberOutdoor', $member[0]['outdoorInterests']);
        $f3->set('memberIndoor', $member[0]['indoorInterests']);
    }
    echo Template::instance()->render('views/member.php');
});

//Run Fat-Free
$f3->run();