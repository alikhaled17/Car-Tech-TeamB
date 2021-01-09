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
    <link rel="icon" href="imgs/icon.png" type="https://car-tch.herokuapp.comimage/icon type">
  
    <link rel="stylesheet" href="https://car-tch.herokuapp.comcss/bootstrap.css">
    <link rel="stylesheet" href="https://car-tch.herokuapp.comfonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://car-tch.herokuapp.comcss/animate.css">
    <link rel="stylesheet" href="https://car-tch.herokuapp.comcss/style.css" />
    <link rel="stylesheet" href="https://car-tch.herokuapp.comcss/fav.css" />


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
                                        if($provider['prof_img'] == '') {
                                            echo ('<a  target="_blank" href="visitProvider.php?id='.$provider['id'].' "><img src="https://car-tch.herokuapp.comimgs/default-prof.png"/></a>');     
                                        } else {
                                            echo ('<a  target="_blank" href="visitProvider.php?id='.$provider['id'].' "><img src="data:image/jpg;charset=utf8mb4;base64,'. base64_encode($provider['prof_img']) .'" /></a>');
                                        }
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
                                echo "<img src='https://car-tch.herokuapp.comimgs/search.png'>";
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
    <script src="https://car-tch.herokuapp.comjs/jquery-3.5.1.min.js"></script>
    <script src="https://car-tch.herokuapp.comjs/bootstrap.min.js"></script>
    <script src="https://car-tch.herokuapp.comjs/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="https://car-tch.herokuapp.comjs/script.js"></script>
</body>
</html>