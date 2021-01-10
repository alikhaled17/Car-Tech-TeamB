<?php 
    include('../Config.php');
    session_start();
    session_regenerate_id();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Edit Profile</title>
    <!-- my css files -->    
    <link rel="icon" href="../imgs/icon.png" type="image/icon type">

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/EditPProfile.css" />
    <link rel="stylesheet" href="../css/uProfile.css" />
    <link rel="stylesheet" href="../css/EditPProfile.css" />

</head>
<body>
    <?php include('../header.php'); ?>
    <div class="prof-section">
        <div class="container">
            <div class="upper-prof row">
            <?php 
            include('EditUProfileConf.php'); 
            ?>
                <div class="img-prof col-3">
                <form name="update_user" method="post" action="EditUProfile.php">
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
                    <div class="info-prof col-9">
                        <div class="account-name" style>
                            <label>User Name</label><br>
                            <input type="text" class="inputStyle" name="username" value="<?php echo $user_data['username']; ?>"  required>
                        </div>
                        <hr>
                        <div class="personal-info">
                            <label>password</label><br>
                            <input type="password" class="inputStyle" id="myInput" name="pass" value="<?php echo $user_data['password']; ?>" required>
                            <img src="../imgs/eye-slash-512.png" width="20px" onclick=" myFunction();" style="cursor: pointer;" />
                            
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone-square"></i>
                            <span> 
                                <input class="inputStyle" type="number" name="phone" value="<?php echo $phone; ?>" required> 
                            </span>
                        </div>
                        <div class="mail">
                            <i class="fa fa-envelope-square"></i>
                            <span> 
                                <input type="Email" class="inputStyle" name="email" value="<?php echo $email; ?>" required>
                            </span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div >
                            <span> 
                            <input type="submit" class="btn btn-outline-info loc" name="update" value="Update">
                            </span>
                        </div>
                        <br>
				        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php include('../footer.php'); ?>

    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/Password.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
</body>
</html>