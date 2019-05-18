<?php 
	session_start();
	require 'connect.php';
	$user = $_POST['user_id'];
	$pass = $_POST['password'];
	$confirm  = $_POST['confirmpass'];	
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		if($pass!=$confirm)
		{
			echo '<script>alert("Password do not match");location.href="index.php"</script>';
		}
		else
		{
			$query = "insert into login(user_id,password,cdate) values('".$user."','".$pass."','".date("Y-m-d")."')";
			$result = mysqli_query($conn,$query);
			if($result)
			{
				$_SESSION['user']=$user;
				if(isset($_FILES['image']))
				{
			      $errors= array();
			      $file_name = $_FILES['image']['name'];
			      $file_size =$_FILES['image']['size'];
			      $file_tmp =$_FILES['image']['tmp_name'];
			      $file_type=$_FILES['image']['type'];
			      $tt = explode('.',$_FILES['image']['name']);
			      $file_ext=strtolower(end($tt));
			      
			      $extensions= array("jpeg","jpg","png");
			      
			      if(in_array($file_ext,$extensions)=== false){
			         $errors[]="extension not allowed, please choose a JPG, JPEG or PNG file.";
			      }
			      
			      if($file_size > 1048576){
			         $errors[]='File size must be less than 1 MB';
			      }
			      
			      if(empty($errors)==true){
			      	$temp = explode(".", $_FILES["image"]["name"]);
					$newfilename =$user . '.' . end($temp);
			         move_uploaded_file($file_tmp,"assets/images/profiles/".$newfilename);
			         echo "Success";
			         echo '<script>alert("Successfully Registered");location.href="shop.php"</script>';
			      }else{
			         print_r($errors);
			      }
			    }
				
			}
			else
			{
				echo mysqli_error($conn);
			}
		}
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}
?>