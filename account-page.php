<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quick Q&amp;A account page </title>
     <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/blog-home.css" rel="stylesheet">
<script
  src="http://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  
<script>
    // we need Jquery to append the inputs and submit buttons   
  $("document").ready(function(){
      $("#button1").click(function edit(){
        $(this).remove();
        $(".place-button").html("<input type='text' name='updated-question' placeholder='write your new question here' style='width:400px;'><hr><button type='submit' class='btn btn-primary'>submit</button> ");
      });

      $("#button2").click(function edit(){
        $(this).remove();
        $(".place-button2").html("<input type='text' name='updated-answer' placeholder='write your new question here' style='width:400px;'><hr><button type='submit' class='btn btn-primary'>submit</button> ");

    });

    $("#button3").click(function edit(){
        $(this).remove();
        $(".place-button3").html("<input type='text' name='updated-comment-q' placeholder='write your new question here' style='width:400px;'><hr><button type='submit' class='btn btn-primary'>submit</button> ");

    });

    $("#button4").click(function edit(){
        $(this).remove();
        $(".place-button4").html("<input type='text' name='updated-comment-a' placeholder='write your new question here' style='width:400px;'><hr><button type='submit' class='btn btn-primary'>submit</button> ");

    });

});
 
</script>
</head>
<body>
  <!-- Navigation -->
  <?php
    include_once 'nav-bar.php';
  ?>

  
  <div class="container">
      <!-- Using grid system from bootstap -->
  <div class="row">
    <div class="col-lg-7">
    <br><br>
    <?php 
      echo "<h1>Welcome ".$_SESSION['username']."</h1><br>";
      echo "<h3>Your previous Questions : </h3>";    

    //   To take id from username
      include_once 'DB-CONFIG.php';
      $con= new mysqli(HOST,DBUSER,DBPWD,DBNAME);
      if($con->connect_error)
        die("Failed to connect to MySQL: " . $con->connect_error);

      $username=$_SESSION['username'];
      $user_id = mysqli_query($con, "SELECT * FROM user WHERE username='$username' ");
      $id;
      $email;

      while ($row = $user_id->fetch_assoc()) {
        //   We have to do this because we cannot take anything from a database directly , and avoiding fetal error . 
        $id=$row['user_id'];
        $email=$row['email'];
        $num=0;

        // Creating a table to display List of questions
        echo "<table class='table'>
        <thead class='thead-dark'>
          <tr><th>Question Titles</th><th>Question text</th><th>edit your question &nbsp;<button type='button' id='button1' class='btn btn-primary'>edit</button></th></tr></thead>";
          $list_questions= $con->query("SELECT * FROM question WHERE user_id='$id'");

          while ($question = $list_questions->fetch_assoc()){
            //   To send the id of an old question to update.php
            $_SESSION['question_id$num']=$question['question_id']; $num++; 
              echo "<tr><td>".$question['question_title']."</td><td>".$question['question_text']."</td><td><form class='place-button' action='update.php' method='get'><input type='hidden' name='id-quest' value='".$question['question_id']."'></form></td></tr>";
          }
          echo "</table><br><br>";
          //   End of question table  
          echo "<h3>Your previous answers : </h3>";
          echo "<table class='table'>
          <thead class='thead-dark'>
          <tr><th>Answers</th><th>edit your answer &nbsp;<button id='button2' type='button' class='btn btn-primary'>edit</button></th></tr></thead>";
          $list_answers= $con->query("SELECT * FROM answer WHERE user_id='$id' ");

          while ($answer = $list_answers->fetch_assoc()){
              $_SESSION['answer_id$num']=$question['answer_id'];$num++;
              echo "<tr><td>".$answer['answer_text']."</td><td><form class='place-button2' action='update.php' method='get'><input type='hidden' name='id-answer' value='".$answer['answer_id']."'></form></td></tr>";
          }
          echo "</table><br><br>"; 
        //   End of answer table 
        echo "<h3>Your previous comments on Questions : </h3>";
        echo "<table class='table'>
        <thead class='thead-dark'>
        <tr><th>Comments on questions</th><th>edit your Comments &nbsp;<button id='button3' type='button' class='btn btn-primary'>edit</button></th></tr></thead>";
        $list_comments_q= $con->query("SELECT * FROM question_comment WHERE user_id='$id' ");

        while ($comment_q = $list_comments_q->fetch_assoc()){
            $_SESSION['q_comment_id$num']=$question['q_comment_id'];$num++;
            echo "<tr><td>".$comment_q['q_comment_text']."</td><td><form class='place-button3' action='update.php'  method='get'><input type='hidden' name='id-comment-q' value='".$comment_q['q_comment_id']."'></form></td></tr>";
        }
        echo "</table><br><br>";
        // End of comment on question table
        echo "<h3>Your previous comments on Answers : </h3>";
        echo "<table class='table'>
        <thead class='thead-dark'>
        <tr><th>Comments on answers</th><th>edit your Comments &nbsp;<button id='button4' type='button' class='btn btn-primary'>edit</button></th></tr></thead>";
        $list_comments_a= $con->query("SELECT * FROM answer_comment WHERE user_id='$id' ");

        while ($comment_a = $list_comments_a->fetch_assoc()){
            $_SESSION['a_comment_id$num']=$question['a_comment_id'];$num++;
            echo "<tr><td>".$comment_a['a_comment_text']."</td><td><form class='place-button4' action='update.php'  method='get'><input type='hidden' name='id-comment-a' value='".$comment_a['a_comment_id']."'></form></td></tr>";
        }
        echo "</table><br><br>";
        // End of comment on answer table.

      }



    ?> </div> 
       <div class="col-lg-5"><br><br><br><br><br><br><br>
         <div class="card" style="width: 18rem; margin-left:200px;">
           <div class="card-body">
             <h1 class="card-title">Your info</h1>
             <h2 class="card-subtitle mb-2 text-muted">username:<?php echo "  ".$_SESSION['username'];?></h2>
             <hr>
             <h2 class="card-subtitle mb-2 text-muted">E-mail:<?php echo "  ".$email;?></h2>

        

            </div>
          </div>
        </div>
  </div>
  </div>
<!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>