<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Profile</title>
    <!-- my css files -->    
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/pProfile.css" />
    <link rel="stylesheet" href="../css/EditPProfile.css" />


    <script src="../js/responde.js"></script>    
</head>
<body>
    <?php include('../header.php'); ?>
    <div class="prof-section">
        <div class="container">
        <?php 
             include('EditProfilePConfig.php'); 
        ?>
        <br>
            <div class="upper-prof row">
                <div class="img-prof col-3">
                    <?php 
                        if($user_data['prof_img'] == '') {
                            ?>
                            <img src="../imgs/default-prof.png"/>       
                            <?php 
                        } else {
                            ?>
                            <img src="data:image/jpg;charset=utf8mb4;base64,<?php echo base64_encode($user_data['prof_img']); ?>" /> 
                            <?php
                        }
                    ?>
                </div>
                <form name="update_user" method="post" action="EditPProfile.php">
                    <div class="info-prof col-9">
                        <div class="account-name">
                            <h3>
                            <input type="text" class="inputStyle" name="username" value="<?php echo $username ?>"  required>
                            </h3>
                        </div>
                        <hr>
                        <div class="personal-info">
                            <input type="password" class="inputStyle" name="pass" value="<?php echo $password ?>" required>
                            <div class="gender">
                                <i class="fa fa-venus-mars"></i>
                                <span class="gender-span">
                                <input type="radio" class="RadioStyle" name="gender" value="Male"  required/>
                                <label class="gender">Male</label>
                                <input type="radio" class="RadioStyle" name="gender" value="Female" required />
                                <label class="gender">Female</label><br>
                                </span>
                            </div>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone-square"></i>
                            <span> 
                                <input class="inputStyle" type="number" name="phone" value="<?php echo $phone ?>" required> 
                            </span>
                        </div>
                        <div class="mail">
                            <i class="fa fa-envelope-square"></i>
                            <span> 
                                <input type="Email" class="inputStyle" name="email" value="<?php echo $email ?>" required>
                            </span>
                        </div>
                        <div class="adress">
                        <i class="fa fa-address-book"></i>
                            <span class="inputStyle"> 
                            <?php
                                echo " " . $user_data['street'] ;
                                echo ",";
                                echo " " . $user_data['region_name'] . " ";
                                echo ",";
                                echo " " . $user_data['city_name'] . " ";
                            ?>  
                            <br>
                            <br>
                                <label class="labelCity" >City </label>
                                <?php include('search_citis.php'); ?>
                                <label class="labelReion">Region</label>
                                <select id="Region1" name="Region" class="search-select">
                                <option value="none" selected>Choose...</option>
                                </select><br><br>
                                <label class="st">Street</label>
                                <input class="street" type="text" name="street" placeholder="street">
                              
                            </span>
                        </div>
                        <div class="service-check">
                            <input type="checkbox" name="Gas_Station">
                            <label class="service">Gas Station</label><br>
                            <input type="checkbox" name="Car_Wash">
                            <label class="service">Car Wash</label><br>
                            <input type="checkbox" name="Car_Maintenance">
                            <label class="service">Car Maintenance</label><br>
                            <input type="checkbox" name="Trailer_Truck">
                            <label class="service">Trailer Truck</label><br>
                        
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </div>
				        <div >
                            <span> 
                            <input type="submit" class="btn btn-outline-info" name="update" value="Update"><br>
                            </span>
                        </div>
                        <div>
                            <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php include('../footer.php'); ?>

    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
</body>
</html>