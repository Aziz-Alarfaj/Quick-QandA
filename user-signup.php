<?php
session_start();
include_once 'DB-CONFIG.php';
$con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);

//check connection
if(!$con){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

//take given username, email and password
$username = $_POST['uname'];
$email = $_POST['email'];
$password = $_POST['password'];

// check if user already exestis
$user_result = mysqli_query($con, "SELECT username FROM user WHERE username='$username'");
$email_result = mysqli_query($con, "SELECT email FROM user WHERE email='$email'");
if(mysqli_num_rows($user_result) > 0)
{
    mysqli_close($con);
    header('Location:page-signup.php?error=This user name is taken');
}

elseif(mysqli_num_rows($email_result) > 0)
{
    mysqli_close($con);
    header('Location:page-signup.php?error=This email is used');
}

elseif($username == '' || $email == '' || $password == '')
{
    mysqli_close($con);
    header('Location:page-signup.php?error=Invalid input');
}

else
{
    mysqli_query($con, "INSERT INTO user (username, email, u_password) VALUES ('$username', '$email', '$password')");
    $_SESSION['username']=$username;
    header('Location:index.php');
    // mysqli_close($con);
}


?>
   