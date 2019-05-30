<?php 
	session_start();
	require 'connect.php';
	if(!isset($_SESSION['user']))
	{
		echo 'Sign Up or Login to purchase items';
	}
    else
    {
        $conn = mysqli_connect($servername,$username,$password,$database);
        if($conn)
        {
            $productid = $_POST['productid'];
            $headid = $_POST['headid'];
            $productname = $_POST['productname'];
            $productquantity = $_POST['productquantity'];
            $productprice = $_POST['productprice']; 
            $perprice = $_POST['perprice'];
            $imagelink = $_POST['image'];
            $vendorname = $_POST['vendorname'];
            if($productname!="")
            {
                
                $query = "INSERT INTO `productdetails`(`head_id`, `productid`,`imagelink`, `product_name`, `quantity`, `price`, `peritempreice`,`vendor_name`) VALUES ('".$headid."','".$productid."','".$imagelink."','".$productname."','".$productquantity."','".$productprice."',".$perprice.",'".$vendorname."')";
                $result = mysqli_query($conn,$query);
                if($result)
                {
                    $query1 = "select quantity from products where id=$productid";
                    $r = mysqli_query($conn,$query1);
                    if($r)
                    {
                        $row = mysqli_fetch_array($r);
                        $quan = $row[0];
                        $quanleft = $quan-$productquantity;
                        $quer = "UPDATE products set `quantity`=$quanleft where `id`=$productid";
                        $res = mysqli_query($conn,$quer);
                        if($res)
                        {
                            echo "Item added to cart";
                        }
                        else
                        {
                            echo mysqli_error($conn);
                        }
                    }
                    else
                    {
                        echo mysqli_error($conn);
                    }
                }
                else{
                    echo mysqli_error($conn);
                }
            }
            
        }
        else
        {
            echo "Error - ".mysqli_error($conn);
        }
    }
	
?>