<?php
    session_start();
    include('server.php');

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

    <!--css-->
    <link rel="stylesheet" href="product.css">
    <title>ALL PRODUCT</title>
</head>
<body>
    <div class="container-product">
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

          <div class="container allproduct">
            <form action="detail.php" class="product" method="post">
              <div class="title">
                  <h5>All Product</h5>
              </div>

              <div class="row">
              <?php 
                $sql = "SELECT product_id,image,name,price,number FROM product ";
                $query = $conn->query($sql);
                
                if($query->num_rows >0){
                  while ($row = $query->fetch_assoc()){?>
                <div class="col">
                  <?php  echo "<a href='detail.php?p_id=$row[product_id]'>"; ?>
                      <div class="card" style="width:300px;">
                        <img src="<?php echo $row["image"];?>" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                          <p class="card-text">ราคา <?php echo $row["price"]; ?> บาท</p>
                          <p>จำนวนสินค้า: <?php if($row["number"]<= 0){
                                          echo "สินค้าหมด";
                                  }else{
                                    echo $row["number"]."ชิ้น";
                                  } ?></p>
                        </div>
                      
                    </div>
                  <?php echo "</a>"; ?>
                   
                  </div>

                <?php
                  }
                }
              ?>
              <!------------------------------------------------------------->
              </div>
              

            </form>

          </div>
    </div>

</body>
</html>
