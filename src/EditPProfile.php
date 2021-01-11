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
    WHERE users.id = '$id'
    GROUP BY users.id";

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
    <title>Car Tech - Edit Profile</title>
    <!-- my css files -->    
    <link rel="icon" href="../imgs/icon.png" type="image/icon type">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/pProfile.css" />
    <link rel="stylesheet" href="../css/EditPProfile.css" />


    <!-- <script src="../js/responde.js"></script>     -->
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
                            $background_colors = array('#282E33', '#25373A', '#164852', '#495E67', '#FF3838');
                            $rand_background = $background_colors[array_rand($background_colors)];
                            
                            echo"<h2 style='background-color: ". $rand_background .";'>";
                            echo strtoupper(substr($user_data['username'], 0, 1)) ;
                            echo "</h2>";
                        ?> 
                </div>
                <form name="update_user" class="col-9" method="post" action="EditPProfile.php">
                    <div class="info-prof ">
                        <div class="account-name">
                            <label style="color:#08526d; font-weight:500;">user name</label><br>
                            <input type="text" class="inputStyle" name="username" value="<?php echo $user_data['username']; ?>"  required>
                        </div>
                        <br>
                        <div class="personal-info">
                            <label style="color:#08526d; font-weight:500;">password</label><br>
                            <input type="password" class="inputStyle" name="pass" id="myInput" value="<?php echo $user_data['password']; ?>" required>
                            <img src="../imgs/eye-slash-512.png" width="20px" onclick=" myFunction();" style="cursor: pointer;" />
                        </div>
                        <br>
                        <div class="phone">
                            <i class="fa fa-phone-square"></i>
                            <input class="inputStyle" type="number" name="phone" value="<?php echo $user_data['phone']; ?>" required> 
                        </div>
                        <div class="mail">
                            <i class="fa fa-envelope-square"></i>
                            <input type="Email" class="inputStyle" name="email" value="<?php echo $user_data['email']; ?>" required>
                        </div>
                        <div class="adress">
                        <!-- <i class="fa fa-address-book"></i> -->
                            <!-- <span class="inputStyle">  -->
                            <?php
                                // echo ",";
                                // echo " " . $user_data['region_name'] . " ";
                                // echo ",";
                                // echo " " . $user_data['city_name'] . " ";
                            ?>  
                            <br>
                            <br>
                                <label class="labelCity" >City </label>
                                <?php include('search_citis.php'); ?>

                                <label class="labelReion">Region</label>
                                <select id="Region1" name="Region" class="search-select" required>
                                <option value="none" selected>Choose ...</option>

                                </select><br><br>
                                <label class="st">Street</label>
                                <input class="street" type="text" name="street" placeholder="street"  value='<?php echo$user_data['street'];?>'>
                              
                            </span>
                        </div>
                        

                        <br>
                        
                        <div class="service-check">
                        <?php
                            $sql = "SELECT 
                                prov_services.ser_id,
                                services.ser_name  
                                FROM prov_services
                                INNER join services on services.id = prov_services.ser_id
                                WHERE prov_services.p_id = '$id'";
                                
                            $res = mysqli_query($conn, $sql);
                            $arr = array( "Gas" => 'Gas Station',
                                            "Wash" => 'Car Wash',
                                            "Maintenance" => 'Car Maintenance',
                                            "Trailer" => 'Trailer Truck');
                            $stack = array();
                            while($ser_id = mysqli_fetch_array($res))
                            { 
                                array_push($stack, $ser_id['ser_name']);
                            }
                            foreach ($arr as $k => $v )
                            {
                                if(in_array($v , $stack) ) {
                                    echo "<input type='checkbox' name='".$k."' checked>";
                                    echo "<label class='service'>". $v ."</label><br>";
                                } 
                                else {
                                    echo "<input type='checkbox' name='".$k."'>";
                                    echo "<label class='service'>". $v ."</label><br>";
                                }
                            }
                            
                            ?>

                        <br>
				        <div>
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
    <script src="../js/Password.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
    <?php echo ?>
    <script>
        $(document).ready(function () {
            $("#cc").text('');
            console.log( <?php $user_data['region_name']; ?>);
            $("#cc").text("'" + <?php $user_data['city_name'] ?>+ "'") ;
            $("#rr").text('');
            $("#rr").text("'" + <?php $user_data['region_name'] ?>+ "'") ;
        });
    </script>
</body>
</html>