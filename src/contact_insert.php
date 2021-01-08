<?php
    include_once("../Config.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $data_to_store = filter_input_array(INPUT_POST);
        $nameUser = $data_to_store['nameUser'];
        $Emailsend= $data_to_store['Emailsend'];
        $subjectTitle= $data_to_store['subjectTitle'];
        $message= $data_to_store['message'];
        $date_time=date('Y-m-d H:i:s');        

        //reset db instance
        $Insert_qur="INSERT INTO message (Name,Email,Subject,Massege,date_time) VALUES ('$nameUser', '$Emailsend', '$subjectTitle','$message','$date_time')";
        $ins_result=mysqli_query($conn, $Insert_qur);
    
} ?>