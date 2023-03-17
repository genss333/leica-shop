<?php 
        session_start();
        require_once("dbcontroller.php");
        include('server.php');
        $total=0;
	    foreach($_SESSION['cart'] as $p_id=>$qty)
	{
        echo $member =$_SESSION["member"];
		$sql	= "select * from product where product_id=$p_id";
		$query	= mysqli_query($conn, $sql);
		$row	= mysqli_fetch_array($query);
        $sql2	= "select * from customer where email='$member'";
		$query2	= mysqli_query($conn, $sql2);
        $row2	= mysqli_fetch_array($query2);
        $sql3	= "select * from book where email='".$_SESSION["member"]."'";
		$query3	= mysqli_query($conn, $sql3);
        $row3	= mysqli_fetch_array($query3);
		$sum	= $row['price']*$qty;
		$total	+= $sum;
            echo $image = $row["image"];
            echo $p_name = $row["name"];
            echo $row['price'];
            echo $qty;
            echo $sum;
            echo $cus_fname = $row2["firstname"];
            echo $cus_lname = $row2["lastname"];
            $total_price = $_SESSION["total"] *$row["price"];
            $address = $row3["address"];
            $tel = $row3["tel"];
                if($qty>$row["number"]){
                    $sql = "INSERT INTO `cart` (`id`, `product_id`, `product_name`, `customer_email`, `firstname`, `lastname`, `address`, `tel`, `number`, `price`) 
                    VALUES (NULL, '$p_id', '$p_name', '$member', '$cus_fname', '$cus_lname', '$address', '$tel','".$row["number"]."', '$total_price')";
                    $query =  mysqli_query($conn,$sql);
                    unset($_SESSION['cart'][$p_id]);
                    header("location:cart.php");
                }else{
                    $sql = "INSERT INTO `cart` (`id`, `product_id`, `product_name`, `customer_email`, `firstname`, `lastname`, `address`, `tel`, `number`, `price`) 
                    VALUES (NULL, '$p_id', '$p_name', '$member', '$cus_fname', '$cus_lname', '$address', '$tel','$qty', '$total_price')";
                    $query =  mysqli_query($conn,$sql);
                    unset($_SESSION['cart'][$p_id]);
                    header("location:cart.php");
                }
          
            }
            
              
                












?>