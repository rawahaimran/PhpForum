<?php 

$show_error="false";

if($_SERVER["REQUEST_METHOD"]=='POST'){
    include('_dbconnect.php');
    $user_email = $_POST['signupEmail'];
    $user_name  = $_POST['signupEmail'];
    $user_pass  = $_POST['signupPassword'];
    $user_confirm_PassWord = $_POST['signupcPassword'];


    //sql
    

    $sql_check ="SELECT * FROM `users` WHERE User_email= '$user_email'";
    $result = mysqli_query($conn,$sql_check);
    $num_rows = mysqli_num_rows($result);

    if($num_rows>0){
        $show_error = 'Email already exists';

        exit();
    }else{
        if($user_pass === $user_confirm_PassWord){
            $hash = password_hash($user_pass,PASSWORD_DEFAULT);
            $sql  = "INSERT INTO `users` (`User_email`, `User_Pass`, `user_time`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            if($result){
                $show_success = "true";
                // echo $show_success;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();    
            }
        }
        else{
            $show_error = "Passwords don't match";
            header("Location: /forum/index.php?signupsuccess=false?Error=$show_error");

            exit();
        }

    }
    header("Location: /forum/index.php?signupsuccess=false?Error=$show_error");



}

