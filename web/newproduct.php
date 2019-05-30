<?php 
	session_start();
	require '../connect.php';
	$conn = mysqli_connect($servername,$username,$password,$database);
	$name = trim($_POST['pname']);
	$brand = trim($_POST['pbrand']);
	$price = trim($_POST['pprice']);
	$rating = trim($_POST['prating']);
  $quantity =$_POST['pquantity'];
	$maincat = trim($_POST['maincat']);
	$subcat = trim($_POST['subcat']);
	$vendor_name = trim($_SESSION['user']);
	$query = "select name from categories where id=$maincat";
	$result= mysqli_query($conn,$query);
	if($result)
	{
		while($row = mysqli_fetch_array($result))
		{
			$main = $row[0];
			$main = strtolower($main);
		}
	}
	$query = "select name from subcategories where id=$subcat";
	$result= mysqli_query($conn,$query);
	if($result)
	{
		while($row = mysqli_fetch_array($result))
		{
			$sub = $row[0];
			$sub = strtolower($sub);
		}
	}

	if(file_exists($_FILES['pimage']['tmp_name']) && is_uploaded_file($_FILES['pimage']['tmp_name']))
	{
      $errors= array();
      $file_name = $_FILES['pimage']['name'];
      $file_size =$_FILES['pimage']['size'];
      $file_tmp =$_FILES['pimage']['tmp_name'];
      $file_type=$_FILES['pimage']['type'];
      $tt = explode('.',$_FILES['pimage']['name']);
      $file_ext=strtolower(end($tt));
      $pre = "../assets/images/$main/$sub/$brand/";
      if (!file_exists($pre)) {
		    mkdir($pre, 0777, true);
		  }
      $filenewname = $pre.$file_name;
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPG, JPEG or PNG file.";
      }
      
      if($file_size > 1048576){
         $errors[]='File size must be less than 1 MB';
      }
      
      if(empty($errors)==true){
      	
         move_uploaded_file($file_tmp,$filenewname);
         
         $query2 = "INSERT INTO `products`(`name`, `brand`, `price`, `rating`, `imagelink`, `subcatid`, `vendor_name`,`quantity`) VALUES ('$name','$brand','$price','$rating','assets/images/$main/$sub/$brand/$file_name','$subcat','$vendor_name',$quantity)";
         $rr = mysqli_query($conn,$query2);
         if($rr)
         {
         	echo "<script>alert('Uploaded');location.href='index.php'</script>";
         }
         else
         {
         	echo mysqli_error($conn);
         }


      }else{
      	echo '<script>alert("'.$errors[0].'");location.href="index.php"</script>';

      }
    }
    else
    {
    	?>
		<script>
			alert("Image not uploaded");
		</script>
    	<?php
    }


?>