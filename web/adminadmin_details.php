<?php 
    session_start();
    require '../connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);

?>
<!DOCTYPE html>
<html>
	<!-- <head>
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
	</head> -->
	
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                     <table class="table table-hover table-striped">
                         <tr>
                             <td>Select User_id</td>
                             <td><select class="country" id="myselect">
                                <option value="">---SELECT---</option>
                                 <?php 

                                    $query = "select * from login2";
                                    $result = mysqli_query($conn,$query);
                                    if($result)
                                    {
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            echo "<option value='".$row[1]."'>".$row[1]."</option>";
                                        }
                                    }

                                 ?>
                             </select></td>
                             <td><button class="submit-id btn btn-primary">SUBMIT</button></td>
                         </tr>
                     </table>
                </div>
            </div>
        </div>

        <div id='body' class='container'>
            <div id="fetch_body" class='row'>
                
            </div>
        </div>

    <script>
        $(".submit-id").click(function()
        {
            
            var value_id = $("#myselect").children("option:selected").val();
            console.log(value_id);
            $.ajax({
                type : 'get',
                url : '../fetchadmindetails.php',
                data: {
                    k : value_id
                },
                success: function(data)
                {
                    $('#fetch_body').html(data);
                    console.log(data);
                }
            });
        });
    </script>