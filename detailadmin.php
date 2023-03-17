<?php 
 session_start();
 $errors = array();
 include('server.php');
 require_once("dbcontroller.php");
 $db_handle = new DBController();
    if(isset($_POST["add"])){
      header("location:detailadmin.php?p_id=$p_id");
        if(!empty($_GET['p_id'])){
            $p_id = $_GET['p_id'];
    $url1 = mysqli_real_escape_string($conn,$_POST['url1']);
    $url2 = mysqli_real_escape_string($conn,$_POST['url2']);
    $url3 = mysqli_real_escape_string($conn,$_POST['url3']);
    $url4 = mysqli_real_escape_string($conn,$_POST['url4']);
    $url5 = mysqli_real_escape_string($conn,$_POST['url5']);

    if (empty($url1)) {
        array_push($errors, "url is required");
        $_SESSION['error_url'] = "url is required";
        
    }
    if (empty($url2)) {
        array_push($errors, "url is required");
        $_SESSION['error_url'] = "url is required";
        
    }
    if (empty($url3)) {
        array_push($errors, "url is required");
        $_SESSION['error_url'] = "url is required";
        
    }
    if (empty($url4)) {
        array_push($errors, "url is required");
        $_SESSION['error_url'] = "url is required";
        
    }
    if (empty($url5)) {
        array_push($errors, "url is required");
        $_SESSION['error_url'] = "url is required";
        
    }
    if (count($errors) == 0) {
        $sql1 = "INSERT INTO `pd_detail` (`product_id`, `image`) VALUES ('$p_id', '$url1')";
        $query1 = mysqli_query($conn,$sql1);

        $sql2 = "INSERT INTO `pd_detail` (`product_id`, `image`) VALUES ('$p_id', '$url2')";
        $query2 = mysqli_query($conn,$sql2);

        $sql3 = "INSERT INTO `pd_detail` (`product_id`, `image`) VALUES ('$p_id', '$url3')";
        $query3 = mysqli_query($conn,$sql3);

        $sql4 = "INSERT INTO `pd_detail` (`product_id`, `image`) VALUES ('$p_id', '$url4')";
        $query4 = mysqli_query($conn,$sql4);

        $sql5 = "INSERT INTO `pd_detail` (`product_id`, `image`) VALUES ('$p_id', '$url5')";
        $query5 = mysqli_query($conn,$sql5);

         $_SESSION['adddetailsuccess'] = "เพิ่มรูปภาพเรียบร้อย";
        header("location:detailadmin.php?p_id=$p_id");
    }   
     
    }else{
        echo "errors id";
    }
}else{
    
}
 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <!---css-------->
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="detail.css">
    <title>Document</title>
