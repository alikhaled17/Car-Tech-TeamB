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
// if (isset($_POST['submit_fav']))
// {
//     if ( $current_id != $id ){
//         echo"in else if ";
//         $conn->query("INSERT INTO favorite (user_id,favorite_id) VALUES ('$current_id','$id')");
//     }
// }
    
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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/contact.css" />
    <link rel="stylesheet" href="../css/fav.css" />


</head>
<body>
    
    <?php include('../header.php'); ?>

        <div class="container">
        <?php include('contact_config.php'); ?>

            <div class="row">
                <div class="left-side col-12">
                    <div class="result">
                        <ul id="result">
                        <?php
                            $sql="SELECT favorite_id FROM favorite WHERE user_id= '$id'";
                            $result=mysqli_query($conn, $sql);
                            
                            if(mysqli_num_rows($result) >= 1)
                            {
                                echo "hhhhhhhh";
                                while($fav_id=mysqli_fetch_array($result)) {
                                    $favSql="SELECT * FROM users WHERE id='".$fav_id['favorite_id']."' " ;
                                    $favResult=mysqli_query($conn, $favSql);

                                    
                                    while($provider=mysqli_fetch_array($favResult)) {
                        
                                        echo ('
                                                <li class="result-card row">
                                                    <div class="lift col-2"> ');
                                        if($provider['prof_img'] == '') {
                                            echo ('<img src="../imgs/default-prof.png"/>');     
                                        } else {
                                            echo ('<img src="data:image/jpg;charset=utf8mb4;base64,'. base64_encode($provider['prof_img']) .'" />');
                                        }
                                        echo   ('</div>'.
                                                '<div class="mid col-7">
                                                    <h5>'.$provider['username'].'</h5>'.
                                                    '<span class="address-card">'.$provider['email'].' - '.$provider['phone'].'</span>
                                                </div>
                                                <div class="right col-3">
                                                <a class="btn btn-outline-dark" target="_blank" href="visitProvider.php?id='.$provider['id'].' ">View</a>
                                                </div>'.
                                            '</li>
                                        ');
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
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
</body>
</html>