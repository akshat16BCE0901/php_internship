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
		$newquantity = $_POST['newquantity'];
		$newprice = $_POST['newprice'];
		$query4 = "select productid from productdetails where id=$id";
		$r = mysqli_query($conn,$query4);
        if($r)
        {
            $row = mysqli_fetch_array($r);
            $pid = $row[0];
        }
        $query1 = "select quantity from products where id=$pid";
        $r = mysqli_query($conn,$query1);
        if($r)
        {
            $row = mysqli_fetch_array($r);
            $quan = $row[0];
            if($quan==0 && !isset($_POST['minus']))
            {
            	echo "Item Out of Stock";
            }
            else
            {
            	if(isset($_POST['minus']))
            	{
            		$quanleft = $quan+1;
            	}
            	else
            	{
            		$quanleft = $quan-1;
            	}
            	$quer = "UPDATE products set `quantity`=$quanleft where `id`=$pid";
                $res = mysqli_query($conn,$quer);
                if($res)
                {	
                	$query = "UPDATE `productdetails` SET `quantity`= $newquantity, `price`=$newprice WHERE `id`=".$id;
					if(mysqli_query($conn,$query))
					{
						echo "Updated";
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
        }

	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}


 ?>
 