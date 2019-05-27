<?php 
	session_start();
	require 'connect.php';
	if(!isset($_SESSION['user']))
	{
		echo '<script>alert("Sign up/Log in to access dashboard");location.href="index.php"</script>';
	}
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
        if($productname!="")
        {
            
            $query = "INSERT INTO `productdetails`(`head_id`, `productid`,`imagelink`, `product_name`, `quantity`, `price`, `peritempreice`) VALUES ('".$headid."','".$productid."','".$imagelink."','".$productname."','".$productquantity."','".$productprice."',".$perprice.")";
            $result = mysqli_query($conn,$query);
            if($result)
            {
                echo "Item added to cart";
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
?>