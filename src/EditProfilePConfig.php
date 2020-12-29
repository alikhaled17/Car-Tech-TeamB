<?php 
    function success()
    {
        echo ("<div class='success'>Account created successfully!</div>");
    }

    function fail()
    {
        echo ("<div class='fail'>Please complete your info</div>");
    }
    include('../Config.php');
    $id = $_SESSION['p_id'];
    if(isset($_POST['update']))
    { 
        if (
                isset($_POST['username'])
                && isset($_POST['email'])
                && isset($_POST['pass'])
                && isset($_POST['phone'])
                && isset($_POST['City'])
                && isset($_POST['street'])
                && ($_POST['Region'] != 0)
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
                $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','1')");
            }
            if (isset($_POST['Wash'])) {
                $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','2') ");
            }
            if (isset($_POST['Maintenance'])) {
                $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','3')");
            }
            if (isset($_POST['Trailer'])) {
                $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','4') ");
            }
            $conn->query("DELETE FROM p_address WHERE p_id = $id");
            if (isset($_POST['City'])&& isset($_POST['Region']) &&isset($_POST['street']) ) {
                $selected = $_POST['City'];
                $Region = $_POST['Region'];
                $street = $_POST['street']; 
                $conn->query("INSERT INTO p_address ( p_id , region_id,street) VALUES ('$id','$Region','$street') ") ;
            }
            else{
                fail();
            }
            success();
            header("Location:pProfile.php");
        }
        else {
            fail();
        }
     
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
    $username = $user_data['username'];
    $email = $user_data['email'];
    $password = $user_data['password'];
    $phone = $user_data['phone'];


?>