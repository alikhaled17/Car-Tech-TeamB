<?php 
    include('../Config.php');  
    session_start();
    session_regenerate_id();

    if(!isset($_SESSION['p_id']))      
    {
        header("Location:login.php");
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
        WHERE users.id = '$id'
        GROUP BY users.id
        ";

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
    <link rel="icon" href="../imgs/icon.png" type="image/icon type">
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
                <div class="wow wobble img-prof col-3">
                   
                    <div class='imgProf'>
                    <img src="../imgs/default-prof.jpg"/> 
                    </div>

                </div>
                
                
                <div class="col-9 contact-info">
                    <div class="account-name">
                        <h2>
                            <?php 
                                echo $user_data['username'];
                            ?>
                        </h2><hr>
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
                        if($user_data['account_type'] == 'Provider') {
                        ?>  
                            <button class="addloc btn btn-outline-info" style="right: 130px" onclick="getLocation()">
                            <?php 
                                $cords="SELECT * FROM coordinates WHERE p_id = '$id' ";
                                $ifcords = mysqli_query($conn, $cords);
                                if($ex = mysqli_num_rows($ifcords)) {echo "update Location";} 
                                else {echo "Add Location";}
                            ?>
                            </button>

                            <button class="btn btn-outline-info" onclick="window.location.href ='EditpProfile.php';">Edit Info</button>
                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="services-prof">
                    <h3>Favorite list</h3>
                    <button class="btn btn-outline-info" onclick="window.location.href ='favoriteUser.php';">
                        Show Favorite 
                    </button>
               
                    
                </div>
                <div class="services-prof">
                    <h3>Services</h3>
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
                <div class="work-gallery col-12">
                    <form method="POST" enctype="multipart/form-data" action="Gallery.php">
                        
                        <div class="inForm">
                            <h3>Work Gallery</h3>
                            <hr>
                            <p> Your Description </p>
                            <p>
                                <textarea name="MSG"  cols="45" rows="5" placeholder="Enter description about this photo" required></textarea>
                            </p>
                            <p> Image </p>
                            <p>
                                <input type="file" name="G_image" accept="image/*" required class="file" >
                            </p>
                            <p>
                                <input type='submit' name='submit' value ='Add New' class="btn btn-outline-info newBtn" >
                            </p>
                        </div>
                        
                    </form>
                        
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
                                        echo "<a style='float:right; padding-bottom:10px;' href='Delete.php?id=".$user_G['id']."'><img src='../imgs/Delete.png' width='20px'> </a>";                                    
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

    <script>
		//var x = document.getElementById("demo");
		var longitudeCoords=0;
		var latitudeCoords=0;
		
		function getLocation() {
			//if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			/*} else { 
				x.innerHTML = "Geolocation is not supported by this browser.";
			}*/
		}

		function showPosition(position) {
				console.log(position, "position")
		
			longitudeCoords=position.coords.longitude; //30
			latitudeCoords=position.coords.latitude; //5505
			
            var u = "./get_loc.php?lon=" + longitudeCoords+"&lat="+latitudeCoords;
            var x = window.open(u,'_self');
		}
		
		function goPosition() {
			if (longitudeCoords==0 || latitudeCoords==0)
				getLocation();
			var url = "http://maps.google.com/maps?q="+ latitudeCoords + 
			",+" +longitudeCoords ;
			
			location.replace(url);
        }
	</script>
    
    
    <?php include('../footer.php'); ?>
    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
</body>
</html>

