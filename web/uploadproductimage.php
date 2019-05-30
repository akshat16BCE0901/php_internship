<?php
	session_start();
	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
	$sub = $_POST['subcat'];
	$productid = $_POST['productid'];
	$maincatid = $_POST['maincat'];
	$brand = $_POST['brand'];
	$q1 = "select name from categories where id=$maincatid";
	$r1 = mysqli_query($conn,$q1);
	if($r1)
	{
		$row2 = mysqli_fetch_array($r1);
		$main = strtolower($row2[0]);

	}	
	if(file_exists($_FILES['productimage']['tmp_name']) && is_uploaded_file($_FILES['productimage']['tmp_name']))
	{
	  $errors= array();
	  $file_name = $_FILES['productimage']['name'];
	  $file_size =$_FILES['productimage']['size'];
	  $file_tmp =$_FILES['productimage']['tmp_name'];
	  $file_type=$_FILES['productimage']['type'];
	  $tt = explode('.',$_FILES['productimage']['name']);
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
	     
	     $query2 = "update products set `imagelink`='assets/images/$main/$sub/$brand/$file_name' where id=$productid";
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