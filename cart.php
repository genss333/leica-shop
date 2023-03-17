<?php
	session_start();
	include 'server.php';
    require_once("dbcontroller.php");
    $db_handle = new DBController();
	if(!empty($_GET["act"])){
        header("location:cart.php");
        $p_id = $_GET['p_id']; 
	    $act = $_GET['act'];
 
	if($act=='add' && !empty($p_id))
	{
		if(isset($_SESSION['cart'][$p_id]))
		{
			$_SESSION['cart'][$p_id]+=$_POST["quantity"];
		}
		else
		{
			$_SESSION['cart'][$p_id]=$_POST["quantity"];;
		}
	}
 
	if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['cart'][$p_id]);
	}
    if($act=='addorder' && !empty($p_id)){
        if(!empty($_SESSION["member"])){
            
                        $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE product_id='" . $p_id . "'");
                        $itemArray = array($productByCode[0]["product_id"]=>array('name'=>$productByCode[0]["name"], 'product_id'=>$productByCode[0]["product_id"],
                                                        'price'=>$productByCode[0]["price"],'image'=>$productByCode[0]["image"]));

                        $member = $db_handle->runQuery("SELECT * FROM customer WHERE email='" . $_SESSION["member"] . "'");
                        $memberArray = array($member[0]["email"]=>array('firstname'=>$member[0]["firstname"], '	lastname'=>$member[0]["lastname"], 'email'=>$member[0]["email"]));

                        $book =$db_handle->runQuery("SELECT * FROM book WHERE email= '".$member[0]["email"]."'");
                        $bookArray = array($book[0]["email"]=>array( 'address'=>$book[0]["address"], 'tel'=>$book[0]["tel"] ) );
                        //query to database table cart 
                        $p_id = $productByCode[0]["product_id"];
                        echo $p_id;
                        $p_name = $productByCode[0]["name"];
                        echo $p_name;
                        echo $qty = $productByCode[0]["number"];
                        $cus_email = $member[0]["email"];
                        echo $cus_email;
                        $cus_fname =  $member[0]["firstname"];
                        echo  $cus_fname;
                        $cus_lname = $member[0]["lastname"];
                        echo $cus_lname;
                        $address = $book[0]["address"];
                        echo $address;
                        $tel = $book[0]["tel"];
                        echo $tel;
                        $number = $_SESSION["total"];
                        echo $number;
                        $total_price = $_SESSION["total"] *$productByCode[0]["price"];
                        echo $total_price;

                    if($number > $qty){
                        $sql = "INSERT INTO `cart` (`id`, `product_id`, `product_name`, `customer_email`, `firstname`, `lastname`, `address`, `tel`, `number`, `price`) 
                        VALUES (NULL, '$p_id', '$p_name', '$cus_email', '$cus_fname', '$cus_lname', '$address', '$tel','$qty', '$total_price')";
                        $query =  mysqli_query($conn,$sql);
                        unset($_SESSION['cart'][$p_id]);
                    }else{
                        $sql = "INSERT INTO `cart` (`id`, `product_id`, `product_name`, `customer_email`, `firstname`, `lastname`, `address`, `tel`, `number`, `price`) 
                        VALUES (NULL, '$p_id', '$p_name', '$cus_email', '$cus_fname', '$cus_lname', '$address', '$tel','$number', '$total_price')";
                        $query =  mysqli_query($conn,$sql);
                        unset($_SESSION['cart'][$p_id]);

                    }
                        
                }
        }else{
                echo "Errors";
  
        }
        if($act == "empty"){
            unset($_SESSION["cart"]);
        }
    }
    

?>
 
<!DOCTYPE html>
<html>
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
</head>
 
<body>
<div class="container-cart">
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

    <div class="container">
            <div id="shopping-cart">
          <div class="txt-heading">Leica Cart</div>

          <a id="btnEmpty" href="cart.php?act=empty">Empty Cart</a>
            <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                <td colspan="5" bgcolor="#CCCCCC">
                <b>ตะกร้าสินค้า</span></td>
                </tr>
                <tr>
                <td bgcolor="#EAEAEA"width="400px">สินค้า</td>
                <td align="center" bgcolor="#EAEAEA" width="100px">ราคา</td>
                <td align="center" bgcolor="#EAEAEA">จำนวน</td>
                <td align="center" bgcolor="#EAEAEA">รวม(บาท)</td>
                <td align="left" bgcolor="#EAEAEA" width="90px">ลบสินค้า</td>
                </tr>
        
<?php
$total=0;
if(!empty($_SESSION['cart']))
{

	foreach($_SESSION['cart'] as $p_id=>$qty)
	{
		$sql = "select * from product where product_id=$p_id";
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($query);
		$sum = $row['price'] * $qty;
		$total += $sum;
		echo "<tr>";?>
        <form  class="add-to-cart" method="post" action="cart.php?act=addorder&p_id=<?php echo $row["product_id"]; ?>">
		<td> <img src="<?php echo $row["image"]; ?>" class="cart-item-image" /><?php echo $row["name"]; ?></td>
<?php   echo "<td width='46' align='center'>" .number_format($row["price"],2) . "</td>";
		echo "<td width='57' align='center'>"; 
        if($qty>$row["number"]){
            echo $row["number"];
        }else{
            echo $qty;
        }
		echo "<td width='93' align='center'>".number_format($sum,2)."</td>";
		//remove product
		echo "<td width='46' align='left'><a href='cart.php?p_id=$p_id&act=remove'><img src='icon-delete.png'  />
        </a><button type='submit'  name='addorder' value='Add to Cart' class='btnAddAction'>สั่งซื้อ</button></td>";
		echo "</tr>";
        
	}
	echo "<tr>";
  	echo "<td colspan='3' bgcolor='#CEE7FF' align='center'><p>ราคารวม</p></td>";
  	echo "<td align='center' bgcolor='#CEE7FF'>"."<b>".number_format($total,2)."</b>"."</td>";
      $_SESSION["total"] = $qty;
  	echo "<td align='left' bgcolor='#CEE7FF'></td>";
	echo "</tr>";?>
    <?php if(!empty($_SESSION['member'])){?>
        <tr>
        <td><a href="product.php" style="text-decoration: none;">กลับหน้ารายการสินค้า</a></td>
        <td colspan="4" align="right">
        
        <input type="button" name="Submit2" value="สั่งซื้อทั้งหมด" onclick="window.location='confirm.php';" />
        </td>
        </form>
    </tr>
   <?php }else{ ?>
            <a href="login.php" style="color: red; text-decoration: none; margin: 30px 0;" >ต้องล็อกอินเป็นสมาชิกก่อน ไปหน้าล็อกอิน click</a>

   <?php } ?>
    <?php
}
?>
    
    </tbody>
    </table>
    </div>
    </div>
    
</body>
</html>