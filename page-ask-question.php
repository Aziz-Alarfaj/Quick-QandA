<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Quick Q&amp;A ask a question page </title>

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
          <h2 class="card-header">Ask your question</h2>
          <div class="card-body">
          <!-- question title -->
          <!-- <p class="card-text"> -->
          <h4>Your question title</h4>
          <form action="question-prosses.php" method="POST">
            <!-- part1 of form -->
            <textarea type="text" class="col-md-12" rows="2" style="resize:none" name="question_title" placeholder="Write here..." required></textarea>
            
          <!-- </p> -->
          <h4 class="card-title" style="margin-top: 20px">Question content</h4>
            <!-- part2 of form -->
            <textarea class="col-md-12" rows="10" style="resize:none" name="question_text" placeholder="Write here..." required></textarea>
            <span><small><strong>Note:</strong> write your question title clearly and precisely so people will be able to find your question</small></span>  
            <div class="float-right">
            <input type="submit" class="btn btn-primary" value="Submit" name="sub_boutton">
            </form>
            </div>
          </div>
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
