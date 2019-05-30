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
	<body style='margin-top: 80px;'>
        <?php include 'navbar.php'; ?>
        <div align="center" class="container">
            <div class="row">
                <h1>User Details</h1>
            </div>
        </div>
        <div class='container'>
            <div class='row'>
                <div class="col-md-8">
                    <div class='row'>
                        <h2>All payment details</h2>
                    </div>
                    <div class="row">
                        <?php

                            if($conn)
                            {
                                $query = "select A.id,A.entry_date,sum(B.quantity),sum(B.price) from producthead as A inner join orders as B on A.id = B.head_id where user_id='".$_GET['k']."' group by A.id";
                                $result = mysqli_query($conn,$query);
                                if($result)
                                {
                                    ?>
                                    <table style="background-color: #f2f2f2;" class="table table-striped table-hover">
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Total Quantity</th>
                                            <th>Total Price</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        
                                    <?php
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        ?>
                                            <tr>
                                                <td><?php echo $row[0]; ?></td>
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><button class="btn btn-primary toggledetail">Expand</button></td>
                                            </tr>
                                            <tr style="display: none;" class="headdetail">
                                                <td colspan="5">
                                                    
                                        <?php
                                        $query1 = "select A.*,B.head_id,B.product_name,B.quantity,B.price,B.peritempreice from producthead as A inner join orders as B on A.id = B.head_id where user_id='".$_SESSION['user']."' and A.id='".$row[0]."'";
                                        $result2 = mysqli_query($conn,$query1);
                                        if($result2)
                                        {
                                            echo "<table class='table tobeprinted'>
                                                    <tr class='hiddenrows'>
                                                        <th>Order ID</th>
                                                        <th>Date</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                    <tr class='hiddenrows'>
                                                        <td>$row[0]</td>
                                                        <td>$row[1]</td>
                                                        <td>$row[2]</td>
                                                        <td>$row[3]</td>
                                                    </tr>
                                                    <tr class='hiddenrows' align='center'>
                                                        <td align='center' colspan='4'>
                                                            <h3>Description</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Product Quanity</th>
                                                        <th>Price per item</th>
                                                        <th>Sub total</th>
                                                    </tr>
                                            ";
                                            while($row1 = mysqli_fetch_array($result2))
                                            {

                                                ?>
                                                    
                                                    <tr>
                                                        <td><?php echo $row1[4]; ?></td>
                                                        <td><?php echo $row1[5]; ?></td>
                                                        <td><?php echo $row1[7]; ?></td>
                                                        <td><?php echo $row1[6]; ?></td>
                                                    </tr>

                                                <?php
                                            }
                                            echo "
                                                    <tr>
                                                        <td align='center' colspan='4'>
                                                            <button align='center' class='print btn btn-primary'>Print</button>
                                                        </td> 
                                                    </tr></table></td></tr>";

                                        }
                                        else
                                        {
                                            echo mysqli_error($conn);
                                        }
                                    }
                                    ?></table><?php
                                }
                                else
                                {
                                    echo mysqli_error($conn);
                                }
                            }
                            else
                            {
                                echo "Error - ".mysqli_error($conn);
                            }
                        
                        ?>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <div class='row'>
                        <h2>User information</h2>
                    </div>
                    <div class="row">
                        <table class="table table-hover table-striped">
                            <?php

                                if($conn)
                                {
                                    $user_id = $_SESSION['user'];
                                    $query = "select * from login2 where user_id = '".$_SESSION['user']."'";
                                    $result = mysqli_query($conn,$query);
                                    if($result)
                                    {
                                        $row = mysqli_fetch_array($result);
                                        echo "<tr>
                                                <td>User ID :  </td>
                                                <td>$row[1]</td>
                                                <td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
                                            </tr>
                                            <tr>
                                                <td>Password : </td>
                                                <td id='passs'>"; 
                                                        for($i=0;$i<strlen($row[2]);$i++)
                                                        {
                                                            echo "*";
                                                        }

                                                echo"<span> <a onclick='reveal()' style='cursor : pointer; text-decoration: none;' class='glyphicon glyphicon-pencil'></a></span></td>
                                                <td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
                                            </tr>
                                            <tr>
                                                <td>Address : </td>
                                                <td>$row[6]</td>
                                                <td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
                                            </tr>
                                            <tr>
                                                <td>City : </td>
                                                <td>$row[7]</td>
                                                <td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
                                            </tr>
                                            <tr>
                                                <td>State : </td>
                                                <td>$row[8]</td>
                                                <td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
                                            </tr>";
                                    }
                                }
                                else
                                {
                                    echo "Error - ".mysqli_error($conn);
                                }

                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php 

        include 'footer.php';

    ?>
    </body>
    <script>
        $(document).ready(function()
        {
            $(".hiddenrows").hide();
        });

        $(".print").click(function()
        {  
            $(this).closest('table.tobeprinted').find('tr').show();
            $(this).closest('table.tobeprinted').printThis({
                pageTitle: "Invoice Details"
            });
        });

        $(".toggledetail").unbind().click(function()
        {
            $(this).closest('tr').next('tr').toggle();
            if($(this).html()=="Expand")
            {
                $(this).html("Minimize");   
            }   
            else
            {
                $(this).html("Expand");
            }
        });
        function reveal()
        {
            var a = $("#passs").text('<?php echo(strval($row[2]));?>');
        }
    </script>
</html>