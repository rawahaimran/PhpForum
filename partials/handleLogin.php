<?PHP
$show_error =   false;



if($_SERVER["REQUEST_METHOD"] == "POST"){
    include('_dbconnect.php');
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPass'];

    // echo $email.$password;
    

    $sql  = "SELECT * FROM `users` WHERE User_email='$email'";
    $result = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows==1){
        $row = mysqli_fetch_assoc($result); 
        if(password_verify($password,$row['User_Pass'])){
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['UserName'] = $email;
            echo "LOGGED IN".$email;
            
            header("Location: /forum/index.php");
            exit();
        }
            header("Location: /forum/index.php");

        
        }


}