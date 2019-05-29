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
        <h1>Interests</h1>
        <hr>
        <label><b>Indoor Interests</b></label>
        <form id="interestform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container-fluid">
                <repeat group="{{ @indoors }}" value="{{ @indoor }}">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="indoorInterests[]" value="{{ @indoor['interest_id']}}"
                        <check if="{{ !empty(@indoorArray) && in_array(@indoor, @indoorArray) }}">
                            checked="checked"
                        </check>
                        >
                        <label class="form-check-label">{{ @indoor['interest'] }}</label>
                    </div>
                </repeat>
            </div>
            <label class="mt-2"><b>Outdoor Interests</b></label>
            <div class="container-fluid">
                <repeat group="{{ @outdoors }}" value="{{ @outdoor }}">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="outdoorInterests[]"
                               value="{{ @outdoor['interest_id']}}"
                        <check if="{{ !empty(@outdoorArray) && in_array(@outdoor, @outdoorArray) }}">
                            checked="checked"
                        </check>
                        >
                        <label class="form-check-label">{{ @outdoor['interest'] }}</label>
                    </div>
                </repeat>
            </div>
        </form>
        <div class="container text-right mb-2">
            <button class="btn btn-primary" type="submit" form="interestform"> Next ></button>
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

