<?php
session_start();
include_once 'DB-CONFIG.php';
$con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);

//check connection
if(!$con){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

//take given email and password
$email = $_POST['email'];
$password = $_POST['password'];


$result = mysqli_query($con, "SELECT * FROM user WHERE email='$email' AND u_password ='$password'");

if(mysqli_num_rows($result) == 1)
{
    mysqli_close($con);
    $row = mysqli_fetch_array($result);
    $_SESSION['username']=$row['username'];
    // header("Location: {$_POST['current_page']}"); //to stay on the same page
    header('Location:index.php');
}
else
{
    mysqli_close($con);
    header('Location:page-login.php?error=Wrong email or password');
}
?>
   