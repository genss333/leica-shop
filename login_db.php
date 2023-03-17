<?php
    session_start();
    include('server.php');

    $errors = array();

    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        session_start();
        $_SESSION["member"] = $email;
        if($email == "admin@ac.th"){
            session_start();
            $_SESSION["addmin"] = $email;
        }

        if (empty($email)) {
            array_push($errors, "email is required");
            $_SESSION['error_e'] = "Email is required";
            header("location: login.php");
        }

        if (empty($password)) {
            array_push($errors, "Password is required");
            $_SESSION['error_p'] = "Password is required";
            header("location: login.php");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM customer WHERE email = '$email' AND password = '$password' ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "Your are now logged in";
                header("location: index.php");
            } else {
                array_push($errors, "Wrong Username or Password");
                $_SESSION['error_log'] = "Wrong Username or Password!";
                header("location: login.php");
            }
        } else {
            array_push($errors, "Username & Password is required");
            $_SESSION['error_log'] = "Username & Password is required";
              header("location: login.php");
        }
    }

?>
