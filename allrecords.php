<?php 
	session_start();
	require 'connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		echo "";
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Invoice</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style type="text/css">
			#generate
			{
				padding: 10px;
				border: 2px solid black;
				border-radius: 10px;
				background-color: #c5f2b0;
			}
			#pay
			{
				padding: 10px;
				border: 2px solid black;
				border-radius: 10px;
				background: #c2d3ef;
			}
			section
			{
				padding: 15px;
			}
			body
			{
				background: #D3CCE3;  /* fallback for old browsers */
				background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);  /* Chrome 10-25, Safari 5.1-6 */
				background: linear-gradient(to right, #E9E4F0, #D3CCE3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

			}
		</style>
	</head>
	<body>
		<section>
			<h1 align="center">All records</h1>
		</section>
		<section>
			<div class="col-md-4 col-md-offset-1" id="generate">
                <div>
                    <table cellpadding='10px'><tr>
                        <td><h4>Search by Invoice ID : </h4></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<select>
                        <?php

                            $q = "select distinct(invid) from invoice";
                            $r = mysqli_query($conn,$q);
                            if($r)
                            {
                                while($ro = mysqli_fetch_array($r))
                                {
                                    echo "<option value='".$ro[0]."'>".$ro[0]."</option>";
                                }
                            }
                        ?>
                    </select></td>
                    </tr></table>
                    
                </div>
                    <?php

                        $query = "select A.invid,A.username,A.amount,IF(sum(B.amountpaid) IS NOT NULL, sum(B.amountpaid),0),IF((A.amount-(sum(B.amountpaid))) IS NOT NULL,(A.amount-(sum(B.amountpaid))),A.amount ) from invoice as A left join invoicedetails as B on A.invid=B.invid group by A.invid";
                        $result = mysqli_query($conn,$query);
                        if($result)
                        {
                            echo"<h2 align='center'>All invoices</h2><table class='table table-striped table-hover' cellpadding='10px;' border='1' style='border-collapse:collapse;'>
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
                    
                    
                    ?>
			</div>
			<div class="col-md-4 col-md-offset-2" id="pay">
				<h3>Payment Details</h3>
                <?php

                    $query2 = "select A.invid,IFNULL(B.amountpaid,0),IFNULL(B.depositdate,0),B.mode from invoice as A left join invoicedetails as B on A.invid=B.invid";
                    $result2 = mysqli_query($conn,$query2);
                    if($result2)
                    {
                        echo"<h2>Details of payment</h2><table class='table table-striped table-hover' cellpadding='10px;' border='1' style='border-collapse:collapse;'>
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
                
                ?>
			</div>
		</section>
	</body>
</html>
