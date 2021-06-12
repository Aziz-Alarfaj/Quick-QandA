<?php
session_start();
include_once 'DB-CONFIG.php';
$con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);

//check connection
if(!$con){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

//take given question title, username and question content
$question_title = $_POST['question_title'];
$question_text = $_POST['question_text'];
$username = $_SESSION['username']; //to find the user id
$user_id_array = mysqli_query($con, "SELECT user.user_id FROM user WHERE username='$username'");
$row = mysqli_fetch_array($user_id_array);
$user_id=  $row['user_id'];


//current date
$dt = date("Y-m-d");

mysqli_query($con, "INSERT INTO question (question.user_id, question_title, question_text, question_date) VALUES ('$user_id', '$question_title', '$question_text', '$dt')");
header('Location:index.php'); //not yet implemented
?>

//user table user_id ==> user_id1
//question table user_id ==> user_id_q 