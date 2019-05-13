<?php 
    session_start();
    require 'connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
        $query = "select A.invid,A.username,A.amount,sum(B.amountpaid),(A.amount-(sum(B.amountpaid))) from invoice as A inner join invoicedetails as B on A.invid=B.invid where A.invid='".$_GET['k']."'";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            echo"<h2>Details of payment</h2><table cellpadding='10px;' border='1' style='border-collapse:collapse;'>
                    <tr>
                        <th>Invoice ID</th>
                        <th>UserID</th>
                        <th>Total Amount</th>
                        <th>Amount Paid</th>
                        <th>Remaining</th>
                    </tr>";
           while($row = mysqli_fetch_array($result))
           {
                echo "<tr>
                        <td>".$row[0]."</td>
                        <td>".$row[1]."</td>
                        <td>".$row[2]."</td>
                        <td>".$row[3]."</td>
                        <td>".$row[4]."</td>
                    </tr>";
           }
           echo "</table>";
        }
        $query2 = "select A.invid,B.amountpaid,B.depositdate,B.mode from invoice as A inner join invoicedetails as B on A.invid=B.invid where A.invid='".$_GET['k']."'";
        $result2 = mysqli_query($conn,$query2);
        if($result2)
        {
            echo"<h2>Details of payment</h2><table cellpadding='10px;' border='1' style='border-collapse:collapse;'>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Amount Paid</th>
                        <th>Deposit Date</th>
                        <th>Mode of payment</th>
                    </tr>";
           while($row2 = mysqli_fetch_array($result2))
           {
                echo "<tr>
                        <td>".$row2[0]."</td>
                        <td>".$row2[1]."</td>
                        <td>".$row2[2]."</td>
                        <td>".$row2[3]."</td>
                    </tr>";
           }
           echo "</table>";
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
