<?php 
    include('../Config.php');
    session_start();
    session_regenerate_id();
    function success()
    {
        echo '<div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            Account Updated Successfully .
        </div>';
        echo "<form method='post'>
            <button class='btn btn-outline-info' style='float:right;'
            name='Vist'>Veiw Profile</button>
            </form>" ;
        if (isset($_POST['username']))
        {
            header("Location:uProfile.php");
        }
        else
        {
            echo"error";
        }
        
    }

    function fail()
    {
        echo '<div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            Please Complite Your Information .
        </div>';
    }
    $id = $_SESSION['u_id'];
    if(isset($_POST['update']))
    {
        if (
            isset($_POST['username'])
            && isset($_POST['email'])
            && isset($_POST['pass'])
            && isset($_POST['phone'])
        )
        {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $phone = $_POST['phone'];
            
            $result = mysqli_query($conn, "UPDATE users SET username='$username',email='$email',
            password='$password',phone='$phone' WHERE id=$id");  
             success();
        }
        else{
            fail();
        }  
    }

    

	$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id"); 
	$user_data = mysqli_fetch_array($result);

    $username = $user_data['username'];
    $email = $user_data['email'];
    $password = $user_data['password'];
    $phone = $user_data['phone'];

?>