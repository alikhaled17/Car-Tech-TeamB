<?php 
    include('../Config.php');  
    session_start();
    
    
    if(isset($_POST['reg'])) {
        $query = "
        UPDATE p_address
        SET region_id  = '".$_POST["reg"]."', street = '". $_POST["street"] ."'
        WHERE p_id = '".$_POST["id"]."'
        ";

        echo $_POST["reg"];
        $conn->query($query);
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


    if(isset($_POST['update']))
    { 
        if (
                isset($_POST['username'])
                && isset($_POST['email'])
                && isset($_POST['pass'])
                && isset($_POST['phone'])
                && (isset($_POST['Gas']) || isset($_POST['Wash'])
                || isset($_POST['Maintenance']) || isset($_POST['Trailer']))
        )
        {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $phone = $_POST['phone'];

            $result = mysqli_query($conn, "UPDATE users SET username='$username',email='$email',
            password='$password',phone='$phone' WHERE id=$id");  
            
            $conn->query("DELETE FROM prov_services WHERE p_id = $id");

            if (isset($_POST['Gas'])) {
                $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','10')");
            }
            if (isset($_POST['Wash'])) {
                $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','20') ");
            }
            if (isset($_POST['Maintenance'])) {
                $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','30')");
            }
            if (isset($_POST['Trailer'])) {
                $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','40') ");
            }

            header("Location: pProfile.php");
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Oops! </strong>
            </div>';
    }

    
}

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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <!-- <link rel="stylesheet" href="../css/pProfile.css" /> -->
    <link rel="stylesheet" href="../css/EditPProfile.css" />

</head>
<body>
    <?php include('../header.php'); ?>
    

    <div class="container edit">
           
            <form  class="row" name="update_user" method="post" >
                <div class="col-12 name">
                    <label style="color:#08526d; font-weight:500;">Name</label><br>
                    <input type="text" class="inputStyle" name="username" value="<?php echo $user_data['username']; ?>"  required><br>
                </div>
                <div class="col-12 row email-pass">
                    <div class="col-6">
                        <label style="color:#08526d; font-weight:500;">Email</label><br>
                        <input type="Email" class="inputStyle" name="email" value="<?php echo $user_data['email']; ?>" required><br>
                    </div>
                    <div class="col-6">
                        <label style="color:#08526d; font-weight:500;">Password</label><br>
                        <input type="password" class="inputStyle" name="pass" id="myInput" value="<?php echo $user_data['password']; ?>" required>
                        <img src="../imgs/eye-slash-512.png" width="20px" onclick=" myFunction();" style="cursor: pointer;" /><br>
                    </div>
                </div>
                <div class="col-12 row address-phone">
                    <div class="col-6">
                        <label style="color:#08526d; font-weight:500;">Phone Number</label><br>
                        <input class="inputStyle" type="number" name="phone" value="<?php echo $user_data['phone']; ?>" required> <br>

                    </div>
                    <div class="col-6">
                        <div class="last-add">
                            <label style="color:#08526d; font-weight:500;">Address</label><br>
                            <span> 
                            <?php
                                echo " " . $user_data['street'] ;
                                echo ",";
                                echo " " . $user_data['region_name'] . " ";
                                echo ",";
                                echo " " . $user_data['city_name'] . " ";
                            ?>  
                            </span><br>
                            <button id='chang'>Change</button>
                        </div>
                        <div  class="last-add">
                            <label style="color:#08526d; font-weight:500;">Address</label><br>
                            <div class="city">
                                <label>City</label>
                                <?php
                                    include('search_citis.php'); 
                                ?>
                            </div>
                            <div class="region">
                                <label>Region</label>
                                <select id="Region1" name="Region" class="search-select">
                                    <option value="none" selected>Choose ...</option>
                                </select>
                            </div>

                            <div class="street">
                                <label for="">Street</label>
                                <input type="text" name="street" placeholder="street">
                            </div>

                            <div class="ok">
                                <span>Ok</span>
                            </div>
                            <button id='close'>x</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 row">

                    <div class="col-8 services">
                        <label style="color:#08526d; font-weight:500;">Services</label><br>
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
                                    echo "<label class='service'>". $v ."</label>";
                                } 
                                else {
                                    echo "<input type='checkbox' name='".$k."'>";
                                    echo "<label class='service'>". $v ."</label>";
                                }
                            }
                            
                            ?>
                    </div>

                    <div class="col-4 submit">
                        <input type="submit" class="btn btn-outline-info" name="update" value="Update"><br>
                    </div>

                </div>
            </form>
    </div>
    <div style="clear:both;"></div>
    
    <?php include('../footer.php'); ?>

    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/Password.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>

    <script>
        $('button').click(function(e) {
            e.preventDefault();
            return false;
        });

        $("#chang").click(function(){
            $(".last-add:first-child").css("display", "none");
            $(".last-add:last-child").css("display", "block");
        });

        $("#close").click(function(){
            $(".last-add:first-child").css("display", "block");
            $(".last-add:last-child").css("display", "none");
        });

        $(".ok span").click(function() {

            if(($(".region option:selected").val() != "none") && ($(".street input").val() != ' ') && ($(".street input").val() != '')) {
                var id = "<?php echo $id; ?>";
                var reg = $(".region option:selected").val();
                var street = $(".street input").val();

                var new_address = street+ ", " + $(".region option:selected").text() + ", " + $(".city option:selected").text();
                $(".last-add:first-child span").text(new_address);
                
                $.ajax({
                    url: "EditPProfile.php",
                    method: "POST",
                    data: { id: id, reg: reg, street: street },
                    success: function () {
                    }
                })

                $(".last-add:first-child").css("display", "block");
                $(".last-add:last-child").css("display", "none");
            }
        });

    </script>

</body>
</html>