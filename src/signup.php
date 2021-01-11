<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Registration</title>
    <!-- my css files -->
    <link rel="icon" href="../imgs/icon.png" type="image/icon type">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/animate.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/signup.css" />

    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>
</head>

<body>
    <script type="text/javascript">

        function handleData()
        {
            var form_data = new FormData(document.querySelector("form"));
            
            if(!form_data.has("ser_name[]"))
            {
                document.getElementById("chk_option_error").style.visibility = "visible";
            return false;
            }
            else
            {
                document.getElementById("chk_option_error").style.visibility = "hidden";
            return true;
            }
            
        }
    </script>
    <?php include('../header.php'); ?>
    
    <div class="signup row">
        <div class="container">
        <?php include('signup_config.php');
        $user_type="User"; ?>
        <span class="result" ><?php echo $user_type; ?></span></h3>
            <div class="left-side col-6">
                <!-- form -->
                <br>
                <h2>Registration</h2>
                <hr>
                <form method="POST" onsubmit="return handleData()" enctype="multipart/form-data">
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
                        <p id="vaild_Email"> </p>
                        <label>Phone Number</label>
                        <input type="number" name="phone" required placeholder="Enter Your Phone Number"><br>
                        <?php if ($user_type=="User"){ ?>
                            <div id="User-info">
                            <label class="gender-h">Gender</label>
                            <input type="radio" name="gender" value="Male" />
                            <label class="gender">Male</label>
                            <input type="radio" name="gender" value="Female" />
                            <label class="gender">Female</label><br>
                            <label>Profile Image</label>
                            <input type="file" name="prof_img" value="none" accept="image/*">
                        </div>
                        <?php } ?>
                        
                    </div>
                    <?php if ($user_type=="Provider"){ ?>
                        <div class="prov-info" id="provider-info" style="display: none">
                            <h4>services *</h4>
                            <div class="service-check">
                                <?php 
                                $selected_service_ids =  "";
                                include_once('include_service.php'); ?>
                            </div>
                            <div style="visibility:hidden; color:red; " id="chk_option_error">
                                Please select at least one option.
                            </div>
                            
                            <label>National ID *</label>
                            <input type="file" name="nation_id" value="none" accept="image/*">
                            <label>commercial ID *</label>
                            <input type="file" name="commerc_id" value="none" accept="image/*"><br><br>
                            <label>City *</label>
                            <?php
                                include('search_citis.php'); 
                            ?>
                            <label>Region *</label>
                            <select id="Region1" name="Region" class="search-select">
                                <option value="none" selected>Choose ...</option>
                            </select><br><br>
                            <label for="">Street *</label>
                            <input type="text" name="street" placeholder="street">
                        </div>
                    <?php } ?>
                    <button name="submit" class="btn btn-outline-info">Sign Up</button>
                </form>

            </div>
            <div class="right-side col-5">
                <div class="sign-img">
                    <img src="../imgs/signup.png" width="100%">
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $("input[name='user-info']").click(function() {

                var gender = $(this).val(); 
                 $('.result').html(gender);

                /* if ($("#Provider").is(":checked")) {
                    $("#provider-info").show();
                } else {
                    $("#provider-info").hide();
                } */
            });
        });
        // $(function() {
        //     $("input[name='user-info']").click(function() {
        //         if ($("#User").is(":checked")) {
        //             $("#User-info").show();
        //         } else {
        //             $("#User-info").hide();
        //         }
        //     });
        // });
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