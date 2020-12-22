<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Contact</title>
    <!-- my css files -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/services.css" />

    <script src="../js/responde.js"></script>
</head>

<body>
    <!-- Header -->
    <?php include('../header.php'); ?>
    <!-- Services -->

    <h2 class="header">Looking For The Best Service</h2>

    <!-- Search -->
    <div class="Outer">
        <div class="container">
            <div class="row">
                <div class="Search col-6">
                    <h3>Select Choose</h3><hr class="hr">
                    <br>
                    <div class="form-body">
                        <form class="test" action="#" method= "post">
                            <!-- Service -->
                            <label class="label">Service</label>
                            <?php
                            include_once("config.php");
                            $sql="SELECT Serviceid,Servicename FROM `myService`";
                            $result=mysqli_query($conn, $sql);

                            echo '<select name="Service" id="filter" class="search-selct">';
                            echo '<option selected>Choose...</option>';
                            while($myservice=mysqli_fetch_array($result)) {

                                echo '<option value="'
                                .$myservice ['Serviceid']
                                .'">'
                                .$myservice ['Servicename']
                                .'</option>';

                            }
                            echo '</select>';
                            ?>
                            <br><br>
                            <!-- City -->
                            <label class="label">City</label>
                            <?php
                            include_once("config.php");
                            $sql="SELECT cityid,cityname FROM `mycitys`";
                            $result=mysqli_query($conn, $sql);

                            echo '<select name="City" id="City1" class="search-selct">';
                            echo '<option value="none" selected >Choose...</option>';
                            while($mycitys=mysqli_fetch_array($result)) {

                                echo '<option value="'
                                .$mycitys ['cityid']
                                .'">'
                                .$mycitys ['cityname']
                                .'</option>';

                            }
                            echo '</select>';
                            ?>
                            <br><br>
                            <!-- Region -->
                            <label class="label">Region</label>
                            <select name="Region" id="Region1" name="Region1" class="search-selct">
                            </select>
                            <script type="text/javascript">
                                var City1= document.getElementById("City1");
                                var Region1 = document.getElementById("Region1");
                                onchange();
                                City1.onchange = onchange;
                                function onchange() {
                                    <?php include_once("config.php"); ?>
                                    option_html = "<option selected>Choose...</option>";
                                    console.log("Heeereeee 1");

                                    console.log(City1.value);
                                    if (City1.value != null && City1.value != "none") {
                                            console.log("Heeereeee 2");

                                            <?php $Region=$_POST['City'];
                                            $sql = "SELECT regionid, regionname FROM `region` WHERE cityid_f = '$Region'";
                                            $result = mysqli_query($conn, $sql); 

                                            while($myregion=mysqli_fetch_array($result)) 
                                             { ?>
                                                option_html += "<option value=\"
                                                                <?php echo $myregion ['regionid']; ?>
                                                                \" >
                                                                <?php echo $myregion ['regionname']; ?>
                                                                </option>";
                                            
                                            <?php } ?>
                                        }
                                    Region1.innerHTML = option_html;
                                }
                            </script>
                            <hr>
                            <!-- Name -->
                            <label class="label">Name</label>
                            <input id="name_p" type="text" placeholder="Search.." name="search_name"><br>
                            <?php
                            include_once("config.php");

                            if (isset($_POST['submit'])&& isset($_POST['search_name']) && ! empty($_POST['search_name'])) {
                                $Nameproveder=$_POST['search_name'];
                                $sql="SELECT userid,username FROM `mayar_table_user` WHERE p_name = '$Nameproveder' LIKE '$Nameproveder%'";
                                $result=mysqli_query($conn, $sql);
                                echo" <br>Last Search ... <br>";

                                while($tasks=mysqli_fetch_array($result)) {
                                    echo $tasks['task']."<br>";
                                }
                            }

                            ?>
                            <!-- search_submit -->
                            <input type="submit" value="submit" >

                        </form>
                    </div>
                </div>

                <!-- result -->
                <div class="result col-6">
                    <h3>Click On Your Selection</h3>
                    <br><br>
                    <form class="result" action="">
                        <ul id="result">
                            <li class="result-card">
                                <img src="http://www.myiconfinder.com/uploads/iconsets/256-256-5d8cab7b01ffef290b73909d06d92705.png" alt="imgProfile">
                                <h5>Account Name</h5>
                                <div class="rate-card">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="address-card">Address</span>
                                <a href="#">View Profile</a>
                            </li>
                        </ul>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="../js/script.js"></script>
</body>

</html>