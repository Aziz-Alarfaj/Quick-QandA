<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Quick Q&amp;A Official website - Homepage</title>

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

        <h1 class="my-4">
          Question
          <!-- ME <small>Secondary Text</small> -->
        </h1>

        <!-- question post -->
        <?php
          include_once 'DB-CONFIG.php';
          $con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);

          //check connection
          if(!$con){
            die("Failed to connect to MySQL: " . mysqli_connect_error());
          }

          //question stuff
          $question_id = $_GET['q_id'];
          $question_result = mysqli_query($con,"SELECT * FROM question WHERE question_id='$question_id'");
          $user = mysqli_query($con,"SELECT user.username, user.user_id FROM user INNER JOIN question ON user.user_id = question.user_id WHERE question_id='$question_id'");
          
          //question comment stuff
          $q_comment_result = mysqli_query($con,"SELECT * FROM question_comment WHERE question_id='$question_id' ORDER BY q_comment_id DESC");
          $q_comment_result2 = mysqli_query($con,"SELECT * FROM question_comment WHERE question_id='$question_id' ORDER BY q_comment_id DESC");
          $q_commenter = mysqli_query($con,"SELECT user.username, user.user_id FROM user INNER JOIN question_comment ON user.user_id = question_comment.user_id WHERE question_id='$question_id' ORDER BY q_comment_id DESC");
          
          //answer stuff
          $answer_result = mysqli_query($con,"SELECT * FROM answer WHERE answer.question_id='$question_id' ORDER BY answer_id DESC");

          $answerer = mysqli_query($con,"SELECT user.username, user.user_id FROM user INNER JOIN answer ON user.user_id = answer.user_id WHERE question_id='$question_id' ORDER BY answer_id DESC");

          //answer comment stuff
          // $a_comment_result = mysqli_query($con,"SELECT * FROM answer_comment ORDER BY a_comment_id DESC");
          $a_commenter = mysqli_query($con,"SELECT user.username, user.user_id FROM user INNER JOIN answer_comment ON user.user_id = answer_comment.user_id ORDER BY a_comment_id DESC");

          //rate stuff


          //question post --------------------------------------------------
          $row = mysqli_fetch_array($question_result);
            echo ("
            <div class='card mb-4'>
              <div class='card-body'>
                <h2 class='card-title'>".$row['question_title']."</h2>
                <p class='card-text'>".$row['question_text']."</p>
              </div>
              <div class='card-footer text-muted'>
                Posted on ".$row['question_date']." by ");
                  $asker = mysqli_fetch_array($user);
                    echo ("<span style='font-weight:600'>".$asker['username']."</span>
              </div>
            </div>");
            if(!isset($_SESSION['username']))
            {
            echo ("<small> please <a href='page-login.php'> login </a> so you will be able to comment, answer...</small>");
            }
            //question comments ------------------------------------------------
            echo ("
            <!-- question comments -->
            <div class='card my-4'>
              <h5 class='card-header'>Comments on question");
              if(isset($_SESSION['username']))
              {
              echo ("<a href='page-q-comment.php?q_id=$question_id'><small> comment </small></a>");
              }
              echo ("</h5><div class='card-body'>
                <div>");
                while($c_row = mysqli_fetch_array($q_comment_result))
                {
                  echo ("
                   $c_row[q_comment_text]");
                   $cc = mysqli_fetch_array($q_commenter);
                   echo ("<sub style='color: grey'> &nbsp; by ".$cc['username']." </sub>
                  <hr>
                  ");
                }
            echo ("</div>
              </div>
            </div>");

            //answers ----------------------------------------------------------
            echo ("
            <!-- answers and comments -->
            <div class='card my-4'>
              <h5 class='card-header'>Answers</h5>
              <div class='card-body'>
                <div>");
                while($a_row = mysqli_fetch_array($answer_result))
                {
                  $answer_id = $a_row['answer_id'];
                  echo ("<hr>
                   $a_row[answer_text]");
                   $aa = mysqli_fetch_array($answerer);
                  echo ("<sub style='color: grey'> &nbsp; by ".$aa['username']."</sub>");
                  $rate_result_array = mysqli_query($con,"SELECT SUM(rate) AS r_sum FROM rate_answer WHERE answer_id='$answer_id'");
                  $r_row = mysqli_fetch_array($rate_result_array);
                  $sum = $r_row['r_sum'];
                  if(isset($_SESSION['username']))
                  {
                    $_SESSION['q_id'] = $question_id;
                    echo ("<sub><a href='page-a-comment.php?a_id=$answer_id'> comment </a></sub>");
                    
                    echo("
                      <span class='float-right'>
                      $sum
                      <a href='like-rate.php?a_id=$answer_id'><img src='images/like.png' alt='like pic'></a>
                      <a href='dislike-rate.php?a_id=$answer_id'><img src='images/dislike.png' alt='dislike pic'></a> 
                      </span>
                    ");
                  }
                  else
                  {      
                    echo("
                      <span class='float-right'>
                      $sum
                      <a href='#'><img src='images/like.png' alt='like pic'></a>
                      <a href='#'><img src='images/dislike.png' alt='dislike pic'></a> 
                      </span>
                    ");
                  }
                  echo ("<hr>
                  ");
                  // answer comments ----------------------------------------------------
                  $a_comment_result = mysqli_query($con,"SELECT * FROM answer_comment WHERE answer_id=$answer_id ORDER BY a_comment_id DESC");
                  while($ac_row = mysqli_fetch_array($a_comment_result))
                  {
                  if($ac_row['answer_id'] == $answer_id)
                  {
                    echo ("<small> <span style='font-weight: 620'> comment on this answer &#x1F446; </span><br>
                    $ac_row[a_comment_text]");
                    $ac = mysqli_fetch_array($a_commenter);
                    echo ("<sub style='color: grey'> &nbsp; by ".$ac['username']." </sub> </small>
                    <br>
                    ");
                  }
                  }
                }
            echo ("</div>
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
          <h5 class="card-header">Answer the question</h5>
          <div class="card-body">
            <div class="text-center">
              <?php
              if(isset($_SESSION['username']))
              {
               echo ("<a href='page-answer.php?q_id=$question_id'class='btn btn-primary'>Answer question</a>");
              }
              else
              {
                echo ("<a href='page-login.php'class='btn btn-secondary'>Answer question</a>");
              }
              ?>
            </div>
          </div>
        </div>

        <div style="margin-bottom: 300px"></div>

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
