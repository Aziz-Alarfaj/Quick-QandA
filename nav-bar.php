<?php
session_start();
if(!isset($_SESSION['username']))
{
   echo (" 
   <!-- Navigation without session-->
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark fixed-top'>
      <div class='container'>
        <a class='navbar-brand' href='index.php'>Quick Q&amp;A </a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarResponsive'>
          <ul class='navbar-nav ml-auto'>
            <li class='nav-item active'>
              <a class='nav-link' href='#'>About
                <span class='sr-only'>(current)</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='page-login.php'>Login</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='page-signup.php'>Sign up</a>
            </li>
            <li>
              <a href='page-login.php' class='btn btn-primary'>Ask a question</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>");
}
else 
{
    echo (" 
    <!-- Navigation with session-->
     <nav class='navbar navbar-expand-lg navbar-dark bg-dark fixed-top'>
       <div class='container'>
         <a class='navbar-brand' href='index.php'>Quick Q&amp;A </a>
         <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
           <span class='navbar-toggler-icon'></span>
         </button>
         <div class='collapse navbar-collapse' id='navbarResponsive'>
           <ul class='navbar-nav ml-auto'>
             <li class='nav-item active'>
               <a class='nav-link' href='#'>About
                 <span class='sr-only'>(current)</span>
               </a>
             </li>
             <li class='nav-item'>
               <a class='nav-link' href='account-page.php'> ".$_SESSION['username']." <img src='images/user.png' alt='user pic'></a>
             </li>
             <li class='nav-item'>
                <a class='nav-link' data-toggle='modal' href='#myModal'>Sign out</a>
             </li>
             <li>
               <a href='page-ask-question.php' class='btn btn-primary'>Ask a question</a>
             </li>
           </ul>
         </div>
       </div>
     </nav>");
}
?>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Sign out &#x1f512;</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       Are you sure you want to sign out?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <a href='signout.php' class='btn btn-primary'>Yes, Sign out</a>
      </div>

    </div>
  </div>
</div>
