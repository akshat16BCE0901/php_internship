<?php 
    session_start();
    require 'connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
        $invid = $_POST['invid'];
        $amount = $_POST['amount'];
        $invdate = $_POST['invdate'];
        $userid = $_POST['userid'];
        $query = "INSERT INTO `invoice` VALUES ('$invid',$amount,'$invdate','$userid')";
        if(mysqli_query($conn,$query))
        {
            $_SESSION['randnum2']++;
            echo "<script>alert('Successfully inserted');location.href='allrecords.php'</script>";
        }
        else{
            echo mysqli_error($conn);
        }
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}


?>