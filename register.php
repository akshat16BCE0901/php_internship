<?php 
	session_start();
	require 'connect.php';
	$user = $_POST['user_id'];
	$user = trim($user);
	$pass = $_POST['password'];
	$pass = trim($pass);
	$confirm  = $_POST['confirmpass'];	
	$confirm = trim($confirm);
    $address=$_POST['address'];
    $address=trim($address);
    $city=$_POST['city'];
    $city=trim($city);
    $state=$_POST['state'];
    $state=trim($state);
    $role=$_POST['role'];
    $role=trim($role);
    $email = $_POST['email'];
    $email = trim($email);
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		if($pass!=$confirm)
		{
			echo '<script>alert("Password do not match");location.href="index.php"</script>';
		}
		else
		{
			if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				echo '<script>alert("Incorrect Email");location.href="index.php"</script>';
			}
			else
			{
				if(empty($user) || empty($pass))
				{
					echo "<script>alert('Enter valid username/password');location.href='index.php';</script>";
				}
				else
				{
					$query = "insert into login2(user_id,password,cdate,role,address,city,state) values('".$user."','".$pass."','".date("Y-m-d")."','".$role."','".$address."','".$city."','".$state."')";
					$result = mysqli_query($conn,$query);
					if($result)
					{
						$_SESSION['user']=$user;
						if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name']))
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
					         echo '<script>alert("Successfully Registered");</script>';
					         if($role=='vendor')
					         {
					         	?> 
					
									<script type="text/javascript">location.href='web/index.php';</script>

					         	<?php
					         }
					         else
					         {
					         	if(isset($_SESSION['user']))
								{
									$a = 'PRDCTHD'.$_SESSION['user'].date("dmy").date("His").$_SESSION['randnum'];
									$b = $_SESSION['user'];
									$c = date("Y-m-d");
									$q = "INSERT INTO `producthead`(`id`, `user_id`, `entry_date`) VALUES ('".$a."','".$b."','".$c."')";

									if(mysqli_query($conn,$q))
									{
										$_SESSION['randnum']++;
										$_SESSION['prdcthd'] = $a;
									}
									else
									{
										echo mysqli_error($conn);
									}
								}
					         	?> 

									<script type="text/javascript">window.history.back();</script>

					         	<?php
					         }
					      }else{
					      	echo '<script>alert("'.$errors[0].'");location.href="index.php"</script>';

					      }
					    }
					    else
					    {
					    	echo '<script>alert("Successfully Registered");';
					    	if($role=='vendor')
					         {
					         	?> 

									<script type="text/javascript">location.href='web/index.php';</script>

					         	<?php
					         }
					         else
					         {
					         	if(isset($_SESSION['user']))
								{
									$a = 'PRDCTHD'.$_SESSION['user'].date("dmy").date("His").$_SESSION['randnum'];
									$b = $_SESSION['user'];
									$c = date("Y-m-d");
									$q = "INSERT INTO `producthead`(`id`, `user_id`, `entry_date`) VALUES ('".$a."','".$b."','".$c."')";

									if(mysqli_query($conn,$q))
									{
										$_SESSION['randnum']++;
										$_SESSION['prdcthd'] = $a;
									}
									else
									{
										echo mysqli_error($conn);
									}
								}
					         	?> 
									
									<script type="text/javascript">window.history(-1);</script>

					         	<?php
					         }
					    }
						
					}
					else
					{
						echo mysqli_error($conn);
					}
				}
				
			}
		}
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}
?>