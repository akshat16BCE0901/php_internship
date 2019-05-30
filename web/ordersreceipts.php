<?php
	session_start();
	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
	$pageno = $_GET['page'];
?>

<div class="main-page">
	<div class="tables">
		
		<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
			
			<table  class="table table-bordered">
				<tr>
					<th>Order ID</th>
					<th>Total Price</th>
					<th>Total Quantity</th>
					<th>User ID</th>
					<th>Date of order</th>
					<th>&nbsp;</th>
				</tr>
				<?php
					$offset= ($pageno*3) - 3;
					$rowcount = "select count(distinct head_id) from orders";
					$tt= mysqli_query($conn,$rowcount);
					if($tt)
					{
						$rr = mysqli_fetch_array($tt);
						$count = $rr[0];
						$num_row = ceil($count/3);
					}
					$query= "select A.head_id, sum(A.price),sum(A.quantity),B.user_id,B.entry_date from orders as A inner join producthead as B on A.head_id=B.id where A.vendor_name='".$_SESSION['user']."' group by A.head_id order by B.entry_date desc limit $offset,3";
					$result= mysqli_query($conn,$query);
					if($result)
					{
						while($row = mysqli_fetch_array($result))
						{
							echo "<tr>
									<td>".$row[0]."</td>
									<td>".$row[1]."</td>
									<td>".$row[2]."</td>
									<td>".$row[3]."</td>
									<td>".$row[4]."</td>
									<td><button class=' toggledetail btn btn-primary'>Expand</button></td>
								</tr>";
							echo "<tr style='display:none;'><td colspan='6'>";

								$query1 = "select productid,product_name,quantity,peritempreice,price from orders where head_id='".$row[0]."'";
	                                $result2 = mysqli_query($conn,$query1);
	                                if($result2)
	                                {
	                                	echo "<table style='border-collapse:collapse;' border='1' class='table table-bordered table-hover tobeprinted'>
	                                			<tr class='hiddenrows'>
													<th>Order ID</th>
													<th>Total Price</th>
													<th>Total Quantity</th>
													<th>User ID</th>
													<th>Date of order</th>
												</tr>
	                                			<tr class='hiddenrows'>
													<td>".$row[0]."</td>
													<td>".$row[1]."</td>
													<td>".$row[2]."</td>
													<td>".$row[3]."</td>
													<td>".$row[4]."</td>
												</tr> 
												<tr class='hiddenrows' align='center'>
                                                    <td align='center' colspan='5'>
                                                        <h3>Description</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<th>Product ID</th>
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
	                                                <td><?php echo $row1[0]; ?></td>
	                                                <td><?php echo $row1[1]; ?></td>
	                                                <td><?php echo $row1[2]; ?></td>
	                                                <td><?php echo $row1[3]; ?></td>
	                                                <td><?php echo $row1[3]; ?></td>
	                                            </tr>

	                                        <?php
	                                    }
	                                    echo "<tr>
                                                <td align='center' colspan='5'>
                                                    <button align='center' class='print btn btn-primary'>Print</button>
                                                </td> 
                                            </tr></table></td></tr>";
	                                }
						}
					}

				?>

			</table>
		</div>
		<div align="center" class="text-center">
			<?php 
				echo "<br>Pages  - ";
				$i=1;
				for (;$i <=$num_row; $i++) { 
					echo "<button class='pgnum btn btn-sm btn-primary' golink='ordersreceipts.php?page=$i'>&nbsp;$i&nbsp;</button>";
				}
			?>
		</div>
		
	</div>
</div>
<script type="text/javascript" src="../assets/js/printThis.js"></script>
<script type="text/javascript">
	$(document).ready(function()
    {
        $(".hiddenrows").hide();
    });
	$(".pgnum").click(function()
	{

		var bttn  = $(this).attr('golink');
		$.ajax({

            type : 'POST',
            url : bttn,
            data : {

            },
            success : function(data)
            {
              $("#page-wrapper").html(data);
            }

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
    $(".print").click(function()
    {  
        $(this).closest('table.tobeprinted').find('tr').show();
        $(this).hide();
        $(this).closest('table.tobeprinted').printThis({
            pageTitle: "Invoice Details",
            importCSS: true,
            importStyle: true,
            loadCSS: "display : none;"
        });
    });
</script>
