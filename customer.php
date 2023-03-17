<?php 
    session_start();
    include('server.php');
    if(!isset($_SESSION['addmin'])){
        header("location:index.php");
    }
    require_once("dbcontroller.php");
    $db_handle = new DBController();


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
                    <th style="text-align:left;"width="50px">ลำดับ</th>
                    <th style="text-align:left;"width="200px">Email</th>
                    <th style="text-align:left;"width="100px">firstname</th>
                    <th style="text-align:left;"width="100px"">lastname</th>
                    <th style="text-align:center;"width="200px">address</th>
                    <th style="text-align:left;"width="70px">tel</th>
                 </tr>

            <?php 
            
                if(isset($_SESSION["addmin"])){
                    $customer = $db_handle->runQuery("SELECT customer.firstname,customer.lastname,customer.email,book.id,book.address,book.tel 
                    FROM customer INNER JOIN book ON customer.email = book.email  ORDER BY book.id ASC ");
                    foreach($customer as $key => $value){?>
                    
                     <tr>
                        <td style="text-align:left;"><?php echo $customer[$key]["id"]; ?> </td>
                        <td style="text-align:left;"><?php echo $customer[$key]["email"]; ?></td>
                        <td style="text-align:left;"><?php echo $customer[$key]["firstname"]; ?></td>
                        <td style="text-align:left;"><?php echo $customer[$key]["lastname"]; ?></td>
                        <td style="text-align:center;"><?php echo $customer[$key]["address"]; ?></td>
                         <td style="text-align:left;"><?php echo $customer[$key]["tel"]; ?></td>
                     </tr>             
                                 <?php
                            }
                        }
            ?>
    </div>
    
</body>
</html>