</head>
<body>
    <div class="container-detail">
      <nav class="nav">
                <div class="logo">
                <a href="index.php"><img src="https://static.leica-camera.com/extension/all2edesign/design/site_corposite/images/logo.svg" alt=""></a>
                </div>
                
                <?php if(isset($_SESSION['addmin'])){
              ?>
              <div class="dropdown" style="margin-left: 20px;" >
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false" style="background: black;">
                    Menu Addmin
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item " href="insertproduct.php">stock</a></li>
                    <li><a class="dropdown-item" href="customer.php">customer</a></li>
                    <li><a class="dropdown-item" href="product.php">Product</a></li>
                    <li><a class="dropdown-item " href="addmin.php">Order</a></li>
                    <li><a class="nav-link" href="insertproduct.php">เพิ่มสินค้า</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="index.php?logout=1">logout addmin</a></li>
                </ul>
            </div>
             <?php   
              
            }else{?>
                <a class="nav-link" href="product.php">Product</a>
                <a class="nav-link" href="account.php">Account</a>
                <a href="login.php" class="nav-link">Login Account</a>
                <a href="cart.php" class="nav-link">Cart</a>
                <a href="order.php" class="nav-link">Order</a>

                <?php
            }  ?>
            </nav>

            <div class="container">
        <div class="row">
          <?php 
          if(!empty($_GET['p_id'])){
            $p_id = $_GET['p_id'];
          $sql = "SELECT image FROM pd_detail WHERE product_id = '$p_id' ORDER BY id ASC LIMIT 1";
          $query = $conn->query($sql);
          if($query->num_rows >0){
            while ($row = $query->fetch_assoc()){?>
               <div class="col-4">
                <div class="card" style="width: 35rem;">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators"> 
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
                  </div>
                  <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="<?php echo $row["image"]; ?>" class="d-block w-100" alt="...">
                  </div>
                 <?php $sql2 = "SELECT image FROM pd_detail WHERE product_id = '$p_id' ORDER BY id DESC LIMIT 4";
                        $query2 = $conn->query($sql2);
                        if($query2->num_rows > 0){
                          while($row2 = $query2->fetch_assoc()){?>
                            <div class="carousel-item">
                              <img src="<?php echo $row2["image"]; ?>  " class="d-block w-100" alt="...">
                            </div>

                            <?php
                          }
                        }
                      }
                    }
                  }
                 ?>
                 </div>
                 <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
              </div>

            </div>
            <?php  

              $sql3 = "SELECT product_id,name,title,price,number FROM product WHERE product_id='$p_id'";
              $query3 = $conn->query($sql3);
              if($query3->num_rows >0){
                while ($row3 = $query3->fetch_assoc()){?>
              <div class="col-6"> <h4><?php echo $row3["name"]; ?></h4> <br>
                  <h6>จุดเด่นขอสินค้า</h6>
                  <li> <?php echo $row3["title"]; ?></li><br>
                  <h6>ราคา <?php echo number_format($row3["price"]); ?> บาท</h6>
                  <p>จำนวนสินค้า: <?php echo $row3["number"];?>ชิ้น</p>
                <?php
                         }
                   }
                
                ?>
                
              </div>
        </div>
         

          <?php
          if(isset($_SESSION["addmin"])){
            if(!empty($_GET['p_id'])){
                $p_id = $_GET['p_id'];
                ;?>
           <div class="container" style="margin: 100px auto;">
                       <form action="detailadmin.php?p_id=<?php echo $p_id?>" method="post">
                           <label for="basic-url" class="form-label"><h5 style="color: #555; margin-left: 20px;" >เพิ่มรูปสินค้า</h5> </label>
                           <div class="input-group mb-3">
                           <span class="input-group-text" id="basic-addon3">ใส่ลิ้งรูปภาพให้กับสินค้ารูปที่1</span>
                           <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="url1">
                           </div>
                           <div class="input-group mb-3">
                           <span class="input-group-text" id="basic-addon3">ใส่ลิ้งรูปภาพให้กับสินค้ารูปที่2</span>
                           <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="url2">
                           </div>
                           <div class="input-group mb-3">
                           <span class="input-group-text" id="basic-addon3">ใส่ลิ้งรูปภาพให้กับสินค้ารูปที่3</span>
                           <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="url3">
                           </div>
                           <div class="input-group mb-3">
                           <span class="input-group-text" id="basic-addon3">ใส่ลิ้งรูปภาพให้กับสินค้ารูปที่4</span>
                           <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="url4">
                           </div>
                           <div class="input-group mb-3">
                           <span class="input-group-text" id="basic-addon3">ใส่ลิ้งรูปภาพให้กับสินค้ารูปที่5</span>
                           <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="url5">
                           </div>

                           <button type="submit" name="add"   class="btn btn-primary" style="margin: 25px 0;   margin-left: 1200px; background: #555; border: none;">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                                           <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"></path>
                                   </svg>
                               เพิ่มสินค้า
                           </button>
                           
                       </form>
                   </div>
               <?php
          }

        }else{
          
        }
        ?>
          
          

    </div>
    
</body>
</html>