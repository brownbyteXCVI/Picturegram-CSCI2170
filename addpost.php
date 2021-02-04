<!--
  CSCI 2170 - Assignment 4
  Name: Faiyaz Tanim (B00804542)

  Description of page: This page allows a user to add new posts, which will appear on feed or homescreen of other users

  //All sql queries in this page has been updated to prepared statements

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

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>addPost</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.css" rel="stylesheet">

  <style>
  .main-content{
    width: 800px;
  margin: 0 auto;
  text-align: left;
  }

  #submit_btn{
    background-color: grey;
    border-color: white;
  }

  
  }
  </style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="about.php?AboutImg=<?php echo $_SESSION["aboutImg"] ?> & AboutDesc=<?php echo $_SESSION["aboutDesc"] ?> & AuthorName=<?php echo $_SESSION["nameOfUser"]?> "><?php echo $_SESSION["nameOfUser"] ?></a>
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
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addpost.php">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addpost.php?logout=1">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/logo.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>picturegram</h1>
            <!-- span chnaged to h3 for subheading-->
            <h3 class="subheading" id="add-post-subheading">ADD NEW POST</h3>
          </div>
        </div>
      </div>.
    </div>
  </header>




  <!-- Main Content -->
<div class="main-content">

  <?php 


  //connecting to database
  $db_connection = new mysqli("localhost", "root", "root", "Picturegram");

  ?>  
    
        <!-- Add Post Form -->
        <div class="card my-4">
          <h5 class="card-header">Add a Post:</h5>
          <div class="card-body">
            <form method="POST">
            <div class="form_headings">Post:</div>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="post_title"></textarea>
              </div>
              <div class="form_headings">Image Filename:</div>
              <div class="form-group">
                <textarea class="form-control" rows="1" name="post_image"></textarea>
              </div>
              <button type="submit" class="btn btn-primary" id="submit_btn" name="submit">Submit</button>
            </form>
          </div>
        </div>

  <?php 

  $userID = $_SESSION["userID"];

  //check if the form has been submitted
  if(isset($_POST['submit'])){

    //retrieve form information
    $post_title= $_REQUEST['post_title'];
    $post_image = $_REQUEST['post_image'];

    //getting the current date when a user posts a comment by creating a DateTime object
    $date = new DateTime("now", new DateTimeZone('America/Halifax') );
    $date = $date->format('Y-m-d H:i:s');
     
    
    //inserting user input form data into Post table of Picturegram database
    $insert_query = $db_connection->prepare("INSERT INTO Posts(UserID, PostImage, Post, Date) VALUES(?, ?, ?, ?)");

    $insert_query->bind_param("isss", $userID, $post_image, $post_title, $date);

    $insert_query->execute();
    
    if($db_connection->query($insert_query)==TRUE){

     // echo "Image successfully posted";
      
    }
    else{
      echo "Error".$insert_query."<br>".$db_connection->error;
    }

  

  }

  

  ?>

</div>
            

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
