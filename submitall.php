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
        $headid = $_POST['headid'];
        $productname = $_POST['productname'];
        $productquantity = $_POST['productquantity'];
        $productprice = $_POST['productprice'];	
        if($productname!="")
        {
            $query = "INSERT INTO `productdetails`(`head_id`, `product_name`, `quantity`, `price`) VALUES ('".$headid."','".$productname."','".$productquantity."','".$productprice."')";
            $result = mysqli_query($conn,$query);
            if($result)
            {
                echo "Success";
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