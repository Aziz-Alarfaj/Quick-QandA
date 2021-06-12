<?php
session_start();
include_once 'DB-CONFIG.php';
$con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);

//check connection
if(!$con){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

//take given question-comment, take from session username and question-ID
$answer_id = $_GET['a_id'];
$username = $_SESSION['username']; //to find the user id
$user_id_array = mysqli_query($con, "SELECT user_id FROM user WHERE username='$username'");
$row = mysqli_fetch_array($user_id_array);
$user_id=  $row['user_id'];
$question_id = $_SESSION['q_id'];

//check if user already rated
$user_rated = mysqli_query($con, "SELECT rate FROM rate_answer WHERE rate_answer.user_id='$user_id' AND answer_id='$answer_id' AND rate='-1'");
if(mysqli_num_rows($user_rated) > 0){
    mysqli_close($con);
    header("Location:page-view-question.php?q_id="."$question_id");
}

mysqli_query($con, "INSERT INTO rate_answer (answer_id, rate_answer.user_id, rate) VALUES ('$answer_id', '$user_id', '-1')");
header("Location:page-view-question.php?q_id="."$question_id");

?>