<?php 
     if(!isset($_SESSION)) 
     { 
         session_start(); 
     } 
     if(!isset($_SESSION['username']))
     {
       header('Location:page-login.php');
     }
    $updated;
    $old_id;
    $num=0;

    include_once 'DB-CONFIG.php';
    $conn= new mysqli(HOST,DBUSER,DBPWD,DBNAME);
    if($conn->connect_error)
      die("Failed to connect to MySQL: " . $con->connect_error);

    // To take the new Content
    if(isset($_GET['updated-question']))
      $updated=$_GET['updated-question'];
    elseif(isset($_GET['updated-answer']))
      $updated=$_GET['updated-answer'];
    elseif(isset($_GET['updated-comment-q']))
      $updated=$_GET['updated-comment-q'];
    elseif(isset($_GET['updated-comment-a']))
      $updated=$_GET['updated-comment-a'];

    // To take the old id of content
    while(true){
    if(isset($_SESSION['question_id$num'])){
      $old_id=$_SESSION['question_id$num'];break;}
    elseif(isset($_SESSION['id-answer$num'])){
      $old_id=$_SESSION['id-answer$num'];break;}
    elseif(isset($_SESSION['id-comment-q$num'])){
      $old_id=$_SESSION['id-comment-q$num'];break;}
    elseif(isset($_SESSSION['id-comment-a$num'])){
      $old_id=$_SESSION['id-comment-a$num'];break;}
      $num++;
    }

    //  queries
    while(true){
      if(isset($_SESSION['question_id$num'])){
        $update_data = $conn->query("UPDATE question SET question_text='$updated' WHERE question_id='$old_id'");
        break;
      }
      elseif(isset($_SESSION['id-answer$num'])){
        $update_data = $conn->query("UPDATE answer SET answer_text='$updated' WHERE answer_id='$old_id'");
        break;
      }
      elseif(isset($_SESSION['id-comment-q$num'])){
        $update_data = $conn->query("UPDATE answer_comment SET a_comment_text='$updated' WHERE a_comment_id='$old_id'");
      break;
      }
      elseif(isset($_SESSION['id-comment-a$num'])){
        $update_data = $conn->query("UPDATE question_comment SET q_comment_text='$updated' WHERE q_comment_id='$old_id'");
        break;
      }
      $num++;
    }
    header("Location:account-page.php");
    ?> 
