<?php
    session_start();
    include('server.php');

  if(!isset($_SESSION['member'])){
    header("location: login.php");
  }
  if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['member']);
    header("location: index.php");
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit data</title>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="index.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
</style>
  </head>
  <body>
    <div class="container"style="margin:200px 0;">
        </div>

    <div class="content">
      <div class="logo">
      <p>แก้ไขข้อมูลติตต่อ</p>
      </div>
    <form class="form-container"action="edit_data.php" method="post">
      <div class="row">
        <input type="text" name="address" placeholder="ที่อยู่">
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
            <?php endif; ?>
      </div>
      <div class="row">
        <input type="tel" name="tel" placeholder="เบอร์โทร">
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
        <?php endif; ?>
      </div>


      <div class="btn">
          <button type="submit" name="edit">แก้ไข</button>
      </div>
    </form>
  </div>

  </body>
</html>
