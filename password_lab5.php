<!--

CSCI 2170 Lab 5
Name: Faiyaz Tanim (B00804542)
Date: 01/12/20
Description: This webpage checks if a user entered password is valid (By meeting preset regex rules).

-->

<html lang="en">

<!-- Add you code here -->   
    
<?php

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
    }

    //if password is NOT valid (doesn't match with the regex pattern)
    else{

        /*
            //if the password contains non-alphanumeric characters (contains special characters)
            if(preg_match("/^.*\W.*$/", $user_password)){
                $match = "Must all be numeric or alpha characters";

            }
        */   

             //if the password has less than 7 characters, doesn't contain any capital letter, has no numbers and contains no special charactersx
            if(strlen($user_password)<7 && !preg_match("/[A-Z]/", $user_password) && !preg_match("/[0-9]/", $user_password) && !preg_match("/[@$!%*#?&]/", $user_password)){
                $match = "PASSWORD CREATE ERROR!<br>Need atleast 7 characters.<br>Need atleast 1 Capital Letter.<br>Need atleast 1 number.<br>Need atleast 1 special character.<br>Please try again!";
            }
       
            //if the password is too short and doesn't contain a number
            else if(strlen($user_password)<7 && !preg_match("/[0-9]/", $user_password)){
                $match = "PASSWORD CREATE ERROR!<br>Need atleast 7 characters.<br>Need atleast 1 number.<br>Please try again!"; 
                
            }

             //if the password has less than 7 characters and doesn't contain any capital letter
             else if(strlen($user_password)<7 && !preg_match("/[A-Z]/", $user_password)){
                $match = "PASSWORD CREATE ERROR!<br>Need atleast 7 characters.<br>Need atleast 1 Capital Letter.<br>Please try again!";
            }

            //if the password has less than 7 characters and doesn't contain any special character
            else if(strlen($user_password)<7 && !preg_match("/[@$!%*#?&]/", $user_password)){
                $match = "PASSWORD CREATE ERROR!<br>Need atleast 7 characters.<br>Need atleast 1 special character.<br>Please try again!";
            }

            //if the password is missing atleast 1 Capital letter
            else if (!preg_match("/[A-Z]/", $user_password)){
                $match = "PASSWORD CREATE ERROR!<br>Need atleast 1 Capital Letter.<br>Please try again!";
                
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

?>
    
    
<form name="createAccountForm" method="post">
<input type="password" name="password" class="form-control" placeholder="Password input">

<button type="submit" name="createButton" value="Submit" class='btn btn-primary'>Submit</button>

 <?php
    
    //printing appropriate success/error message
    echo "<br>$match";
 
 ?>
</form>

</html>