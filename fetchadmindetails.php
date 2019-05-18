<?php 
    session_start();
    require 'connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);

?>
        <div class='main-page'>
        <div class='tables'>
        <?php

            if($conn)
            {
                $query = "select A.invid,A.username,A.amount,IF(sum(B.amountpaid) IS NOT NULL, sum(B.amountpaid),0) as totalpaid,IF((A.amount-(sum(B.amountpaid))) IS NOT NULL,(A.amount-(sum(B.amountpaid))),A.amount) as ramaining from invoice as A left join invoicedetails as B on A.invid=B.invid where A.username='".$_GET['k']."' group by A.invid";
                $result = mysqli_query($conn,$query);
                if($result)
                {
                    echo "<div class='bs-example table-responsive widget-shadow' data-example-id='bordered-table'><h2 align='center'>All Invoices</h2><table id='scrolltable' class='table table-bordered' cellpadding='10px;' style='border-collapse:collapse;'>
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
                echo "</table></div><br><br>";
                }
                $query2 = "select A.invid,IFNULL(B.amountpaid,0),IFNULL(B.depositdate,0),B.mode from invoice as A left join invoicedetails as B on A.invid=B.invid where A.username='".$_GET['k']."'";
                $result2 = mysqli_query($conn,$query2);
                if($result2)
                {
                    echo"<div class='bs-example table-responsive widget-shadow' data-example-id='bordered-table'><h2 align='center'>Details of invoices</h2><table id='scrolltable' class='table table-bordered' cellpadding='10px;' style='border-collapse:collapse;'>
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
                echo "</table></div></div>";
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