<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Contact</title>
    <!-- my css files -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/services.css" />

    <script src="../js/responde.js"></script>
</head>

<body>
    <!-- Header -->
    <?php include('../header.php'); ?>
    <!-- Services -->


    <!-- Search -->
    <div class="outer">
        <div class="container">
            <div class="row">
                <div class="right-side col-6">
                    <h3>Select Choose</h3><hr class="hr">
                    <br>
                    <div class="form-body">
                        <form class="test" action="services.php" method= "post">
                            <!-- Service -->
                            <label class="label">Service</label>
                            <?php include('search_service.php'); ?>

                             <!-- City -->
                            <label class="label">City</label>
                            <?php include('search_citis.php'); ?>

                            <!-- Region -->
                            <label class="label">Region</label>
                            <select id="Region1" name="Region" class="search-select">
                                <option value="none" selected >Choose...</option>
                            </select>
                            <hr>

                            <!-- Name -->
                            <label class="label">Name</label>
                            <input id="name_p" type="text" placeholder="Search.." name="search_name"> <br>

                            <!-- search_submit -->
                            <input class="btn btn-outline-dark" type="submit" value="Search" name="search" >
                        </form>
                    </div>
                </div>

                <!-- result -->
                <div class="left-side col-6">
                    <div class="result">
                        <ul id="result">
                    <?php include('search_submit.php'); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>
    <script src="../js/script.js"></script>
</body>
</html>