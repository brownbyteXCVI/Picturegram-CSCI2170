/*

common functions

*/

<?php

//start session
session_start();


//connect to database
$db_connection = new mysqli ("localhost", "root", "root", "Picturegram" );

  if($db_connection->connect_error){
    die("connection failed".mysqli_connect_errno());
  }

//display all from table query
$display_query = "SELECT * from ";


//check if information has been added to table/database
if($db_connection->query($insert_query)===TRUE){
  echo "successfully added information into database";        
}
else{
  echo "Error adding information to database" ;
}

//insert query for inserting data into comments table
$insert_query = "INSERT INTO Comments(UserID, PostID, Comment, Date) VALUES ('1', '$varPost_ID', '$user_comment', '$date')";


$result = mysqli_query($db_connection,$display_query);
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
    
    $comment = $row[Comment];
    $date = $row[Date];
    $date = date("D. M. j, Y H:i", strtotime($date));

    }
  
  }

//close database connection
$db_connection->close();

?>