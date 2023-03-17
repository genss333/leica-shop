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
    <title>Home Page</title>
    <link rel="stylesheet" href="account.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
    </style>

  </head>
  <body>
    <div class="container" style="margin: 100px 0;">
    <div class="nvbar">
      <nav>
        <a href="index.php?logout=1"> <img src="/img/power-button.png" title="logout"></a>
      </nav>
      </div>
    <div class="title account">
      <h1>ข้อมูลส่วนบุคคล</h1>
      <p>ข้อมูลพื้นฐาน เช่น ชื่อและรูปภาพที่คุณใช้ในบริการต่างๆ</p>
    </div>
    <form class="body">
      <div class="head">
        <h1>ข้อมูลพื้นฐาน</h1>
        <a style="margin-left: 550px;" href="edit.php">แก้ไขข้อมูล</a>
      </div>
        <div class="col-2">
          <h4>รูปภาพของคุณ</h4>
          <a href="uploadfile.php">
            <div class="col-2-img" style="background: #555;">
              <?php
              $member = $_SESSION['member'];
              $select = "SELECT image FROM image WHERE member = '$member' ORDER BY id DESC LIMIT 1";
              $query =  $conn->query($select);
              if($query->num_rows > 0){
                while ($row = $query->fetch_assoc()) {?>
                <img src="/leica shop/upload/<?php echo $row["image"]; ?>" >
            <?php
                }
              }
             ?>
            </div>
           </a>
        </div>
        <div class="col-2">
          <h4>ชื่อ-นามสกุล</h4>
          <p> <?php  if(isset($_SESSION['member'])){
              $member = $_SESSION['member'];
              $select = "SELECT firstname,lastname FROM customer WHERE email='$member' ";
              $query =  $conn->query($select);
              if($query->num_rows > 0){
                while ($row = $query->fetch_assoc()) {?>
                  <div class="text" style="margin: 20px; margin-left: 10px;"><?php echo $row["firstname"]." ".$row["lastname"]; ?></div>
               <?php }
              }
            }
           ?>
         </p>
        </div>
        <div class="col-2">
          <h4>อีเมล</h4>
          <p> <?php  if(isset($_SESSION['member'])){
              $member = $_SESSION['member'];
              $select = "SELECT email FROM customer WHERE email='$member' ";
              $query =  $conn->query($select);
              if($query->num_rows > 0){
                while ($row = $query->fetch_assoc()) {?>
                  <div class="text" style="margin: 20px; margin-left: 10px;"><?php echo $row["email"]; ?></div>
             <?php   }
              }
            }
           ?></p>
        </div>
        <div class="col-2">
          <h4>รหัสผ่าน</h4>
          <p> <?php  if(isset($_SESSION['member'])){
              $member = $_SESSION['member'];
              $select = "SELECT password FROM customer WHERE email='$member' ";
              $query =  $conn->query($select);
              if($query->num_rows > 0){
                while ($row = $query->fetch_assoc()) {
                  echo $row["password"];
                }
              }
            }
           ?></p>

        </div>

        </form>
    </div>

    <div class="container">
      <div class="title account">
        <form class="body" >
          <div class="head">
            <h1>ข้อมูลพื้นฐาน</h1>
            <a href="editdata.php">แก้ไขข้อมูล</a>
          </div>
          <div class="col-2">
            <h4>ที่อยู่</h4>
          <p>  <?php  if(isset($_SESSION['member'])){
                $member = $_SESSION['member'];
                $select = "SELECT address FROM book WHERE email='$member' ";
                $query =  $conn->query($select);
                if($query->num_rows > 0){
                  while ($row = $query->fetch_assoc()) {
                    echo $row["address"];
                  }
                }
              }
             ?></p>
          </div>
          <div class="col-2">
            <h4>เบอร์โทร</h4>
        <p>  <?php  if(isset($_SESSION['member'])){
                $member = $_SESSION['member'];
                $select = "SELECT tel FROM book WHERE email='$member' ";
                $query =  $conn->query($select);
                if($query->num_rows > 0){
                  while ($row = $query->fetch_assoc()) {
                    echo $row["tel"];
                  }
                }
              }
             ?></p>
          </div>

        </form>

      </div>

    </div>

  </body>
</html>
