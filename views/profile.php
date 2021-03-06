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
        <form class="form-inline">
            <a class="btn btn-outline-success my-2 my-sm-0" href="./admin" role="button">Admin</a>
        </form>
    </nav>
</header>
<section id="main">
    <div class="container border rounded pt-3 pb-3">
        <h1>Profile</h1>
        <hr>
        <div class="row">
            <div class="col-8">
                <form id="profileform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="email"><b>Email</b></label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ @email }}">
                        <span class="error"> {{ @emailErr }} </span>
                    </div>
                    <div class="form-group">
                        <label for="state"><b>State</b></label>
                        <select class="form-control" id="state" name="state">
                            <repeat group="{{ @states }}" value="{{ @state }}">
                                <option
                                <check if="{{ @state == @stateOption}}">
                                    selected="selected"
                                </check>
                                > {{ trim(@state) }}</option>
                            </repeat>
                        </select>
                        <span class="error"> {{ @stateErr }} </span>
                    </div>
                    <label><b>Seeking</b></label><br>

                    <repeat group="{{ @genders }}" value="{{ @gender }}">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="seeking"
                                   value="{{ @gender }}"
                            <check if="{{ @gender == @seek }}">
                                checked="checked"
                            </check>
                            >
                            <label class="form-check-label">{{ @gender }}</label>
                        </div>
                    </repeat>
                </form>
                <span class="error"> {{ @seekingErr }} </span>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="biography"><b>Biography</b></label>
                    <textarea class="form-control" id="biography" rows="5" form="profileform" name="bio">
                        {{ @bio }}
                    </textarea>
                </div>
            </div>
            <div class="container text-right mb-2">
                <input class="btn btn-primary" type="submit" form="profileform" value="Next >">
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
