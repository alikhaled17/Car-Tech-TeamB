
<?php
    include('../Config.php');
    
    function success()
    {
        if (($_POST['user-info'] == 'Provider'))
        {
           
            echo '<div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                             The data will be reviewed within 24 hours.<br>Please try after 24 hours of registration.
                    </div>';
        }
        else
        {
            echo '<div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            Account Created Successfully .<br>You Can Login Now.
                  </div>';
        }
    }

    function fail()
    {
        echo '<div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                Please complete your info  .
            </div>';
    }
    function failEmail()
    {
        echo '<div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                Your Email is already exist .
            </div>';
    }


    if (isset($_POST['submit'])) {
        if ($_POST['user-info'] == 'Provider' && $_SERVER['REQUEST_METHOD'] == "POST") {
            
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['pass'];
                $Phone = $_POST['phone'];
                if ($email != "") {
                    $query = "SELECT email FROM users where email='" . $email . "'";
                    $result = mysqli_query($conn, $query);
                    $num_rows = mysqli_num_rows($result);
                    if ($num_rows >= 1) {
                        failEmail();
                    } else {

                        $conn->query("INSERT INTO users (username, email, password, phone, account_type) 
                                VALUES ('$username','$email','$password','$Phone', 'Provider')");

                        $result = $conn->query("SELECT id FROM users WHERE email='$email'");
                        $row = $result->fetch_assoc();
                        $id =  $row['id'];

                        $commirc = $_FILES['commerc_id']['tmp_name'];
                        $commircID = addslashes(file_get_contents($commirc));
                        $nation = $_FILES['nation_id']['tmp_name'];
                        $nationID = addslashes(file_get_contents($nation));
                        $conn->query("INSERT INTO providers (user_id,ID_img,comm_img) VALUES ('$id','$nationID','$commircID')");

                        $ser_ids = $_POST['ser_name'];

                        foreach ($ser_ids as $ser_id):
                            $conn->query( "INSERT INTO prov_services (p_id,ser_id) VALUES ('$id','$ser_id')");
                        endforeach;

                        
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
                    failEmail();
                } else {
                    $conn->query("INSERT INTO users (username, email, password, gender, phone,prof_img) VALUES
                    ('$username','$email','$password', '$gender','$Phone','$prof_imgID')");
                    success();
                }
            }
        
        }
    }
?>