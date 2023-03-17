<?php 
        session_start();
        $errors = array();
        include('server.php');
        require_once("dbcontroller.php");
        $db_handle = new DBController();
           if(!empty($_POST['addpd'])){
               $url = mysqli_real_escape_string($conn,$_POST['url']);
               $name = mysqli_real_escape_string($conn,$_POST['pd_name']);
               $price = mysqli_real_escape_string($conn,$_POST['price']);
               $num = mysqli_real_escape_string($conn,$_POST['num']);
               $title = mysqli_real_escape_string($conn,$_POST['title']);
            if (empty($url)) {
                array_push($errors, "url is required");
                $_SESSION['error_url'] = "url is required";
                
            }
    
            if (empty($name)) {
                array_push($errors, "product name is required");
                $_SESSION['error_name'] = "product name is required";
                
            }
            if (empty($price)) {
                array_push($errors, "price is required");
                $_SESSION['error_price'] = "price is required";
                
            }
    
            if (empty($num)) {
                array_push($errors, "num name is required");
                $_SESSION['error_num'] = "num name is required";
                
            }
            if (empty($title)) {
                array_push($errors, "title is required");
                $_SESSION['error_num'] = "title is required";
                
            }
            if (count($errors) == 0) {
                $sql = "INSERT INTO `product` (`image`, `name`, `title`, `price`, `number`) VALUES ('$url', '$name', '$title', '$price', '$num')";
                $query = mysqli_query($conn,$sql);
                 $_SESSION['addsuccess'] = "เพิ่มสินค้าเรียบร้อย";
                header("location: insertproduct.php");
                
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
                                    <th style="text-align:left;" width="80px">รหัสสินค้า</th>
                                    <th style="text-align:left;" width="300px">ชื่อสินค้า</th>
                                    <th style="text-align:center;"width="700px">รายละเอียด</th>
                                    <th style="text-align:left;"width="100px">ราคา</th>
                                    <th style="text-align:left;"width="150px"">จำนวนสินค้า</th>
                                    <th style="text-align:left;"width="150px"">รายละเอียดเพิ่มเติม</th>
                                    </tr>
            <?php 
                if(isset($_SESSION["addmin"])){           
                                    $product = $db_handle->runQuery("SELECT * FROM product  ORDER BY product_id ASC ");
                                    if(!empty($product)){
                                        foreach($product as $key2 => $value2){
                                           $p_id= $product[$key2]["product_id"];
                                            ?>
                                        <tr>
                                        <td  style="text-align:left;"><?php echo $product[$key2]["product_id"]; ?></td>
                                        <td><img src="<?php echo $product[$key2]["image"]; ?>" class="cart-item-image" /><?php echo $product[$key2]["name"]; ?></td>
                                        <td style="text-align:center;"><?php echo $product[$key2]["title"]; ?></td>
                                        <td style="text-align:left;"><?php echo $product[$key2]["price"]; ?></td>
                                        <td style="text-align:cleft;"><?php if($product[$key2]["number"] <= 0 ){
                                                                                echo "สินค้าหมด";
                                                                               }else{
                                                                                echo $product[$key2]["number"]; 
                                                                               } ?></td>
                                        <td style="text-align:left;"> <?php  echo "<a href='detailadmin.php?p_id=$p_id'style='text-decoration:none;'>เพิ่มจำนวน/เพิ่มรูปภาพ</a>"; ?></td>
                                    <?php
                                 }
                             }
                            
                            ?>  
                    <?php
                }
            ?> 
        </div>
                <?php
                   if(isset($_SESSION["addmin"])){?>
                    <div class="container" style="margin: 100px auto;">
                                 <?php   if(!empty($_SESSION['addsuccess'])){?>
                                     <div class="modal" tabindex="-1">
                                     <div class="modal-dialog">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title">Modal title</h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                         </div>
                                         <div class="modal-body">
                                           <p><?php echo $_SESSION['addsuccess']; ?></p>
                                         </div>
                                       </div>
                                     </div>
                                   </div>
                                     <?php       
                                    }else{

                                    }?>
                                <form action="insertproduct.php" method="post">
                                    <label for="basic-url" class="form-label"><h5 style="color: #555; margin-left: 20px;" >เพิ่มสินค้า</h5> </label>
                                    <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon3">ใส่ลิ้งรูปภาพให้กับสินค้า</span>
                                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="url">
                                    </div>

                                    <div class="input-group mb-3">
                                    <span class="input-group-text">ชื่อสินค้า</span>
                                    <input type="text" class="form-control" name="pd_name">
                                    </div>

                                    <div class="input-group mb-3">
                                    <span class="input-group-text">ราคา</span>
                                    <input type="text" class="form-control" name="price">
                                    <span class="input-group-text">บาท</span>
                                    <span class="input-group-text">จำนวนสินค้า</span>
                                    <input type="text" class="form-control" name="num">
                                    <span class="input-group-text">ชิ้น</span>
                                    </div>

                                    <div class="input-group">
                                    <span class="input-group-text">รายละเอียดสินค้า</span>
                                    <textarea class="form-control" aria-label="With textarea" name="title"></textarea>  
                                    </div>
                                    <button type="submit" name="addpd"   class="btn btn-primary" style="margin: 25px 0;   margin-left: 1200px; background: #555; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"></path>
                                            </svg>
                                        เพิ่มสินค้า
                                    </button>
                                    
                                </form>
                            </div>
                        <?php
                   }?>
        


    
</body>
</html>