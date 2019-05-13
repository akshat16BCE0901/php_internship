<?php 
    session_start();
    require 'connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
        $invid = $_POST['invid'];
        $depositamount = $_POST['depositamount'];
        $depositdate = $_POST['depositdate'];
        $mode = $_POST['mode'];
        $query = "INSERT INTO `invoicedetails`(`invid`, `amountpaid`, `depositdate`, `mode`) VALUES ('$invid',$depositamount,'$depositdate','$mode')";
        if(mysqli_query($conn,$query))
        {
            echo "<script>alert('Successfully inserted');location.href='details.php?k=$invid'</script>";
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