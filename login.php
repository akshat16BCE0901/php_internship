<?php 
	session_start();
	require 'connect.php';
    if(!isset($_SESSION['randnum']))
	{
		$_SESSION['randnum']=1;
	}
	$conn = mysqli_connect($servername,$username,$password,$database);
	$usernam = $_POST['user_id'];
	$passwor = $_POST['password'];
	$query = "select * from login2 where `user_id`='".$usernam."' and `password`='".$passwor."'";
	if($conn)
	{
		$result = mysqli_query($conn,$query);
		if($result)
		{
			if(mysqli_num_rows($result)>0)
			{
				$_SESSION['user'] = $usernam;
				$row = mysqli_fetch_array($result);
				if($row[5]=='admin')
				{
					echo '<script>location.href="web/index.php"</script>';
				}
				elseif ($row[5]=='vendor') {
					echo '<script>location.href="web/index.php"</script>';
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
					echo '<script>location.href="index.php"</script>';
				}
			}
			else
			{
				echo "User not found";
			}
		}

	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}
?>