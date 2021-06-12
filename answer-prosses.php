<?php
session_start();
include_once 'DB-CONFIG.php';
$con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);

//check connection
if(!$con){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

//take given answer, username and question-ID
$answer_text = $_POST['answer_text'];
$username = $_SESSION['username']; //to find the user id
$user_id_array = mysqli_query($con, "SELECT user.user_id FROM user WHERE username='$username'");
$row = mysqli_fetch_array($user_id_array);
$user_id=  $row['user_id'];
$question_id = $_GET['q_id'];

//current date
$dt = date("Y-m-d");

mysqli_query($con, "INSERT INTO answer (answer.user_id, question_id, answer_text, answer_date) VALUES ('$user_id', '$question_id', '$answer_text', '$dt')");
header("Location:page-view-question.php?q_id="."$question_id");
?>