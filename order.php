<?php  
    session_start();
    include 'server.php';
    require_once("dbcontroller.php");
    $db_handle = new DBController();
    if(!empty($_GET["cancle"])){
        if(isset($_SESSION["member"])){
        $sql = "DELETE FROM cart WHERE id= '".$_GET["cancle"]."' ";
        $delete = mysqli_query($conn, $sql);
        }
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
    <title>Document</title>
</head>
<body>

    <div class="container-order">
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
                    <li><a class="dropdown-item" href="#">customer</a></li>
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


            <table class="tbl-cart" cellpadding="10" cellspacing="1"  style="margin: 50px auto; ">
                                    <tbody>
                                    <tr>
                                    <th style="text-align:left;" width="100px">เลขที่สั่งซื้อ</th>
                                    <th style="text-align:left;" width="450px">สินค้า</th>
                                    <th style="text-align:right;" width="100px">จำนวน</th>
                                    <th style="text-align:right;" width="100px">ราคา/ชิ้น</th>
                                    <th style="text-align:right;" width="100px">ราคาทั้งหมด</th>
                                    <th style="text-align:right;" width="100px">ยกเลิกคำสั่งซื้อ</th>
                                    
                                    </tr>

            <?php 
            
                if(isset($_SESSION["member"])){
                    $member = $_SESSION["member"];
                    $order = $db_handle->runQuery("SELECT * FROM cart WHERE customer_email = '$member' ORDER BY id ASC ");
                    if(!empty($order)){
                        foreach($order as $key => $value){
                             $order[$key]["product_id"];
                             $p_id = $order[$key]["product_id"];
                                    $product = $db_handle->runQuery("SELECT * FROM product WHERE product_id= '$p_id' ORDER BY product_id ASC ");
                                    if(!empty($product)){
                                        foreach($product as $key2 => $value2){?>
                                        <tr>
                                        <td style="text-align:left;"><?php echo $order[$key]["id"];?></td>
                                        <td><img src="<?php echo $product[$key2]["image"]; ?>" class="cart-item-image" /><?php echo $product[$key2]["name"]; ?></td>
                                        <td style="text-align:right;"><?php echo $order[$key]["number"];?></td>
                                        <td style="text-align:right;"><?php echo $product[$key2]["price"];?></td>
                                        <td  style="text-align:right;"><?php echo $order[$key]["price"]; ?></td>
                                    <?php
                                    if($order[$key]["status"] == "ยืนยันแล้ว"){?>
                                        <td  style="text-align:right; color: green;">กำลังจัดส่งสินค้า</td>
                                   <?php }else{?>
                                        <td  style="text-align:right;"> <a style="color: red;"  href="order.php?cancle=<?php echo $order[$key]["id"] ?>">ยกเลิกคำสั่งซื้อ</a> </td>
                                        <?php
                                    }
                                 }
                             }
                    
                }
            }
        
        }
    
            
            
            ?>
    </div>
    
</body>
</html>