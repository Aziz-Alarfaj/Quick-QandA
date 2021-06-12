<?php
// check if user is signed in. if not transfer to the sign in page, else open this page.

//disable this so you can view the page.
// session_start();
// if(!isset($_SESSION['username']))
// {
//   header('Location:page-login.php');
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Quick Q&amp;A comment page </title>

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
          <h5 class="card-header">Comment on</h5>
          <div class="card-body">
          <p class="card-text">
            <!-- text to be commented on -->
            <?php
              include_once 'DB-CONFIG.php';
              $con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);
    
              //check connection
              if(!$con){
                die("Failed to connect to MySQL: " . mysqli_connect_error());
              }

              $answer_id = $_GET['a_id'];
              $answer_result = mysqli_query($con,"SELECT * FROM answer WHERE answer_id='$answer_id'");
              $user = mysqli_query($con,"SELECT user.username, user.user_id FROM user INNER JOIN answer ON user.user_id = answer.user_id WHERE answer_id='$answer_id'");
              $answer_text_array = mysqli_query($con, "SELECT answer_text FROM answer WHERE answer_id='$answer_id'");
              $row = mysqli_fetch_array($answer_text_array);
              $answer_text = $row['answer_text'];
              echo("
              $answer_text
              ");
              ?></p>
          </div>
        </div>

          <!-- Blog Post -->
        <div class="card mb-4" > 
          
          <div class="card-body">
            <h2 class="card-title">Your comment</h2>
            <?php
            echo("
            <form action='a-comment-prosses.php?a_id=$answer_id' method='POST'>
            <textarea class='col-md-12' rows='10' style='resize:none' name='comment_text' placeholder='Write here...' required></textarea>
            <div class='float-right'>
            <input type='submit' class='btn btn-primary' value='Submit' name='sub_boutton'>
            </div>
            </form>
            ");
            ?>
          </div>

          <div class="card-footer text-muted">
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
