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
    <title>Add Friend</title>
  </head>
  <link rel="stylesheet" href="upload.css">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
  </style>
  <body>
    <div class="container" style="margin: 300px 0;">
        </div>
        <div class="login">
        <div class="border">
          <div class="logo">
              <div class="titel">
                <p>Change Your Picture</p2>
              </div>
                </div>
            <div class="input">
              <form class="form-container " action="upload.php" method="post" enctype="multipart/form-data">
                  <div class="upload">
                    <?php
                      $member = $_SESSION['member'];
                      $select = "SELECT image FROM image WHERE member = '$member' ORDER BY id DESC LIMIT 1";
                      $query =  $conn->query($select);
                      if($query->num_rows > 0){
                        while ($row = $query->fetch_assoc()) {?>
                          <img src="/leica shop/upload/<?php echo $row["image"]; ?>">
                    <?php
                        }
                      }
                     ?>
                    <input type="file" name="image[]" />
                    <button type="submit" name="change">Change</button>
                  </div>

                </form>

      </div>

    </div>
    </div>
</html>
