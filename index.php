<!--
  CSCI 2170 - Assignment 4
  Name: Faiyaz Tanim (B00804542)

  Description of page: This is the home page of our website (Picturegram). Users will be able to see posts made by other users.
  See post images, authors and when posts were made/uploaded.

  References:

  >Permission to use Dummy text, Lorem Ipsum, were given by course Instructor (CSCI 2170)
  >the images fall.jpg and beach.jpg were taken from creative commons. Retrieved from: https://search.creativecommons.org

  //All sql queries in this page has been updated to prepared statements
-->

<?php

  session_start();
  

  if(!isset($_SESSION["userID"]) && $_SESSION["LoggedIN"]!==true){
  
    header("location: login.php");
   
  }

  //when user logs out, session is destroyd and user is re0directed to the login page
  if($_GET["logout"] == 1) {
    $_SESSION["LoggedIN"] = false;
    session_destroy();
    //unset($_SESSION['userID']);
   //unset($_SESSION['useLoggedINrID']);
    header("location:login.php");
    echo "sbdcebce";
  }


    

  ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Picturegram</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.css" rel="stylesheet">

  <!-- styles applied to centre the image, text and lorumm nullam -->
  <style>

    /* Styling post image, title and meta-data (Author name, date-time) */

    

  .php_files_img{
    display: block;
    height: 380px;
    width: 720px;
  }

  .post-title{
    width: 720px;
    margin-top: 10px; 
    font-weight: 300;
    
  }

  .post-auth{
    font-size: 18px;
    font-style: italic;
  }

  .post-secondary-data{
    font-size: 18px;
    font-style: italic;
    color: #868e96;
  }

  .php_files_h4{
      text-align: centre;
      width: 720px;
  }

  .php_files_p{
    margin-top: 10px;
  }


  .main-container{
    margin-left: 27%;
  }

  
  
  </style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <!-- Using sessions to send user information to about.php (about page) when user clicks on their name (info of current user logged in) -->
      <a class="navbar-brand" href="about.php?AboutImg=<?php echo $_SESSION["aboutImg"] ?> & AboutDesc=<?php echo $_SESSION["aboutDesc"] ?> & AuthorName=<?php echo $_SESSION["nameOfUser"]?> "><?php echo $_SESSION["nameOfUser"];?></a>
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

            <!-- Using sessions to send user information to about.php (about page) when user clicks on the about nav link (info of current user logged in) -->
            <a class="nav-link" href="about.php?AboutImg=<?php echo $_SESSION["aboutImg"] ?> & AboutDesc=<?php echo $_SESSION["aboutDesc"] ?> & AuthorName=<?php echo $_SESSION["nameOfUser"]?> ">About</a>
          </li>
          <li class="nav-item">
          <!-- sending data using queryStrings to addpost.php page-->
          <a  href="addpost.php?bannerImg=<?php echo $image?> & postFile=<?php echo $PostFile?> & authorName=<?php echo $Author?> & time_Date=<?php echo $timestamp?>  & comment=<?php echo $comments ?>">Add Post</a>
          </li>
          
          <li class="nav-item">
          <!-- logout a user  -->
            <a class="nav-link" name="logout" href="index.php?logout=1">Logout</a>
          
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
            <h1>Picturegram</h1>
            <span class="subheading">your life in pictures</span>
          </div>
        </div>
      </div>.
    </div>
  </header>

  <!-- Main Content -->

<div class="main-container">

  <?php

  
  //connecting to database 
  $db_connection = new mysqli ("localhost", "root", "root", "Picturegram" );

  if($db_connection->connect_error){
    die("connection failed".mysqli_connect_errno());
  }
  
  /*a fter connection has beeen established */

  //creating and displaying query (the newest posts first)
  $displayAll_query = $db_connection->prepare("SELECT * FROM Posts ORDER BY Posts.Date DESC");

  $displayAll_query->execute();


  $result = $displayAll_query->get_result();


    while ($row = $result->fetch_assoc()){      
      
      $Author_ID = $row[UserID];
      $image = $row[PostImage];
      $title =  $row[Post];
      $timestamp = $row[Date];

      $timestamp = date("F jS, Y - G:ia ", strtotime($timestamp));//converting to an appropriate datetime format
      
      //variable to track post ID. Query stringed to post.php
      $post_ID=$row[PostID];

    /* This block of code gets the Author name (User's name) corresponding to their UserID.
     * This info will be used as post author for the homepage and for the About page 
     */

        //db query to get user's name
        $get_name = $db_connection->prepare("SELECT * FROM Users WHERE UserID = ? ");

        //binding the variables to the prepared statements
        $get_name->bind_param("i",$Author_ID );

        //executing the query
        $get_name->execute();

        $get_name_result = $get_name->get_result();

        $Author_Name; //variable to store name of user
        $Author_Img; //variable to store about image of user
        $Author_desc; //variable to store about description of user

        //get username and password from the login table
        while($row = $get_name_result->fetch_assoc()){ 

          $Author_Name = $row[Name];
          $Author_desc = $row[About];
          $Author_Img = $row[AboutImage];
          

          }

  ?>  
    <!-- THe post images and information html -->

      <!--post image-->

       <!--using query string to pass values to post.php-->
      <a  href="post.php?bannerImg=<?php echo $image?> & postFile=<?php echo $title?> & authorName=<?php echo $Author_name?> & time_Date=<?php echo $timestamp?>& post_ID=<?php echo $post_ID ?>">

      <img class="php_files_img" a="post.php" src="img/<?php echo $image ?>"  alt="">

      </a>

      <!--using query string to pass values to post.php-->  
      <a href="post.php?bannerImg=<?php echo $image?> & postFile=<?php echo $title?> & authorName=<?php echo $Author_name?> & time_Date=<?php echo $timestamp?>& post_ID=<?php echo $post_ID ?>">      
        <h3 class="post-title" ><?php echo $title ?></h3>
      </a>


      <!-- author names, and timestamp of post -->

      <!-- seperate <span> were used to help styling the individual elements-->
      <span class="post-secondary-data" ><?php echo "Posted by"?></span>
      
      <!-- direct user to the about page of the Author of the post -->
      <a class="post-auth" href="about.php?AboutImg=<?php echo $Author_Img ?> & AboutDesc=<?php echo $Author_desc ?> & AuthorName=<?php echo $Author_Name?> "> <span><?php echo $Author_Name ?> </span> </a>

      <span class="post-secondary-data"><?php echo " on $timestamp <br> <br>" ?> </span>


      <?php

    }
  
  //closing connection to database
  $db_connection->close();
  
  ?>

</div>

        <hr>   
        
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
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
