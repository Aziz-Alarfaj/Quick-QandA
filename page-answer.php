<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Quick Q&amp;A Answer page </title>

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
      <div class="col-md-12">

      <!-- Sidebar Widgets Column -->


        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Question</h5>
          <div class="card-body">
          <p class="card-text">
            <!-- question text -->
            <?php
              include_once 'DB-CONFIG.php';
              $con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);
    
              //check connection
              if(!$con){
                die("Failed to connect to MySQL: " . mysqli_connect_error());
              }

              $question_id = $_GET['q_id'];
              $question_result = mysqli_query($con,"SELECT * FROM question WHERE question_id='$question_id'");
              $user = mysqli_query($con,"SELECT user.username, user.user_id FROM user INNER JOIN question ON user.user_id = question.user_id WHERE question_id='$question_id'");
              $question_text_array = mysqli_query($con, "SELECT question_title, question_text FROM question WHERE question_id='$question_id'");
              $row = mysqli_fetch_array($question_text_array);
              $question_title = $row['question_title'];
              $question_text = $row['question_text'];
              echo("
              <h4>$question_title</h4>
              $question_text
              ");
              ?></p>
          </div>
        </div>

          <!-- Answer Post -->
        <div class="card mb-4" > 
          
          <div class="card-body">
            <h2 class="card-title">Your answer</h2>
            <?php
            echo("
              <form action='answer-prosses.php?q_id=$question_id' method='POST'>
              <textarea class='col-md-12' rows='10' style='resize:none' name='answer_text' placeholder='Write here...' required></textarea>
              <div class='float-right'>
              <input type='submit' class='btn btn-primary' value='Submit' name='sub_boutton'>
              <!-- <input type='hidden' name='question_id' value='#'> -->
              </div>
              </form>
              ");
            ?>
          </div>
          
          <div class='card-footer text-muted'>
          <!-- //   or write a <a href='page-q-comment.php?q_id=$question_id'>comment</a> -->
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
