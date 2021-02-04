<!--
  CSCI 2170 - Assignment 4
  Name: Faiyaz Tanim (B00804542)
  Description of page: This page shows user details and info

-->

<?php

session_start();

if(!isset($_SESSION["userID"]) && $_SESSION["LoggedIN"]!==true){
  
  header("location: login.php");
 
}

//when user logs out, session is destroyd and user is re0directed to the login page
if($_GET["logout"]==1){
  $_SESSION["LoggedIN"]=false;
  session_destroy();
  header("location: login.php");
}

//Finding out the type of request being made
$request=$_SERVER['REQUEST_METHOD'];

//getting query stringed data from the index page (home page) about the user. 
if($request == "GET"){
$Author_Name = $_GET["AuthorName"];
$Author_about = $_GET["AboutDesc"];
$Author_img = $_GET["AboutImg"];

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>about</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
    <!-- the user's name has been hidden from the nav bar of their about page -->
    <!--   <a class="navbar-brand" href="about.php?AboutImg= <?php echo $_SESSION["aboutImg"] ?> & AboutDesc=<?php echo $_SESSION["aboutDesc"] ?> & AuthorName=<?php echo $_SESSION["nameOfUser"]?> "><?php echo $Author_Name  ?></a> -->

      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <!-- re-direct user to the their about page (info of current user logged in) -->
            <a class="nav-link" href="about.php?AboutImg=<?php echo $_SESSION["aboutImg"] ?> & AboutDesc=<?php echo $_SESSION["aboutDesc"] ?> & AuthorName=<?php echo $_SESSION["nameOfUser"]?> ">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addpost.php">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php?logout=1">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->


  <header class="masthead" style="background-image: url('img/<?php echo $Author_img ?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1><?php echo $Author_Name?></h1>
            <span class="subheading">This is what I do.</span>
          </div>
        </div>
      </div>
    </div>
  </header>



  <!-- Main Content -->
  <div class="container">


   <p><?php echo $Author_about ?></p>
    
  </div>

  <?php

  // break will stop at only one user
 

  //$db_connection->close();

  ?>

  <hr>


  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

          <p class="copyright text-muted">Copyright &copy; Your Website 2020</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
