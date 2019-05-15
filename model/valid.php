<?php

function validName($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return ctype_alpha($data) ? true : false;
}

function validAge($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return (ctype_digit($data)) && ($data > 18) ? true : false;
}

function validPhone($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $data) ? true : false;
}

function validIndoor($interests) {
    $validIndoor = array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading', 'playing cards', 'video games');
    return !empty($interests) && !array_diff($interests, $validIndoor) ? true : false;
}

function validOutdoor($interests) {
    $validOutdoor = array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing');
    return !empty($interests) && !array_diff($interests, $validOutdoor) ? true : false;
}

function validEmail($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return !filter_var($data, FILTER_VALIDATE_EMAIL) ? false : true;
}