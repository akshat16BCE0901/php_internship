<?php 
	session_start();
	require '../connect.php';
	$conn = mysqli_connect($servername,$username,$password,$database);
	if(isset($_POST['submit']))
	{
		if($_FILES['csvdata']['name'])
		{
			$filename = explode('.', $_FILES['csvdata']['name']);
			if(end($filename)=='csv')
			{
				$handle = fopen($_FILES['csvdata']['tmp_name'], "r");
				while($data = fgetcsv($handle))
				{
					$name = trim($data[0]);
					$brand = trim($data[1]);
					$price = trim($data[2]);
					$rating = trim($data[3]);
					$subcatid = trim($data[4]);
					$vendor_name = $_SESSION['user'];
					$quantity = trim($data[5]);
					$query2 = "INSERT INTO `products`(`name`, `brand`, `price`, `rating`, `subcatid`, `vendor_name`,`quantity`) VALUES ('$name','$brand',$price,$rating,'$subcatid','$vendor_name',$quantity)";
			         $rr = mysqli_query($conn,$query2);
			         if($rr)
			         {
			         	echo "<script>alert('Uploaded');</script>";
			         }
			         else
			         {
			         	echo mysqli_error($conn);
			         }		
				}
			} 
		}
	}

?>