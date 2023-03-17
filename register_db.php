<?php
  session_start();
  include('server.php');
  $errors = array();

 if(isset($_POST['register'])){
   $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
   $email = mysqli_real_escape_string($conn,$_POST['email']);
   $password1 = mysqli_real_escape_string($conn,$_POST['password1']);
   $password2 =mysqli_real_escape_string($conn,$_POST['password2']);
   $id = "";
   $address = "";
   $tel = "";



   if (empty($firstname)) {
       array_push($errors, "Firstname is required");
       $_SESSION['error_f'] = "Firstname is required";
   }
   if(empty($lastname)){
     array_push($errors,"Lastanme is required");
      $_SESSION['error_l'] = "Lastname is required";
   }
   if (empty($email)) {
       array_push($errors, "Email is required");
       $_SESSION['error_e'] = "Email is required";
   }
   if (empty($password1)) {
       array_push($errors, "Password is required");
       $_SESSION['error_p'] = "Password is required";
   }
   if ($password1 != $password2) {
       array_push($errors, "passwords do not match");
       $_SESSION['error_p'] = "passwords do not match";
   }

   if($password1!=$password2){
     array_push($errors, "passwords do not match");
     $_SESSION['error_p'] = "passwords do not match";
   }

   $user_check_query = "SELECT * FROM customer WHERE email = '$email' OR password = '$password1' LIMIT 1";
   $query = mysqli_query($conn, $user_check_query);
   $result = mysqli_fetch_assoc($query);

   if ($result) { // if user exists
       if ($result['email'] == $email) {
           array_push($errors, "email already exists");
           $_SESSION['error_e'] = "email already exists";
       }
   }

   if(count($errors)==0){
     $password = md5($password1);
     $sql = "INSERT INTO customer(firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password') ";
     mysqli_query($conn,$sql);
     $_SESSION['firstname'] = $firstname;
     $_SESSION['lastname'] = $lastname;
     $_SESSION['success'] = "Your are logged in";
     $insert = "INSERT INTO book(id,address,tel,email) VALUES ('$id', '$address', '$tel', '$email')";
     mysqli_query($conn,$insert);
     header('location:login.php');
   }else {
    header("location: register.php");
   }

 }


 ?>
