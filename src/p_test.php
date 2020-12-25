<?php 
    include('../Config.php');  
    session_start();


    $id = $_SESSION['p_id'];

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
                </div>
                <div class="col-3"></div>
                <div class="col-9 contact-info">
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
                        <button>
                            Go | 
                            <i class="fa fa-location-arrow"></i>
                        </button>
                    </div>
                </div>
                <div class="services-prof col-12">
                    <h4>Services</h4>
                    <ul>
                        <?php
                        while($ser_name = mysqli_fetch_array($result))
                        { 
                            echo "<li>".$ser_name['ser_name']."</li>";
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