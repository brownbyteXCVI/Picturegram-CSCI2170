<!--
  CSCI 2170 - Assignment 4
  Name: Faiyaz Tanim (B00804542)

  Description of page: This is the redirected page whenever a user clicks and wants to know about a particular post. 
  The page contains an overlayer of the post's image, author and when it was created. As well as comments made by other users on that post.
  Users will also be able to make their own comments by typing into the text field.


-->
<?php
session_start();

//when user logs out, session is destroyd and user is re0directed to the login page
if($_GET["logout"]==1){
  $_SESSION["LoggedIN"]=false;
  session_destroy();
  header("location: login.php");
}

$userID = $_SESSION["userID"];

?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Post</title>

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
      <a class="navbar-brand" href="about.php?AboutImg=<?php echo $_SESSION["aboutImg"] ?> & AboutDesc=<?php echo $_SESSION["aboutDesc"] ?> & AuthorName=<?php echo $_SESSION["nameOfUser"]?> " ><?php echo$_SESSION["nameOfUser"]; ?></a>
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
            <a class="nav-link" href="post.php?logout=1">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <?php

  //connecting to databse - Picturegram
  $db_connection = new mysqli("localhost", "root", "root", "Picturegram");

  //error message if connection fails
  if($db_connection->connect_error){
    die("connection failed".mysqli_connect_errno());
  }

  //session to fetch author name from the about page (Users db connected there) 
  $Author_Name = $_SESSION["nameOfUser"];

  //Finding out the type of request being made
  $request=$_SERVER['REQUEST_METHOD'];

  //getting data, using GET method, from index.php for image, post content, author name, timestamp, for banner header
  //if the request is GET
  if($request == "GET"){
  $varBannerImg = $_GET['bannerImg'];
  $varPostFile = $_GET['postFile'];
  $varAuthName = $_GET['authorName'];
  $varTimestamp = $_GET['time_Date'];
  //getting post ID from the index page to use as reference to the post (postID) stored in the database
  $varPost_ID = $_GET['post_ID'];
  

  //working on comments php section
  //fetching variables from index.php page using GET method for the comment section
  
  }

  //if the request is POST, this will help to update the poage after the user submits a comment using POST method
  else{

    $varBannerImg = $_POST['bannerImg'];
    $varPostFile = $_POST['postFile'];
    $varAuthName = $_POST['authorName'];
    $varTimestamp = $_POST['time_Date'];
    $varPost_ID = $_POST['post_ID'];
    
  }
  
  ?>

  <!--Passing image value to the masthead-->
  <header class="masthead" style="background-image: url('img/<?php echo $varBannerImg ?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
          <!--passing post file content to post header-->
            <h3><?php echo $varPostFile ?></h3>
           <!-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2>  -->
            <span class="meta">Posted by
              <a href="about.php"><?php echo $Author_Name; ?></a>
              <?php echo "on $varTimestamp" ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  
<!-- Comment section form, for users to post and see comments-->

  <div class="comment-section">

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">

            <form method="post" action="post.php" >
              <div class="form-group">
                <textarea class="form-control" rows="3" name='user_comment'></textarea>
              </div>

              <!-- passing POST method values to keep the page updated even after the user sends a post request-->
              <input type="hidden" name="bannerImg" value="<?php echo $varBannerImg  ?>">
              <input type="hidden" name="postFile" value="<?php echo $varPostFile ?>">
              <input type="hidden" name="authorName" value="<?php echo $varAuthName  ?>">
              <input type="hidden" name="time_Date" value="<?php echo $varTimestamp  ?>">
              <input type="hidden" name="post_ID" value="<?php echo $varPost_ID ?>">
              <input type="hidden" name="date" value="<?php echo $date ?>">
              <button type="submit" class="btn btn-primary"  name="submit">Submit</button>
            </form>

          </div>
        </div>

       <?php


      //getting the current date when a user posts a comment by creating a DateTime object
      $date = new DateTime("now", new DateTimeZone('America/Halifax') );
      $date = $date->format('Y-m-d H:i:s');
      
          //Storing user comments on database when the submit button is pressed and the comment field is NOT empty
          if(isset($_POST['submit']) && $_POST["user_comment"]!==""){
       
                //retrieve form information - comments
                $user_comment = $_REQUEST["user_comment"];
              
                //inserting form information, comments, into Picturehgram database
                $insert_query = $db_connection->prepare("INSERT INTO Comments(UserID, PostID, Comment, Date) VALUES (?, ?, ?, ?) " );

                //binding variables to prepared statement
                $insert_query->bind_param("iiss", $userID, $varPost_ID, $user_comment, $date);

                $insert_query->execute();
                

               if($db_connection->query($insert_query)===TRUE){

                }
              
              }
                
             

            //display user comment query(these comments are displayed on POST request)
            $display_query = $db_connection->prepare("SELECT * from Comments WHERE PostID = ? ORDER BY CommentID DESC");

            //binding variables to prepared statement
            $display_query->bind_param("i", $varPost_ID);
            
            //executing the query
            $display_query->execute();

            $result = $display_query->get_result();

           
              while($row = $result->fetch_assoc()){
                
                $comment_userID = $row[UserID];
                $comment = $row[Comment];
                $date = $row[Date];
                $date = date("D. M. j, Y H:i", strtotime($date));

                //db query to get the name of the user who made the comment
                $get_comment_author = $db_connection->prepare("SELECT * from Users WHERE UserID= ? ");

                //binding variables to the prepared statement
                $get_comment_author->bind_param("i", $comment_userID);

                $get_comment_author->execute();

                $get_comment_author_result = $get_comment_author->get_result();

        

                //varibale to store the name of the user who made the comment
                $comment_author;

                //getting the name of the user who made the comment
                  while($row = $get_comment_author_result->fetch_assoc()){
                    $comment_author = $row[Name];
                  }
           
                
                ?>
             <!-- Comment Section to display user made comments on posts -->
             <div class="media mb-4">
                      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                      <div class="media-body">
                        <h5 class="mt-0">Date:  <?php echo "$date Author: $comment_author";?>
                        </h5>
                        <?php echo $comment;?>
                      </div>
              </div>

              <?php
              
              }


              
            //closing connections
            fclose($varComment);
            $db_connection->close();
            
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
