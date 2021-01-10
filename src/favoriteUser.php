<?php
include('../Config.php');  
ob_start();
session_start();
    if (isset($_SESSION['u_id']))
    {
        $id=$_SESSION['u_id'];
    }
    else
    {
        $id=$_SESSION['p_id'];
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Favorite </title>
    <!-- my css files -->  
    <link rel="icon" href="../imgs/icon.png" type="image/icon type">
  
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/fav.css" />


</head>
<body>
    
    <?php include('../header.php'); ?>

        <div class="container">
        <?php include('contact_config.php'); ?>

            <div class="row">
                <div class="left-side col-12">
                    <h2>Results</h2>
                    <div class="result">
                        <ul id="row">
                        <?php
                            $sql="SELECT favorite_id FROM favorite WHERE user_id= '$id'";
                            $result=mysqli_query($conn, $sql);
                            
                            if(mysqli_num_rows($result) >= 1)
                            {
                                while($fav_id=mysqli_fetch_array($result)) {
                                    $favSql="SELECT * FROM users WHERE id='".$fav_id['favorite_id']."' " ;
                                    $favResult=mysqli_query($conn, $favSql);

                                    
                                    while($provider=mysqli_fetch_array($favResult)) {
                        
                                        echo ('
                                                <li class="result-card">
                                                <div class="lift"> ');
                                        echo ('<a  target="_blank" href="visitProvider.php?id='.$provider['id'].' "><img src="../imgs/default-prof.jpg"/></a>');     
                                        echo   ('</div>'.
                                                '<div class="name-hover">
                                                    <h6>'.$provider['username'].'</h6>
                                                </div>
                                                <div class="x">
                                                    <a class="ax"  href="del_fav.php?id='.$provider['id'].' ">x</a>
                                                </div>
                                            </li>');
                                    }
                                }
                            } 
                            else {
                                echo "<div class='no-result'>";
                                echo "<img src='../imgs/search.png'>";
                                echo "<h5>No members in your favorite list!</h5>";
                                echo "</div>";
                            }
                        ?>
                        </ul>
                    </div>
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