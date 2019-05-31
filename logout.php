<?php 
	session_start();
	unset($_SESSION['user']);
	unset($_SESSION['category']);
	unset($_SESSION['prdcthd']);
	echo "<script>alert('Successfully Logged Out');location.href='index.php'</script>";

?>