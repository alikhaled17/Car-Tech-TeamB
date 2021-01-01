<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Contact</title>
    <!-- my css files -->
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/animate.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/signup.css" />

    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>
</head>

<body>

    <?php include('../header.php'); ?>
    
    <div class="signup row">
        <div class="container">
        <?php include('signup_config.php'); ?>
        
            <div class="left-side col-6">
                <!-- form -->
                <br>
                <h2>Registration</h2>
                <hr>
                <form method="POST" enctype="multipart/form-data">
                    <h4>Account Type</h4>
                    <input type="radio" id="user" name="user-info" value="User" checked />
                    <label for="user">User</label>
                    <input type="radio" id="Provider" name="user-info" value="Provider" />
                    <label for="Provider">Provider</label><br><br>
                    <div class="global-info">
                        <label>User Name</label>
                        <input type="text" name="username" required placeholder="Enter Your User Name *"><br>
                        <label>Password</label>
                        <input type="Password" name="pass" required placeholder="Enter Your Password *"><br>
                        <label>Email</label>
                        <input type="Email" name="email" required placeholder="Enter Your E-mail *"><br>
                        <label>Profile Image</label>
                        <input type="file" name="prof_img" value="none" accept="image/*">
                        <p id="vaild_Email">
                            <p>
                                <label class="gender-h">Gender</label>
                                <input type="radio" name="gender" value="Male" />
                                <label class="gender">Male</label>
                                <input type="radio" name="gender" value="Female" />
                                <label class="gender">Female</label><br>
                                <label>Phone Number</label>
                                <input type="number" name="phone" required placeholder="Enter Your Phone Number"><br>
                    </div>

                    <div class="prov-info" id="provider-info" style="display: none">
                        <h4>services</h4>
                        <div class="service-check">
                            <input type="checkbox" name="Gas_Station">
                            <label>Gas Station</label><br>
                            <input type="checkbox" name="Car_Wash">
                            <label>Car Wash</label><br>
                            <input type="checkbox" name="Car_Maintenance">
                            <label>Car Maintenance</label><br>
                            <input type="checkbox" name="Trailer_Truck">
                            <label>Trailer Truck</label><br>
                        </div>
                        <label>National ID</label>
                        <input type="file" name="nation_id" value="none" accept="image/*">
                        <label>commercial ID</label>
                        <input type="file" name="commerc_id" value="none" accept="image/*"><br><br>
                        <label>City </label>
                        <?php
                            include('search_citis.php'); 
                        ?>
                        <label>Region</label>
                        <select id="Region1" name="Region" class="search-select">
                            <option value="none" selected>Choose ...</option>
                        </select><br><br>
                        <label for="">Street</label>
                        <input type="text" name="street" placeholder="street">
                    </div>
                    <button name="submit" class="btn btn-outline-info">Sign Up</button>
                </form>

            </div>
            <div class="right-side col-5">
                <div class="sign-img">
                    <img src="/Car-Tech-TeamB/imgs/signup.png" width="100%">
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $("input[name='user-info']").click(function() {
                if ($("#Provider").is(":checked")) {
                    $("#provider-info").show();
                } else {
                    $("#provider-info").hide();
                }
            });
        });
    </script>
    <?php include('../footer.php'); ?>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="../js/script.js"></script>
</body>

</html>