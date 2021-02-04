<!--
  CSCI 2170 - Assignment 4
  Name: Faiyaz Tanim (B00804542)
  Description of page: Users will be able to login into their Picturegram account using this login page

  Sessions variables created in this page (login.php):

  1. name ($name), about description ($about_desc) and about image ($about_img) of user from the Users table
  2. user id ($userID_db), user name ($username_db) of user from the Login table

  Decrypted passwords of users:
  1. Martha Stewart, password: Password1!
  2. Jona, password: Password2!
  3. Robert Downey, password: Password3!

  //All sql queries in this page has been updated to prepared statements

  Update (Jan 6 2021) : Only the accounts with encrypted passwords work
-->

<?php

 session_start();


 //connecting to database
 $db_connection = new mysqli("localhost", "root", "root", "Picturegram");

 if($db_connection->connect_error){
   die("connection failed".mysqli_connect_errno());
 }
 
 
 if(isset($_POST["submit"])){
   $userName_form = $_POST["userName"];
   $password_form = $_POST["password"];

   //db query to get username and password from the login table of Picturegram db AND Password = $password_form
   $get_userN_pass = $db_connection->prepare("SELECT * FROM Login WHERE Username = ? ");

   $get_userN_pass->bind_param("s", $userName_form);

   $get_userN_pass->execute();

   $get_userN_pass_result = $get_userN_pass->get_result();

   $password_db; //password from login table
   $username_db; //Username from login table
   $userID_db; //UserID from login table

   //get username and password from the login table
     while($row = $get_userN_pass_result->fetch_assoc()){ 

       $username_db = $row[Username];
       $password_db = $row[Password];
       $userID_db = $row[UserID];

     }

   

  //db query to get user's name
  $get_name = $db_connection->prepare("SELECT * FROM Users WHERE UserID = ? ");

  $get_name->bind_param("i",$userID_db);

  $get_name->execute();

  $get_name_result = $get_name->get_result();

  $name; //variable to store name of user
  $about_desc; //variable to store about description of user
  $about_img; //variable to store abput image of user

  //get username and password from the login table
    while($row = $get_name_result->fetch_assoc()){ 

      $name = $row[Name];
      $about_desc = $row[About];
      $about_img = $row[AboutImage];
      

    }


 //if user entered the wrong username 
 if($username_db!=$userName_form){
   
   $message = "Username is incorrect, please try again";
 }

 //verifying the user entered password with the hashed password stored in the database
 else if(password_verify($password_form, $password_db) == false){

  $message = "Password is incorrect, please try again";

 }
 

 //login user if username and password are correct 
 else if($username_db==$userName_form && password_verify($password_form, $password_db) == true ){
 
  $_SESSION["nameOfUser"] = $name;
  $_SESSION["aboutDesc"] = $about_desc;
  $_SESSION["aboutImg"] = $about_img;
  
  $_SESSION["userID"] = $userID_db;
  $_SESSION["LoggedIN"]=true;
 
 }

 
}
 
//redirect user to homepage (index.php) if login credentials are correct
 if(isset($_SESSION["userID"])){
  
   header("location: index.php");
   exit;
  
 }
 

 
 
  
  ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

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
      <a class="navbar-brand" href="about.php">Picturegram</a>
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
            <a class="nav-link" href="login.php">Login</a>
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
          <div class="page-heading">
            <h1>picturegram</h1>
            <h2 class="subheading" id="login_title_subheading">LOGIN TO YOUR ACCOUNT</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->

  


<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">


          <form action="" method="post">
          
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>User Name</label>
              <input name="userName" type="text" class="form-control" placeholder="UserName" id="name" required data-validation-required-message="Please enter your user name.">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Password</label>
              <input name="password" type="password" class="form-control" placeholder="Password" id="password" required data-validation-required-message="Please enter your password.">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <br>

          <input type="submit" name="submit" class="btn btn-primary" id="sendMessageButton">

          

          </form>
          <?php

          //print error message if username or password is wrong
          if($message!="") { echo $message; }
         

       // }
       
          ?>
          
         <br>

          <p>If you don't have an account, create one</p>
          
          <button type="submit" class="btn btn-primary"  form  id="sendMessageButton"><a href="createAccount.php">Create Account</a></button>
        

         </form>
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

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
