<?php
    include('../Config.php');
    session_start();
    session_regenerate_id();
    $id= $_SESSION['p_id'];
    if (isset($_POST['submit']))
    {
        $G_image = $_FILES['G_image']['tmp_name'];
        $G_imgID = addslashes(file_get_contents($G_image));
        $MSG =  $_POST['MSG'];
        $conn->query("INSERT INTO gallery (P_id, G_image,MSG) VALUES ('$id','$G_imgID',' $MSG')");
    }
    header("Location:pProfile.php");

?>