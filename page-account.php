<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Quick Q&amp;A Official website - account</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/blog-home.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <?php
  include_once 'nav-bar.php';
  ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">My account
          <!-- ME <small>Secondary Text</small> -->
        </h1>

        
        <!-- POST -->
        <?php
          include_once 'DB-CONFIG.php';
          $con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);

          //check connection
          if(!$con){
            die("Failed to connect to MySQL: " . mysqli_connect_error());
          }

          $username = $_SESSION['username']; //to find the user id
          $user_id_array = mysqli_query($con, "SELECT user.user_id FROM user WHERE username='$username'");
          $row = mysqli_fetch_array($user_id_array);
          $user_id=  $row['user_id'];

          $question_result = mysqli_query($con,"SELECT * FROM question WHERE question.user_id=$user_id ORDER BY question_id DESC");
          $answer_result = mysqli_query($con,"SELECT * FROM answer WHERE answer.user_id=$user_id ORDER BY answer_id DESC");
          $q_comment_result = mysqli_query($con,"SELECT * FROM question_comment WHERE question_comment.user_id=$user_id ORDER BY q_comment_id DESC");
          $a_comment_result = mysqli_query($con,"SELECT * FROM answer_comment WHERE answer_comment.user_id=$user_id ORDER BY a_comment_id DESC");
          
          
          // questions --------------------------------------------------------------
          echo ("
            <!-- my questions -->
            <div class='card my-4'>
              <h5 class='card-header'>My questions</h5>
              <div class='card-body'>
                <div class='overflow-auto' style='height: 200px'>");
          while($row = mysqli_fetch_array($question_result))
          {
            $question_id = $row['question_id'];
            echo ("
                <a href='page-view-question.php?q_id=$question_id' style='color: black'><h5>".$row['question_title']."</h5></a>
                <span><a href='edit_q.php?q_id=$question_id'>edit</a></span>
                <hr>");
          }
            echo("
                  </div>
                </div>
             </div>");

            // answers ------------------------------------------------------------
             echo ("
            <!-- my answers -->
            <div class='card my-4'>
              <h5 class='card-header'>My answers</h5>
              <div class='card-body'>
                <div class='overflow-auto' style='height: 200px'>");
          while($a_row = mysqli_fetch_array($answer_result))
          {
            $a_question_id = $a_row['question_id'];
            $answer_id = $a_row['answer_id'];
            echo ("
                <a href='page-view-question.php?q_id=$a_question_id' style='color: black'><h5>".$a_row['answer_text']."</h5></a>
                <span><a href='edit_a.php?q_id=$answer_id'>edit</a></span>
                <hr>");
          }
          echo("
                  </div>
                </div>
             </div>");

            // question comments ------------------------------------------------
             echo ("
             <!-- my qcomments -->
             <div class='card my-4'>
               <h5 class='card-header'>My question comments</h5>
               <div class='card-body'>
                 <div class='overflow-auto' style='height: 200px'>");
           while($qc_row = mysqli_fetch_array($q_comment_result))
           {
             $qc_question_id = $qc_row['question_id'];
             $q_comment_id = $qc_row['q_comment_id'];

             echo ("
                 <a href='page-view-question.php?q_id=$qc_question_id' style='color: black'><h5>".$qc_row['q_comment_text']."</h5></a>
                 <span><a href='edit_qc.php?q_id=$q_comment_id'>edit</a></span>
                 <hr>");
           }
           echo("
                   </div>
                 </div>
              </div>");

              // answer comments ------------------------------------------------
              echo ("
             <!-- my acomments -->
             <div class='card my-4'>
               <h5 class='card-header'>My answer comments</h5>
               <div class='card-body'>
                 <div class='overflow-auto' style='height: 200px'>");
           while($ac_row = mysqli_fetch_array($a_comment_result))
           {
            $ac_answer_id = $ac_row['answer_id'];
            $question_id_array = mysqli_query($con, "SELECT * FROM answer WHERE answer_id='$ac_answer_id'");
            $acc_row = mysqli_fetch_array($question_id_array);
            $ac_question_id = $acc_row['question_id'];
            $a_comment_id = $ac_row['a_comment_id'];
             echo ("
                 <a href='page-view-question.php?q_id=$ac_question_id' style='color: black'><h5>".$ac_row['a_comment_text']."</h5></a>
                 <span><a href='edit_ac.php?q_id=$a_comment_id'>edit</a></span>
                 <hr>
                 ");
           }
           echo("
                   </div>
                 </div>
              </div>");
          
          
          mysqli_close($con);
        ?>
        
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <form action="search.php" method="POST">
            <div class="card-body">
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for..." name="search" required>
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                  </span>
              </div>
            </div>
          </form>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Quick Q&A</h5>
          <div class="card-body">
            Our websit aimes for a better knowlage and understanding of things in this world! <br>
            You should find anything you are wondering about, here in our website &#10084;.
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Our Community</h5>
          <div class="card-body">
            Just starting up. But as they say &#34;You do not have to be great to start, but you have to start to be great&#34; &#10024;.
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Quick Q&A 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
