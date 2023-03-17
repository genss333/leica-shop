<?php
    session_start();
    include 'server.php';
 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register Accout</title>
    <link rel="stylesheet" href="register.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
</style>
  </head>
  <body>
    <div class="register">
      <div class="container">
        <div class="logo">
        <p>Create Your Accout</p>
        </div>
        <form class="form-container" action="register_db.php" method="post">
          <div class="row-1">
            <input type="text" name="firstname" placeholder="First name">
            <input type="text" name="lastname" placeholder="Last name">
            <!------errors session------>
            <?php include('error.php'); ?>
            <?php if (isset($_SESSION['error_f'])) : ?>
                <div class="error_firstname">
                    <p>
                        <?php
                            echo $_SESSION['error_f'];
                            unset($_SESSION['error_f']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
        <!------errors session------>
            <?php include('error.php'); ?>
            <?php if (isset($_SESSION['error_l'])) : ?>
                <div class="error_lastname">
                    <p>
                        <?php
                            echo $_SESSION['error_l'];
                            unset($_SESSION['error_l']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

          </div>

          <div class="row-2">
            <input type="text" name="email" placeholder="E-mail">
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
          </div>
          <div class="row-3">
            <input type="password" name="password1" placeholder="Password">
            <input type="password" name="password2" placeholder="Confirm">
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
          </div>
          <div class="singin">
              <a href="login.php">Sing in instead?</a>
          </div>
          <div class="btn">
              <button type="submit" name="register">Register</button>
          </div>
        </form>
      </div>

    </div>


  </body>
</html>
