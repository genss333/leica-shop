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
    <!----css--->
    <link rel="stylesheet" href="detail.css">

    <title>Detail</title>
</head>
<body>
    <div class="container-detail">
      <!---navbar---------------------------------------------------->
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

      <!---detail----------------------------------------------------->
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
              <p>จำนวนสินค้า: <?php if($row3["number"]<= 0){
                                          echo "สินค้าหมด";
                                  }else{
                                    echo $row3["number"]."ชิ้น";
                                  } ?></p>
                <form  class="add-to-cart" method="post" action="cart.php?act=add&p_id=<?php echo $p_id; ?>">
                <div class="cart-action"><input type="number" class="product-quantity" name="quantity" value="1" min="1" max="<?php echo $row3["number"];?>" size="2" />
                <button type="submit" value="Add to Cart" class="btnAddAction">Add to Cart</button>
              </div>
               
            </div>
                <?php
                }
              }
            ?>

           
        <?php
            }
          }
        }
          
          ?>
          </form>
          <!---detail----------------------------------------------------->

        </div>
        </div>
   </div>



    </div>

</body>
</html>
