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

        <h1 class="my-4">Recently asked questions
          <!-- ME <small>Secondary Text</small> -->
        </h1>
        <!-- <div class='card-body'> -->
          <div class='overflow-auto' style='height: 1000px'>
        <!-- POST -->
        <?php
          include_once 'DB-CONFIG.php';
          $con = mysqli_connect(HOST,DBUSER,DBPWD,DBNAME);

          //check connection
          if(!$con){
            die("Failed to connect to MySQL: " . mysqli_connect_error());
          }
          $result = mysqli_query($con,"SELECT * FROM question ORDER BY question_id DESC");
          $user = mysqli_query($con,"SELECT user.username, user.user_id FROM user INNER JOIN question ON user.user_id = question.user_id ORDER BY question_id DESC");
          while($row = mysqli_fetch_array($result))
          {
            //shorten question text
            $question_text = $row['question_text'];
            if(strlen($question_text) > 200)
            {
              //turnecate string
              $string_cut = substr($question_text, 0, 200);
              $end_point = strripos($string_cut, ' ');

              //if the string doesn't contain any space then it will cut without word basis.
              $question_text = $end_point? substr($string_cut, 0, $end_point) : substr($string_cut, 0);
              $question_text .= '...';
            }
            $question_id = $row['question_id'];
            echo ("
            <div class='card mb-4'>
              <div class='card-body'>
                <h2 class='card-title'>".$row['question_title']."</h2>
                <p class='card-text'>".$question_text."</p>
                <a href='page-view-question.php?q_id=$question_id'class='btn btn-primary'>See question &rarr;</a>
              </div>
              <div class='card-footer text-muted'>
                Posted on ".$row['question_date']." by ");
                  $asker = mysqli_fetch_array($user);
                    echo ("<span style='font-weight:600'>".$asker['username']."</span>
              </div>
            </div>");
          }
          
          mysqli_close($con);
        ?>
        <!-- </div> -->
          </div>
          <br>
        
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
