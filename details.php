<?php 
    session_start();
    require 'connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="assets/js/printThis.js"></script>
        <style>
            
			@media screen and (max-width: 700px) {
				
				#scrolltable {
			        display: block;
			        overflow-x: auto;
			        white-space: nowrap;
    			}

			}
        </style>
	</head>
	<body style='background-color:#e3e3e3;'>
        <div class="container">
            <div class='row'>
                <h2 align="center">All payment details</h2>
            </div>
            <div class="row">
                <div align="center" class="col-md-3 col-md-offset-3">
                    <button class='btn btn-primary btn-lg print'>PRINT</button>
                </div>
                <div align="center" class="col-md-3">
                    <button onclick="location.href='cart.php?page=1'" class='btn btn-primary btn-lg'>BACK TO CART</button>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div id='body' class='container'>
        <div class='row'>
        <?php

            if($conn)
            {
                $query = "select A.invid,A.username,A.amount,IF(sum(B.amountpaid) IS NOT NULL, sum(B.amountpaid),0) as totalpaid,IF((A.amount-(sum(B.amountpaid))) IS NOT NULL,(A.amount-(sum(B.amountpaid))),A.amount) as ramaining from invoice as A left join invoicedetails as B on A.invid=B.invid where A.username='".$_GET['k']."' group by A.invid";
                $result = mysqli_query($conn,$query);
                if($result)
                {
                    echo "<div style='border:2px solid black;' class='col-md-8 col-md-offset-2'><h2 align='center'>All Invoices</h2><table id='scrolltable' class='table table-hover table-striped' cellpadding='10px;' border='1' style='border-collapse:collapse;'>
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
                echo "</table></div></div><br><br>";
                }
                $query2 = "select A.invid,IFNULL(B.amountpaid,0),IFNULL(B.depositdate,0),B.mode from invoice as A left join invoicedetails as B on A.invid=B.invid where A.username='".$_GET['k']."'";
                $result2 = mysqli_query($conn,$query2);
                if($result2)
                {
                    echo"<div class='row'><div style='border:2px solid black;' class='col-md-offset-2 col-md-8'><h2 align='center'>Details of invoices</h2><table id='scrolltable' class='table table-striped table-hover' cellpadding='10px;' border='1' style='border-collapse:collapse;'>
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
                echo "</table></div></div></div>";
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
    <?php 

        include 'footer.php';

    ?>
    </body>
    <script>
        $(".print").click(function()
        {
            $("#body").printThis({
                pageTitle: "Invoice Details"
            });
        });
    </script>
</html>