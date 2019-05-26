<?php

?>

<!doctype html>
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
        <h1>Personal Information</h1>
        <hr>
        <div class="row">
            <div class="col-8">
                <form id="personalform" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="fname"><b>First Name</b></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="fname" name="fname" value="{{ @first }}">
                            <span class="input-group-append">
                            <div class="input-group-text bg-transparent">
                                <i class="fas fa-address-card"></i>
                            </div>
                        </span>
                        </div>
                        <span class="error"> {{ @fNameErr }} </span>
                    </div>
                    <div class="form-group">
                        <label for="lname"><b>Last Name</b></label>
                        <input type="text" class="form-control" id="lname" name="lname" value="{{ @last }}">
                        <span class="error"> {{ @lNameErr }} </span>
                    </div>
                    <div class="form-group">
                        <label for="age"><b>Age</b></label>
                        <input type="text" class="form-control" id="age" name="age" value="{{ @age }}">
                        <span class="error"> {{ @ageErr }} </span>
                    </div>
                    <label><b>Gender</b></label><br>

                    <repeat group="{{ @genders }}" value="{{ @gender }}">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"
                                   value="{{ @gender }}"
                            <check if="{{ @gender == @gend }}">
                                checked="checked"
                            </check>
                            >
                            <label class="form-check-label">{{ @gender }}</label>
                        </div>
                    </repeat>
                    <div class="form-group mt-2">
                        <label for="phone"><b>Phone Number</b></label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="xxx-xxx-xxxx"
                               value="{{ @phone }}">
                        <span class="error"> {{ @phoneErr }} </span>
                    </div>
                    <label><b>Premium Membership</b></label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="premiumCheck" name="premiumCheck"
                        <check if="{{ !empty(@premium) }}">
                            checked="checked"
                        </check>
                        >
                        <label class="form-check-label" for="premiumCheck">
                            Sign me up for a Premium Account!
                        </label>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <div class="container bg-light border rounded text-center mt-4 pt-1">
                    <p><b>Note:</b> All information entered is protected by our <a href="">privacy policy</a>. Profile
                        information can only be viewed by others with your permission. </p>
                </div>
            </div>
            <div class="container text-right mb-2">
                <input class="btn btn-primary" type="submit" form="personalform" value="Next >">
            </div>
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
