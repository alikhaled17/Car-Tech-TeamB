<?php 
    include('../Config.php');
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION['u_id']))      // if there is no valid session
    {
        header("Location:login.php");
    }
    $id = $_SESSION['u_id'];

    $sql="SELECT * FROM users WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    $user_data = mysqli_fetch_array($result);
    
?>
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
    <link rel="stylesheet" href="../css/uProfile.css" />


    <script src="../js/responde.js"></script>    
</head>
<body>
    <?php include('../header.php'); ?>
    <div class="prof-section">
        <div class="container">
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
                <div class="info-prof col-9">
                    <div class="account-name">
                        <h3>
                            <?php 
                                echo $user_data['username'];
                            ?>
                        </h3>
                    </div>
                    <hr>
                    <div class="personal-info">
                    <div class="gender">
                        <?php
                            if ($user_data['gender']== "Male")
                            {
                        ?>
                            <i class="fa fa-male"></i>
                            <span>
                            <?php 
                                echo $user_data['gender']; 
                            ?>
                            </span>
                            <?php
                            }
                            else{
                            ?>
                            <i class="fa fa-female"></i>
                            <span>
                                <?php 
                                    echo $user_data['gender']; 
                                ?>
                            </span>
                            <?php
                            }
                            ?>
                    </div>
                    </div>
                    <div class="phone">
                        <i class="fa fa-phone-square"></i>
                        <span> 
                            <?php
                               echo $user_data['phone'] ;
                            ?>
                        </span>
                    </div>
                    <div class="mail">
                        <i class="fa fa-envelope-square"></i>
                        <span> 
                            <?php
                               echo $user_data['email'] ;
                            ?>
                        </span>
                    </div>
                    <div>
                        <span> 
                            <button class="btn btn-outline-info" onclick="window.location.href ='favoriteUser.php';">
                            Show Favorite 
                             </button>
                        </span>
                        
                    </div>                    
                </div>
               
            </div>
        </div>
    </div>
    <br>
    
    <?php include('../footer.php'); ?>

    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
</body>
</html>