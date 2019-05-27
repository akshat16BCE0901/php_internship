<?php
    session_start();
    require '../connect.php';   
    $conn = mysqli_connect($servername,$username,$password,$database);
?>
        <div class="main-page">
            <div class="tables">
                
                <div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
                    
                    <h4>Invoices</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Invoice ID</th>
                            <th>UserID</th>
                            <th>Total Amount</th>
                            <th>Amount Paid</th>
                            <th>Remaining</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php 

                            $query = "select A.invid,A.username,A.amount,IF(sum(B.amountpaid) IS NOT NULL, sum(B.amountpaid),0),IF((A.amount-(sum(B.amountpaid))) IS NOT NULL,(A.amount-(sum(B.amountpaid))),A.amount ) from invoice as A left join invoicedetails as B on A.invid=B.invid group by A.invid";
                            $result = mysqli_query($conn,$query);
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
                                                <td><button class='toggledetail btn btn-primary'>Expand</button></td>
                                            </tr>";
                                        ?>
                                        <tr class="nr" style="display: none;">
                                            <td colspan="6">
                                                <div>
                                                    <table class="table table-bordered">
                
                                                        <tr>
                                                            <th>Invoice ID</th>
                                                            <th>Amount Paid</th>
                                                            <th>Deposit Date</th>
                                                            <th>Mode of payment</th>
                                                        </tr>
                                                        <?php

                                                           $query2 = "select A.invid,IFNULL(B.amountpaid,0),IFNULL(B.depositdate,0),B.mode from invoice as A left join invoicedetails as B on A.invid=B.invid where A.invid='$row[0]'";
                                                            $result2 = mysqli_query($conn,$query2);
                                                            if($result2)
                                                            {
                                                                while($row2 = mysqli_fetch_array($result2))
                                                                {
                                                                        echo "<tr>
                                                                                <td>".$row2[0]."</td>
                                                                                <td>".$row2[1]."</td>
                                                                                <td>".$row2[2]."</td>
                                                                                <td>".$row2[3]."</td>
                                                                            </tr>";
                                                                }
                                                            }
                                                            else{
                                                                echo mysqli_error($conn);
                                                            }

                                                        ?>
                                                    </table>
                                                </div>   
                                            </td>
                                        </tr>

                                        <?php 
                                }
                            }

                        ?>
                    </table>
                </div>
                <!-- <div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 

                    <h4>Invoices Details</h4>
                    <table class="table table-striped table-hover">
                
                        <tr>
                            <th>Invoice ID</th>
                            <th>Amount Paid</th>
                            <th>Deposit Date</th>
                            <th>Mode of payment</th>
                        </tr>
                        <?php

                           // $query2 = "select A.invid,IFNULL(B.amountpaid,0),IFNULL(B.depositdate,0),B.mode from invoice as A left join invoicedetails as B on A.invid=B.invid";
                           //  $result2 = mysqli_query($conn,$query2);
                           //  if($result2)
                           //  {
                           //      while($row2 = mysqli_fetch_array($result2))
                           //      {
                           //              echo "<tr>
                           //                      <td>".$row2[0]."</td>
                           //                      <td>".$row2[1]."</td>
                           //                      <td>".$row2[2]."</td>
                           //                      <td>".$row2[3]."</td>
                           //                  </tr>";
                           //      }
                           //  }
                           //  else{
                           //      echo mysqli_error($conn);
                           //  }

                        ?>
                    </table>
                </div> -->
                
            </div>
            
        </div>
    
    <!-- side nav js -->
    <script src='js/SidebarNav.min.js' type='text/javascript'></script>
    <script>
      $('.sidebar-menu').SidebarNav()
    </script>
    <!-- //side nav js -->
    
    <!-- Classie --><!-- for toggle left push menu script -->
        <script src="js/classie.js"></script>
        <script>
            var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
                showLeftPush = document.getElementById( 'showLeftPush' ),
                body = document.body;
                
            showLeftPush.onclick = function() {
                classie.toggle( this, 'active' );
                classie.toggle( body, 'cbp-spmenu-push-toright' );
                classie.toggle( menuLeft, 'cbp-spmenu-open' );
                disableOther( 'showLeftPush' );
            };
            
            function disableOther( button ) {
                if( button !== 'showLeftPush' ) {
                    classie.toggle( showLeftPush, 'disabled' );
                }
            }
        </script>
    <!-- //Classie --><!-- //for toggle left push menu script -->
    
    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>
    <script type="text/javascript">
        
        $(".toggledetail").unbind().click(function()
        {

            $(this).closest("tr").next("tr").toggle();
            
        });

    </script>
    

        
</body>
</html>