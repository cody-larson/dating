<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Personal CSS -->
    <link rel="stylesheet" href="./styles/styles.css">

    <title>Dating Site</title>
</head>
<body>
<header>
    <nav class="navbar fixed-top navbar-light bg-light border-bottom">
        <a class="navbar-brand" href="#">My Dating Website</a>
    </nav>
</header>
<section id="main">
    <div class="container border rounded pt-3 pb-3">
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">Name: {{ @firstName }} {{@lastName}}</li>
                    <check if="{{ @memberGender == '' }}">
                        <false>
                            <li class="list-group-item">Gender: {{ @memberGender }}</li>
                        </false>
                    </check>
                    <li class="list-group-item">Age: {{ @memberAge }}</li>
                    <li class="list-group-item">Phone: {{ @memberPhone }}</li>
                    <li class="list-group-item">Email: {{ @memberEmail}}</li>
                    <li class="list-group-item">State: {{ @memberState }}</li>
                    <li class="list-group-item">Seeking: {{ @memberSeeking }}</li>
                    <check if="{{ @memberOutdoor == '' && @memberIndoor == '' }}">
                        <false>
                            <li class="list-group-item">Interests: {{ @memberIndoor}}, {{ @memberOutdoor }}</li>
                        </false>
                    </check>
                </ul>
            </div>
            <div class="col-md-6 text-center">
            <span style="font-size: 200px; color: Tomato;">
                <i class="fas fa-user"></i>
            </span>
                <div class="container">
                    <h3>Biography</h3>
                    <p> {{ @memberBio }}</p>
                </div>
            </div>
        </div>
        <div class="container text-center mt-2 mb-2">
            <a href="./" class="btn btn-primary btn-lg" role="button"> Contact Me! </a>
        </div>
    </div>
</section>

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
