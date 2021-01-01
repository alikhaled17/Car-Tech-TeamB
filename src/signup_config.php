<?php
    include('../Config.php');

    function success()
    {
        echo ("<div class='success'>Account created successfully!</div>");
    }

    function fail()
    {
        echo ("<div class='fail'>Please complete your info or your email is already exist </div>");
    }


    if (isset($_POST['submit'])) {
        if ($_POST['user-info'] == 'Provider' && $_SERVER['REQUEST_METHOD'] == "POST") {
            if (
                isset($_POST['username'])
                && isset($_POST['email'])
                && isset($_POST['pass'])
                && isset($_POST['phone'])
                && isset($_POST['gender']) 
                && !empty($_FILES["nation_id"]["tmp_name"])
                && !empty($_FILES["commerc_id"]["tmp_name"])
                &&!empty($_FILES["prof_img"]["tmp_name"])
                && isset($_POST['City'])
                && isset($_POST['Region'])
                && isset($_POST['street'])
                && (isset($_POST['Gas_Station']) || isset($_POST['Car_Wash'])
                    || isset($_POST['Car_Maintenance']) || isset($_POST['Trailer_Truck']))
            ) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['pass'];
                $gender = $_POST['gender'];
                $Phone = $_POST['phone'];
                $prof_img = $_FILES['prof_img']['tmp_name'];
                $prof_imgID = addslashes(file_get_contents($prof_img));
                if ($email != "") {
                    $query = "SELECT email FROM users where email='" . $email . "'";
                    $result = mysqli_query($conn, $query);
                    $num_rows = mysqli_num_rows($result);
                    if ($num_rows >= 1) {
                        fail();
                    } else {

                        $conn->query("INSERT INTO users (username, email, password, gender, phone, account_type, prof_img) 
                                VALUES ('$username','$email','$password', '$gender','$Phone', 'Provider','$prof_imgID')");

                        $result = $conn->query("SELECT id FROM users WHERE email='$email'");
                        $row = $result->fetch_assoc();
                        $id =  $row['id'];

                        $commirc = $_FILES['commerc_id']['tmp_name'];
                        $commircID = addslashes(file_get_contents($commirc));
                        $nation = $_FILES['nation_id']['tmp_name'];
                        $nationID = addslashes(file_get_contents($nation));


                        $conn->query("INSERT INTO providers (user_id,ID_img,comm_img) VALUES ('$id','$nationID','$commircID')");
                        if (isset($_POST['Gas_Station'])) {
                            $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','1')");
                        }
                        if (isset($_POST['Car_Wash'])) {
                            $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','2')");
                        }
                        if (isset($_POST['Car_Maintenance'])) {
                            $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','3')");
                        }
                        if (isset($_POST['Trailer_Truck'])) {
                            $conn->query("INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','4')");
                        }
                        if (isset($_POST['City'])) {
                            $selected = $_POST['City'];
                            $Region = $_POST['Region'];
                            $street = $_POST['street'];

                            $conn->query("INSERT INTO p_address (p_id,region_id,street) 
                                    VALUES ($id,$Region,'$street')");
                        }
                        success();
                    }
                }
            } else {
                fail();
            }
        } else {
            if (
                isset($_POST['username'])
                && isset($_POST['email'])
                && isset($_POST['pass'])
                && isset($_POST['phone'])
                && isset($_POST['gender'])
                &&!empty($_FILES["prof_img"]["tmp_name"])
            ) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['pass'];
                $gender = $_POST['gender'];
                $Phone = $_POST['phone'];
                $prof_img = $_FILES['prof_img']['tmp_name'];
                $prof_imgID = addslashes(file_get_contents($prof_img));
                if ($email != "") {
                    $query = "SELECT email FROM users where email='$email' or username = '$username'";
                    $result = mysqli_query($conn, $query);
                    $num_rows = mysqli_num_rows($result);
                    if ($num_rows >= 1) {
                        fail();
                    } else {
                        $conn->query("INSERT INTO users (username, email, password, gender, phone,prof_img) VALUES
                        ('$username','$email','$password', '$gender','$Phone','$prof_imgID')");
                        success();
                    }
                }
            } else {
                fail();
            }
        }
    }
?>