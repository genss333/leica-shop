<?php
      session_start();
      include('server.php');
      $errors =array();
      $member = $_SESSION['member'];

       if(isset($_POST['edit1'])){
         $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
         $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);

         if (empty($firstname)) {
           array_push($errors, "first name is requried");
           $_SESSION['error_f'] = "First name is requried";
           header("location:edit.php");
         }
         if (empty($lastname)) {
          array_push($errors, "lastname is requried");
          $_SESSION['error_l'] = "Lastname is requried";
          header("location: edit.php");
         }

         if(count($errors)==0){
           $query = "UPDATE `customer` SET `firstname` = '$firstname', `lastname` = '$lastname' WHERE `customer`.`email` = '$member'";
           $result = mysqli_query($conn,$query);
           header("location:index.php");
         }else {
           header("location: edit.php");
         }

       }



 ?>
