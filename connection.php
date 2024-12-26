<?php
  $db_server="localhost";
  $db_user="root";
  $db_pass="";
  $db_name="csci390";

  $conn= mysqli_connect($db_server, $db_user, $db_pass, $db_name);
  try{
    $conn = mysqli_connect('localhost', 'root', '', 'csci390');
   
  }
  catch(mysqli_sql_exception){
    echo"Unable to connect";
  }
?>