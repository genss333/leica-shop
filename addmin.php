<?php
 
 session_start();
 if(!isset($_SESSION['addmin'])){
    header("location: index.php");
  }
  include 'server.php';
    require_once("dbcontroller.php");
    $db_handle = new DBController();

    if(!empty($_GET["act"])){
        $act = $_GET["act"];
        $c_id = $_GET["c_id"];
        if($act == "update" && !empty($c_id)){
            $order = $db_handle->runQuery("SELECT * FROM cart  WHERE id = '$c_id' ");
                    if(!empty($order)){
                        foreach($order as $key => $value){
                       $number =$order[$key]["number"];
                        $p_id = $order[$key]["product_id"];
                                    $product = $db_handle->runQuery("SELECT * FROM product WHERE product_id= '$p_id' ORDER BY product_id ASC ");
                                    if(($product)){
                                        foreach($product as $key2 => $value2){
                                            $have = $product[$key2]["number"];
                                            $upstock = $have - $number;
                                            $sql = "UPDATE `product` SET `number` = '$upstock' WHERE `product`.`product_id` = '$p_id'";
                                            $query = mysqli_query($conn,$sql);
                                            $sql2 = "UPDATE cart SET status = 'ยืนยันแล้ว' WHERE id = '$c_id' ";
                                            $query2 = mysqli_query($conn,$sql2);
                                            header("location:addmin.php");
                                        }
                                    }
                        }
            }
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
            


            <table class="tbl-cart" cellpadding="10" cellspacing="1"  style="margin: 50px auto; ">
                                    <tbody>
                                    <tr>
                                    <th style="text-align:left;" width="80px">Stock id</th>
                                    <th style="text-align:left;" width="80px">product id</th>
                                    <th style="text-align:left;" width="350px">Product Name</th>
                                    <th style="text-align:left;"width="200px">Email</th>
                                    <th style="text-align:left;"width="100px">firstname</th>
                                    <th style="text-align:left;"width="100px"">lastname</th>
                                    <th style="text-align:center;"width="200px">address</th>
                                    <th style="text-align:left;"width="70px">tel</th>
                                    <th style="text-align:left;" width="50px">Quantity</th>
                                    <th style="text-align:center;" width="100px">Unit Price</th>
                                    <th style="text-align:leftt;" width="100px">Total Price</th>
                                    <th style="text-align:left;" width="100px">status</th>
                                    <th style="text-align:center;" width="100px">ยืนยันคำสั่งซื้อ</th>
                                    
                                    </tr>

            <?php 
            
                if(isset($_SESSION["addmin"])){
                    $order = $db_handle->runQuery("SELECT * FROM cart  ORDER BY id ASC ");
                    if(!empty($order)){
                        foreach($order as $key => $value){?>
                            <form  class="add-to-cart" method="post" action="addmin.php?act=update&c_id=<?php echo $order[$key]["id"]; ?>">
                        <?php   $order[$key]["product_id"];
                             $p_id = $order[$key]["product_id"];
                                    $product = $db_handle->runQuery("SELECT * FROM product WHERE product_id= '$p_id' ORDER BY product_id ASC ");
                                    if(!empty($product)){
                                        foreach($product as $key2 => $value2){
                                         $order_id = $order[$key]["id"];
                                         $p_id = $order[$key]["product_id"]
                                            ?>
                                        <tr>
                                        <td  style="text-align:left;"><?php echo $order[$key]["id"]; ?></td>
                                        <td  style="text-align:left;"><?php echo $order[$key]["product_id"]; ?></td>
                                        <td><img src="<?php echo $product[$key2]["image"]; ?>" class="cart-item-image" /><?php echo $product[$key2]["name"]; ?></td>
                                        <td style="text-align:left;"><?php echo $order[$key]["customer_email"]; ?></td>
                                        <td style="text-align:left;"><?php echo $order[$key]["firstname"]; ?></td>
                                        <td style="text-align:left;"><?php echo $order[$key]["lastname"]; ?></td>
                                        <td style="text-align:center;"><?php echo $order[$key]["address"]; ?></td>
                                        <td style="text-align:left;"><?php echo $order[$key]["tel"]; ?></td>
                                        <td style="text-align:center;"><?php echo $order[$key]["number"];?></td>
                                        <td style="text-align:center;"><?php echo $product[$key2]["price"];?></td>
                                        <td  style="text-align:left;"><?php echo $order[$key]["price"]; ?></td>
                                        <td  style="text-align:left;"><?php echo $order[$key]["status"]; ?></td>
                                        <td  style="text-align:center;"> <?php  if($order[$key]["status"] == "ยืนยันแล้ว"){

                                                                                }else{echo "<button type='submit'  name='addorder' value='Add to Cart' class='btnAddAction'>ยืนยันคำสั่งซื้อ</button></td>";}                         ?></td>
                                            
                                     </form>
                                 <?php
                                 }
                             }
                        }
                    }
                    
                 }
    
            
            
            ?>
    </div>
    
</body>
</html>