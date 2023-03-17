<?php

        session_start();
        include('server.php');
        $errors =array();
        $member = $_SESSION['member'];

        if(isset($_POST['edit'])){
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        $tel = mysqli_real_escape_string($conn,$_POST['tel']);

        if (empty($tel)) {
          array_push($errors, "tel is requried");
          $_SESSION['error_f'] = "Tel is requried";
          header("location:editdata.php");
        }
        if (empty($address)) {
         array_push($errors, "address is requried");
         $_SESSION['error_l'] = "Address is requried";
         header("location: editdata.php");
        }

        if(count($errors)==0){
          $query = "UPDATE `book` SET `address` = '$address', `tel` = '$tel' WHERE `book`.`email` = '$member'";
          $result = mysqli_query($conn,$query);
          header("location:index.php");
        }else {
          header("location:editdata.php");
        }

      }
 ?>
