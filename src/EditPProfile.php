<?php 
    include('../Config.php');
    session_start();
    session_regenerate_id();
    $id = $_SESSION['p_id'];
    if(isset($_POST['update']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        $result = mysqli_query($conn, "UPDATE users SET username='$username',email='$email',
        password='$password',gender='$gender',phone='$phone' WHERE id=$id");  

        // if (isset($_POST['Gas_Station'])) {
        //     $conn->query("UPDATE prov_services SET p_id='$id' , ser_id='1' WHERE id=$id");
        // }
        // if (isset($_POST['Car_Wash'])) {
        //     $conn->query("UPDATE prov_services SET p_id='$id' , ser_id='2' WHERE id=$id");
        // }
        // if (isset($_POST['Car_Maintenance'])) {
        //     $conn->query("UPDATE prov_services SET p_id='$id' , ser_id='3' WHERE id=$id");
        // }
        // if (isset($_POST['Trailer_Truck'])) {
        //     $conn->query("UPDATE prov_services SET p_id='$id' , ser_id='4' WHERE id=$id");
        // }
        if (isset($_POST['City'])) {
            $selected = $_POST['City'];
            $Region = $_POST['Region'];
            $street = $_POST['street'];

            $conn->query("UPDATE p_address SET p_id='$id',region_id='$Region' ,street='$street'") ;
        }
        header("Location:pProfile.php");
    }
    

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
    // $selected = $user_data['City'];
    // $Region = $user_data['Region'];
    // $street = $user_data['street'];
    $username = $user_data['username'];
    $email = $user_data['email'];
    $password = $user_data['password'];
    $phone = $user_data['phone'];
    $gender = $user_data['gender'];


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
    <link rel="stylesheet" href="../css/Edit.css" />


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
                                <span>
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
                            <span> 
                            <?php
                                echo " " . $user_data['street'] ;
                                echo ",";
                                echo " " . $user_data['region_name'] . " ";
                                echo ",";
                                echo " " . $user_data['city_name'] . " ";
                            ?>  
                                <br>
                                <label>City </label>
                                <?php include('search_citis.php'); ?>
                                <label>Region</label>
                                <select id="Region1" name="Region" class="search-select">
                                <option value="none" selected>Choose...</option>
                                </select><br><br>
                                <label for="">Street</label>
                                <input type="text" name="street" placeholder="street">
                              
                            </span>
                        </div>
                        <!-- <div class="service-check">
                            <input type="checkbox" name="Gas_Station">
                            <label>Gas Station</label><br>
                            <input type="checkbox" name="Car_Wash">
                            <label>Car Wash</label><br>
                            <input type="checkbox" name="Car_Maintenance">
                            <label>Car Maintenance</label><br>
                            <input type="checkbox" name="Trailer_Truck">
                            <label>Trailer Truck</label><br>
                        </div> -->
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div >
                            <span> 
                            <input type="submit" class="btn btn-outline-info" name="update" value="Update">
                            </span>
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