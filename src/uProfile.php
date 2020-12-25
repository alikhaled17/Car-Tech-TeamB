<?php 
    include('../Config.php');  
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION['u_id']))      // if there is no valid session
    {
        header("Location:login.php");
    }
    $id = $_SESSION['u_id'];

    $sql="SELECT *
        FROM users
        WHERE
            users.id = '$id'";

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
        <!-- Start Upper Bar -->
        <div class="upper-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <i class="fa fa-phone"></i><span> +20 111 2332 199</span>,
                    <i class="fa fa-envelope-o"></i> CarTech@gmail.com
                </div>
                <div class="col-sm text-right">
                    <span>Let's Work Together! </span>
                    <span class="get-quote">Get Qoute</span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Upper Bar -->
    <!-- Start Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" data-wow-duration='.5s' href="#">
                <img class="wow wobble" src="/Car-Tech-TeamB/imgs/logo1.png" alt="car-tech" width="100px">
                <span>Car</span><span>Tech</span>
            </a>

            <div class="collapse navbar-collapse" id="ournavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/src/uProfile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/src/services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/src/contact.php">Contact US</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Settings
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- <a class="dropdown-item " href="/Car-Tech-TeamB/src/signup.php">Sign up</a>
                            <a class="dropdown-item " href="/Car-Tech-TeamB/src/login.php">Login</a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " href="/Car-Tech-TeamB/src/logoutU.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                            <i class="fa fa-venus-mars"></i>
                            <span>
                                <?php
                                    echo $user_data['gender'] ;
                                ?>
                            </span>
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
                </div>
            </div>
        </div>
    </div>
    
    <!-- Services -->
    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
</body>
</html>