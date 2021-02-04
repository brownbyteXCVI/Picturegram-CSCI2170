<!--

  CSCI 2170 - Assignment 4
  Name: Faiyaz Tanim (B00804542)
  Description of page: Users will be able to create their PictureGram account from this page

  //All sql queries in this page has been updated to prepared statements

-->


<?php
    session_start();

    //connecting to database
    $db_connection = new mysqli("localhost", "root", "root", "Picturegram");

    if($db_connection->connect_error){
      die("connection failed".mysqli_connect_errno());
    }

    //variable to keep track if the user's username and password are valid. If the variable = 2, then add user.
    $add_user = 0;  
    
    //extracting the user inputted form data 
    if(isset($_POST["name"], $_POST["user_description"], $_POST["userImg"], $_POST["userName"], $_POST["password"]  ) ) {

          $name = $_POST["name"];
          $user_description = $_POST["user_description"];
          $userImg = $_POST["userImg"];
          $userName = $_POST["userName"];
          $password = $_POST["password"];

          //query to see if the user inputted username is already taken (present in the database)
          $match_username = $db_connection->prepare("SELECT * FROM Login WHERE Username = ? ");

          $match_username->bind_param("s",$userName);

          $match_username->execute();

          $match_username_result = $match_username->get_result();
        
          //variables storing username, password and userID from the login table
          $username_db;
          $password_db;
          $userID_db;

          //fetching username, password and userID from the login table
            while($row = $match_username_result->fetch_assoc()){ 

              $username_db = $row[Username];
              $password_db = $row[Password];
              $userID_db = $row[UserID];

              }

       
          //PASSWORD CHECK
          if(isset($_POST["createButton"])){
    
            //password entered by the user
            $user_password = $_POST["password"];
        
            //regex pattern to match with the user entered password
            /* The regex pattern will make sure that password contains atleats one number and a capital letter.
             * That the password is atleast 7 characters in length. And that it contains no special character
            */
            $pattern = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{7,}$/"; 
            
            //if the user entered password matches with the regex pattern
            if(preg_match($pattern, $user_password)===1){
                $match = "Password Successful!";
                $add_user++;
            }
        
            //if password is NOT valid (doesn't match with the regex pattern)
            else{
  
      
                   //if the password has less than 7 characters, doesn't contain any capital letter, has no numbers and contains no special charactersx
                  if(strlen($user_password)<7 && !preg_match("/[A-Z]/", $user_password) && !preg_match("/[0-9]/", $user_password) && !preg_match("/[@$!%*#?&]/", $user_password)){
                      $match = "PASSWORD CREATE ERROR!<br>Need atleast 7 characters.<br>Need atleast 1 capital letter.<br>Need atleast 1 number.<br>Need atleast 1 special character.<br>Please try again!";
                  }
             
                  //if the password is too short and doesn't contain a number
                  else if(strlen($user_password)<7 && !preg_match("/[0-9]/", $user_password)){
                      $match = "PASSWORD CREATE ERROR!<br>Need atleast 7 characters.<br>Need atleast 1 number.<br>Please try again!"; 
                      
                  }
      
                   //if the password has less than 7 characters and doesn't contain any capital letter
                   else if(strlen($user_password)<7 && !preg_match("/[A-Z]/", $user_password)){
                      $match = "PASSWORD CREATE ERROR!<br>Need atleast 7 characters.<br>Need atleast 1 capital letter.<br>Please try again!";
                  }
      
                  //if the password has less than 7 characters and doesn't contain any special character
                  else if(strlen($user_password)<7 && !preg_match("/[@$!%*#?&]/", $user_password)){
                      $match = "PASSWORD CREATE ERROR!<br>Need atleast 7 characters.<br>Need atleast 1 special character.<br>Please try again!";
                  }
      
                  //if the password is missing atleast 1 Capital letter
                  else if (!preg_match("/[A-Z]/", $user_password)){
                      $match = "PASSWORD CREATE ERROR!<br>Need atleast 1 capital letter.<br>Please try again!";
                      
                  }
      
                  //if the password has less than 7 characters (password too short)
                  else if(strlen($user_password)<7 ){
                      $match = "PASSWORD CREATE ERROR!<br>Need atleast 7 characters.<br>Please try again!";
                  }
      
                  //if the password is missing atleast 1 number
                  else if (!preg_match("/[0-9]/", $user_password)){
                      $match = "PASSWORD CREATE ERROR!<br>Need atleast 1 number.<br>Please try again!";
                  }  
                  
                  //if the password is missing atleast 1 special character
                  else if (!preg_match("/[@$!%*#?&]/", $user_password)){
                      $match = "PASSWORD CREATE ERROR!<br>Need atleast 1 special character.<br>Please try again";
                  }
                  
              }


            }  

          //if user entered a username that's already taken
          if($username_db==$userName){
              
              $message = "Error: Username already exists. Select another username<br>";
          }

          //if user entered a username is NOT taken
          else{
            $add_user++;

          }

          

          //insert user inputted form data into the database (when the password is valid and the username is NOT taken)
          if ($add_user == 2){

            //query to insert user inputted data into the Users table
            $insert_formData_Users = $db_connection->prepare("INSERT INTO Users ( Name, About, AboutImage) VALUES(?, ?, ?) ");

            $insert_formData_Users->bind_param("sss", $name, $user_description, $userImg);

            $insert_formData_Users->execute();

              //insert data first into Users table
              if($db_connection->query($insert_formData_Users)===TRUE){
                
                echo "new record added successfully to users";

              }
              
              //get the latest UserID from the Users table (later used to insert as the UserID(foreign key) in the login table)
              $newID= $db_connection->insert_id;

              //hassing the password 
              $password = password_hash($password, PASSWORD_DEFAULT);
              
              //query to enter user inputted form data into the login table
              $insert_formData_login = $db_connection->prepare("INSERT INTO login ( UserID, Username, Password) VALUES(?, ?, ?) ");

              $insert_formData_login->bind_param("iss",$newID, $userName, $password );

              $insert_formData_login->execute();


              //insert data into login table
              if($db_connection->query($insert_formData_login)===TRUE){
                
                echo "new record added successfully to login";

              }

             //re-direct user to homepage after account has been successfully created

                 //session to save UserID and user's name
                 $_SESSION["nameOfUser"]= $name;
                 $_SESSION["aboutDesc"] = $user_description;
                 $_SESSION["aboutImg"] = $userImg;
                 $_SESSION["userID"]= $newID;
                 $_SESSION["LoggedIN"] = true;
              

            }
       
      }

      //unsuccessful entry of form data
      else{
      //echo "form data hasn't been successfully processed";
      }

      //redirect user to homepage (index.php) if user has successfully created an accounts
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
      <a class="navbar-brand" href="about.php">Faiyaz Tanim</a>
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
            <h2 class="subheading" id="login_title_subheading">CREATE ACCOUNT</h2>
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
                <label>Name</label>
                <input name="name" type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter yourname.">
                <p class="help-block text-danger"></p>
              </div>
            </div>

            <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Tell us about you</label>
              <textarea name="user_description"  type="text" class="form-control" placeholder="Tell us about you" id="about you" required data-validation-required-message="Please tell us about you."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Image</label>
              <input name="userImg"  type="text" class="form-control" placeholder="Image" id="image" required data-validation-required-message="Please enter image details.">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>UserName</label>
              <input name="userName"  type="text" class="form-control" placeholder="UserName" id="username" required data-validation-required-message="Please enter your user name.">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Password</label>
              <input name="password"  type="password" class="form-control" placeholder="Password" id="password" required data-validation-required-message="Please enter your password.">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <br>

          <button class="btn btn-primary" name="createButton" id="sendMessageButton">Create account</button>

            <br>
            <?php

            //prints error message: Username already exists!
            if($message!=""){
              echo $message;
            }

            //password check 
            if($match!=""){
              echo $match;
            }


            ?>
          

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
