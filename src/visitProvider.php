<?php 
    include('../Config.php');  
    ob_start();
    session_start();
    $id =  $_GET['id']; 
    // $page = $_SERVER['PHP_SELF'];
    if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) )  
    {
        if (isset($_SESSION['u_id']))
        {
            $current_id=$_SESSION['u_id'];
            // echo $u_id ;
        }
        else
        {
            $current_id=$_SESSION['p_id'];
            // echo $p_id ;
        }
    }
    $sql="SELECT users.*,
        providers.comm_img,
        providers.ID_img,
        p_address.street,
        cities.city_name,
        regions.region_name,
        services.ser_name
    
        FROM (((((( users
        inner join providers on providers.user_id = users.id)
        inner join prov_services on prov_services.p_id = providers.user_id )
        inner join services on prov_services.ser_id = services.id )
        inner join p_address on p_address.p_id = providers.user_id)
        inner join regions on regions.id = p_address.region_id)
        inner join cities on cities.id = regions.city_id )
        WHERE
            users.id = '$id'";

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    $user_data = mysqli_fetch_array($result);
                            
    if (isset($_POST['add_fav']))
    {
        if ( $current_id != $id ){
            // echo"in else if ";
            $conn->query("INSERT INTO favorite (user_id,favorite_id) VALUES ('$current_id','$id')");
        }
    }
    if (isset($_POST['remove_fav']))
    {
        $conn->query("DELETE FROM favorite WHERE user_id = '$current_id' AND favorite_id='$id' ");
    }                   
    // header("Location:visitProvider.php?id='.$id.' ");                    

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
    <link rel="stylesheet" href="../css/pProfile.css" />


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
                            <div class='imgProf'>
                            <img src="../imgs/default-prof.png"/>       
                            </div>
                            <?php 
                        } else {
                            ?>
                            <div class='imgProf'>
                            <img src="data:image/jpg;charset=utf8mb4;base64,<?php echo base64_encode($user_data['prof_img']); ?>" /> 
                            </div>
                            <?php
                        }
                        if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) ) 
                        {
                            $search_sql="SELECT favorite_id FROM favorite WHERE user_id = '$current_id' AND favorite_id='$id'  " ;
                            $search_result = mysqli_query($conn, $search_sql);
                            // $search_rows = mysqli_num_rows($search_result);
                            if(mysqli_num_rows($search_result) != 1)
                        {
                    ?>
                        
                        <!-- // $search_sql="SELECT favorite_id FROM favorite WHERE user_id = '$current_id' AND favorite_id='$id'  " ;
                        // $search_result = mysqli_query($conn, $search_sql);
                        // // $search_rows = mysqli_num_rows($search_result);
                        // if(mysqli_num_rows($search_result) != 1)
                        // { -->
                    
                        <form method="POST" >
                            <button class="btn btn-outline-info Add" name="add_fav"> Add To Favorite  </button>
                        </form>
                        
                    <?php
                        }
                        else
                        { ?>
                        <form method="POST">
                            <button class="btn btn-outline-info Add" name="remove_fav"> Remove From Favorite  </button>
                        </form>
                        <?php
                        }
                    }
                    if(!isset($_SESSION['p_id']) && !isset($_SESSION['u_id']) )
                    {
                    ?>
                    
                    <form action='login.php' >
                        <button class="btn btn-outline-info Add" name="add_fav"> Add To Favorite  </button>
                    </form>
                    <?php
                     } 
                    ?>
                </div>
                
                
                <div class="col-9 contact-info">
                    <div class="account-name">
                        <h3>
                            <?php 
                                echo $user_data['username'];
                            ?>
                        </h3>
                    </div>
                    <div class="gender">
                        <i class="fa fa-venus-mars"></i>
                        <span>
                            <?php 
                                echo $user_data['gender'];
                            ?>
                        </span>
                    </div>
                    <div class="phone">
                        <i class="fa fa-phone-square"></i>
                        <span>
                            <?php 
                                echo $user_data['phone'];
                            ?>
                        </span>
                    </div>
                    <div class="mail">
                        <i class="fa fa-envelope-square"></i>
                        <span>
                            <?php 
                                echo $user_data['email'];
                            ?>
                        </span>
                    </div>
                    <div class="adress">
                        <i class="fa fa-address-book"></i>
                        <span> <?php
                            echo " " . $user_data['street'] ;
                            echo ",";
                            echo " " . $user_data['region_name'] . " ";
                            echo ",";
                            echo " " . $user_data['city_name'] . " ";
                        ?>  
                        </span>
                        <?php
                            $sql="SELECT * FROM coordinates WHERE p_id = '$id' ";
                            $Result = mysqli_query($conn, $sql);
                            
                            if(mysqli_num_rows($Result) == 1) {
                                $Location = mysqli_fetch_array($Result);
                                $lon= $Location['longitude'];
                                $lat= $Location['latitude'];
                        ?>
                            <button class="go btn btn-outline-info">
                                <?php 
                                    echo "<a class='location' href='https://www.google.com/maps/?q=".$lat.",".$lon."'"." target='_blank'> Go |  </a>   ";
                                ?>
                                <!-- <a> Go |  </a>    -->
                                <i class="fa fa-location-arrow"></i>
                            </button>
                        <?PHP } ?>
                    </div>
                </div>
                <div class="services-prof col-12">
                    <h4>Services</h4>
                    <ul>
                        <?php
                            $sql = "SELECT * FROM prov_services WHERE p_id = '$id'";
                            $res = mysqli_query($conn, $sql);
                            
                            // echo"befor whil 1";
                            while($ser_id = mysqli_fetch_array($res))
                            {
                                $Sql_ser="SELECT * FROM services WHERE id = ".$ser_id['ser_id']." ";
                                $res_Ser = mysqli_query($conn, $Sql_ser);
                                while($ser_Name = mysqli_fetch_array($res_Ser))
                                { 
                                // print_r($ser_Name);
                                // echo"befor whil 2";
                                echo "<li>".$ser_Name['ser_name']."</li>";
                                // echo"befor ser 2";
                                }
                            }
                        ?>
                    </ul>
                </div>
                <div class="v-gallery col-12">
                    <h4>Work Gallery</h4>
                    <?php
                        $sql_G= "SELECT * FROM gallery WHERE P_id='$id'";
                        $result_G = mysqli_query($conn, $sql_G); 
                        $_rows = mysqli_num_rows($result_G);
                        if($_rows >= 1) {
                        while ($user_G = mysqli_fetch_array($result_G))
                            {
                        ?>
                            <div class="card" style="width: 19%;">
                                <div class="card-img-top" >
                                    <img width="100%" src="data:image/jpg;charset=utf8mb4;base64,<?php echo base64_encode($user_G['G_image']); ?> " />
                                </div>    
                                    <div class="card-body" >
                                    <?php 
                                        echo"<p class='card-text'>". $user_G['MSG']."</p>";
                                    ?>
                                    </div>
                            </div>
                            <?php
                            }
                        }
                    ?>  
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