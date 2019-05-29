<?php
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Personal CSS -->
    <link rel="stylesheet" href="./styles/styles.css">

    <title>Dating Site</title>
    <nav class="navbar fixed-top navbar-light bg-light">
        <a class="navbar-brand" href="#">My Dating Website Admin</a>
        <form class="form-inline">
            <a class="btn btn-outline-success my-2 my-sm-0" href="./" role="button">Back</a>
        </form>
    </nav>
</head>
<body>
<div id="container">
    <h1>Members</h1>
    <table class="table table-bordered table-condensed text-center table-striped table-hover" id="admin">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Email</th>
            <th>State</th>
            <th>Gender</th>
            <th>Seeking</th>
            <th>Premium</th>
            <th>Interests</th>
            <th>View Profile</th>
        </tr>
        </thead>
        <tbody>
        <repeat group="{{ @members }}" value="{{ @member }}">
            <tr>
                <td>{{ @member['member_id'] }}</td>
                <td>{{ @member['fname'] }} {{ @member['lname'] }}</td>
                <td>{{ @member['age'] }}</td>
                <td>{{ @member['phone'] }}</td>
                <td>{{ @member['email'] }}</td>
                <td>{{ @member['state'] }}</td>
                <td>{{ @member['gender'] }}</td>
                <td>{{ @member['seeking'] }}</td>
                <check if="{{ @member['premium'] == 1}}">
                    <true><td class="text-center"><input type="checkbox" checked disabled></td></true>
                    <false><td class="text-center"><input type="checkbox" disabled></td></false>
                </check>
                <td>{{ @member['interests'] }}</td>
                <td>
                    <a class="btn btn-outline-success my-2 my-sm-0" href="{{@BASE}}/member/{{ @member['member_id'] }}" role="button">Click here</a>
                </td>
            </tr>
        </repeat>
        </tbody>
    </table>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>