<?php
    session_start();
    include('server.php');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
</style>
  </head>
  <body>
    <div class="login">
    <div class="border">
      <div class="logo">
          <div class="titel">
            <p1>Sing in</p1><br>
            <p2>Use Your Accout</p2>
          </div>
        </div>
        <div class="input">
          <form class="form-container" action="login_db.php" method="post">
              <input type="email" name="email" placeholder="E-mail or Phone" >
              <?php include('error.php'); ?>
              <?php if (isset($_SESSION['error_e'])) : ?>
                  <div class="error_email">
                      <p>
                          <?php
                              echo $_SESSION['error_e'];
                              unset($_SESSION['error_e']);
                          ?>
                      </p>
                  </div>
              <?php endif ?>
              <input type="password" name="password" placeholder="Enter Your Password">
              <?php include('error.php'); ?>
              <?php if (isset($_SESSION['error_p'])) : ?>
                  <div class="error_password">
                      <p>
                          <?php
                              echo $_SESSION['error_p'];
                              unset($_SESSION['error_p']);
                          ?>
                      </p>
                  </div>
              <?php endif ?>

              <?php include('error.php'); ?>
              <?php if (isset($_SESSION['error_log'])) : ?>
                  <div class="error_log">
                      <p>
                          <?php
                              echo $_SESSION['error_log'];
                              unset($_SESSION['error_log']);
                          ?>
                      </h3>
                  </p>
              <?php endif ?>
              <div class="next">
                <button type="submit" name="login">Login</button>
              </div>
              <div class="create">
                <a href="register.php">Create Accout?</a>
              </div>
          </form>
        </div>
      </div>
      </div>
  </body>
</html>
