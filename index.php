<?php 
    session_start();
    include('server.php');
    
    if(isset($_GET['logout'])){
      session_destroy();
      unset($_SESSION['member']);
      header("location: index.php");
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

    <!--css-->
    <link rel="stylesheet" href="index.css">

    <title>CAMERA SHOP</title>
</head>
<body>
  <!-----------------------container-fluid------------------------------------>
    <div class=".container-fluid">
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

            <!-----------------------------------carousel---------------------------------------------->
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="https://media-cdn.bnn.in.th/172947/Hero-Banner-2000x720-homepage_desktop_banner_medium.jpg" class="d-block " alt="...">
                </div>
                <div class="carousel-item">
                  <img src="https://media-cdn.bnn.in.th/172947/Hero-Banner-2000x720-homepage_desktop_banner_medium.jpg" class="d-block " alt="...">
                </div>
                <div class="carousel-item">
                  <img src="https://media-cdn.bnn.in.th/172947/Hero-Banner-2000x720-homepage_desktop_banner_medium.jpg" class="d-block " alt="...">
                </div>
              </div>
              <!------------------------------------control sliider image-->
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

            <!-----------------------------contaoner-sm------------------------------------------->

    </div>

   <!-----------------------small-container------------------------------------>
    <div class="small-container">
      <div class="container-sm">
         <div class="row g-0">
          <div class="col-sm-6 col-md-8">
            <div class="card" >
            <a href="detail.php?p_id=4"><img src="https://static.leica-camera.com/var/leica/storage/images/media/media-asset-management-mam/global-international/photography/compact-cameras/d-lux-7/d-lux7-street-kit/d-lux7_streetkit_ambient_1/5365751-1-eng-MA/D-Lux7_StreetKit_Ambient_1_teaser-756x504.jpg"
            class="card-img-top" alt="..."></a>
            <div class="card-body">
              <h5 class="card-title">Lica D-LUX 7 STREET KIT</h5>
              <p class="card-text">Always ready for action</p>
            </div>
          </div>
        </div>
          <div class="col-6 col-md-4">
            <div class="card card-2" >
            <a href="detail.php?p_id=6"><img src="https://static.leica-camera.com/var/leica/storage/images/media/media-asset-management-mam/global-international/photography/sl-system/leica-sl2-s/05_firmware/sl2-s-fw-update-teaser_1512x1008/5433074-1-eng-MA/sl2-s-fw-update-teaser_1512x1008_teaser-307x205.png"
              class="card-img-2" alt="..."></a>
              <div class="card-body-2">
                <p class="card-text">Update for Leica SL2-S <br> Firmwere 2.0</p>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-5">
            <div class="card card-3" >
              <a href="detail.php?p_id=6"><img src="https://static.leica-camera.com/var/leica/storage/images/media/media-asset-management-mam/global-international/photography/sl-system/leica-sl2-s/04_workflow/capture-one-with-logo_1512x1008px/5241081-1-eng-MA/Capture-One-with-logo_1512x1008px_teaser-405x270.jpg"
              class="card-img-3" alt="..."></a>
              <div class="card-body-3">
                <h5 class="card-title-3">Lica SL2-S</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-----------------------product highligh------------------------------------>
      <div class="container-sm container-product">
        <div class="title">
          <h5>PRODUCT HIGHLIGH</h5>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
          <div class="carousel-item active">
          <div class="row align-items-start">
          <?php 
              $sql = "SELECT * FROM PRODUCT ORDER BY product_id ASC LIMIT 3 ";
              $query = $conn->query($sql);
              if($query->num_rows >0){
                 while ($row = $query->fetch_assoc()){?>
                <div class="col">
                  <div class="card-product">
                  <?php  echo "<a href='detail.php?p_id=$row[product_id]'>"; ?>
                      <img src="<?php echo $row["image"]; ?>"
                      class="card-img-top" alt="..."> <?php echo "</a>" ?>
                      <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                  </div>
                </div>
            <?php
          }
        }
        
        ?>
         </div>
            </div>
            <div class="carousel-item">
            <div class="row align-items-start">
        <?php 
        $sql2 = "SELECT * FROM PRODUCT WHERE product_id >3 LIMIT 3";
        $query2 = $conn->query($sql2);
        if($query2->num_rows > 0){
          while($row2 = $query2->fetch_assoc()){?>
                <div class="col">
                  <div class="card-product">
                  <?php  echo "<a href='detail.php?p_id=$row2[product_id]'>"; ?>
                      <img src="<?php echo $row2["image"]; ?>"
                      class="card-img-top" alt="..."><?php echo "</a>" ?>
                      <h5 class="card-title"><?php echo $row2["name"]; ?></h5>
                  </div>
                </div>
             

              <?php    
                }
              }
        
        ?>
         </div>
            </div>

            <div class="carousel-item">
            <div class="row align-items-start">
        <?php 
        $sql3 = "SELECT * FROM PRODUCT WHERE product_id >6 LIMIT 3";
        $query3 = $conn->query($sql3);
        if($query3->num_rows > 0){
          while($row2 = $query3->fetch_assoc()){?>
                <div class="col">
                  <div class="card-product">
                  <?php  echo "<a href='detail.php?p_id=$row2[product_id]'>"; ?>
                      <img src="<?php echo $row2["image"]; ?>"
                      class="card-img-top" alt="..."><?php echo "</a>" ?>
                      <h5 class="card-title"><?php echo $row2["name"]; ?></h5>
                  </div>
                </div>
             

              <?php    
                }
              }
        
        ?>
         </div>
            </div>
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








</body>
</html>
