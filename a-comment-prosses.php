<?php
session_start();
include_once 'DB-CONFIG.php';
$con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);

//check connection
if(!$con){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

//take given question-comment, take from session username and answer-ID
$comment_text = $_POST['comment_text'];
$username = $_SESSION['username']; //to find the user id
$user_id_array = mysqli_query($con, "SELECT user_id FROM user WHERE username='$username'");
$row = mysqli_fetch_array($user_id_array);
$user_id=  $row['user_id'];
$answer_id = $_GET['a_id'];
$question_id = $_SESSION['q_id'];

//current date
$dt = date("Y-m-d");

mysqli_query($con, "INSERT INTO answer_comment (answer_comment.user_id, answer_id, a_comment_text, a_comment_date) VALUES ('$user_id', '$answer_id', '$comment_text', '$dt')");
header("Location:page-view-question.php?q_id="."$question_id");
?>