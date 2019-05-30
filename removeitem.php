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
		$id= $_POST['id'];
		$quantity = $_POST['quantity'];
		$query4 = "select productid from productdetails where id=$id";
		$r = mysqli_query($conn,$query4);
        if($r)
        {
            $row = mysqli_fetch_array($r);
            $pid = $row[0];
        }
		$query = "DELETE from `productdetails` WHERE `id`=".$id;
		if(mysqli_query($conn,$query))
		{
			$query1 = "select quantity from products where id=$pid";
            $r = mysqli_query($conn,$query1);
            if($r)
            {
                $row = mysqli_fetch_array($r);
                $quan = $row[0];
                $quanleft = $quan+$quantity;
                $quer = "UPDATE products set `quantity`=$quanleft where `id`=$pid";
                echo "$quer";
                $res = mysqli_query($conn,$quer);
                if($res)
                {
                    echo "Item removed";
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
		else
		{
			echo mysqli_error($conn);
		}

	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}


 ?>
 