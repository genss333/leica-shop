<?php
  $server = "localhost";
  $username = "genss";
  $password = "1234";
  $dbname = "leica_shop";

  //create connections
  $conn=mysqli_connect($server,$username,$password,$dbname);
//checked connection
  if (!$conn) {
      die("Connection failed" . mysqli_connect_error());
  }

 ?>
