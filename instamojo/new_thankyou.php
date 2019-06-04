<?php 

  session_start();
  include '../connect.php';
  $conn = mysqli_connect($servername,$username,$password,$database);
  if($conn)
  {
    
  }
  else
  {

  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Thank You, Mojo</title>

<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container">

      <div class="page-header">
        <h1><a href="index.php">Instamojo Payment</a></h1>
        <p class="lead">A test payment integration for instamojo paypemnt gateway. Written in PHP</p>
      </div>

      <h3 style="color:#6da552">Thank You, Payment success!!</h3>
  

 <?php

include 'src/instamojo.php';

$api = new Instamojo\Instamojo('3bc57542c20f0f83e20592adc66736b6', 'a011175702d3c9212182b2a2e6153562','https://www.instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];


try {
    $response = $api->paymentRequestStatus($payid);
    $invid = $response['purpose'];
    $amount = $response['amount'];
    $date = date("Y-m-d");
    $mode = $response['payments'][0]['instrument_type'];
    $query = "INSERT into invoicedetails(`invid`,`amountpaid`,`depositdate`,`mode`) VALUES('$invid',$amount,'$date','$mode')";
    $result = mysqli_query($conn,$query);
    if($result)
    {
        date_default_timezone_set('Asia/Kolkata');
      $msg = '<!DOCTYPE html>
                <html>
                <head>
                  <title></title>
                  <style>
                    
                  </style>
                </head>
                <body>
                  <table cellpadding="10px" border="1" style="border-collapse: collapse;">
                    <tr>
                      <th style="font-weight: bold;text-align: center;padding: 10px;" colspan="5">
                        BILL ID : '.$invid.'
                      </th>
                    </tr>
                    <tr>
                      <td style="padding: 10px;" colspan="3">Date -  '.date("d/m/Y").'</td>
                      <td style="padding: 10px;" colspan="2">Time - '.date("g:i:s A").'</td>
                    </tr>
                    <tr>
                      <th style="font-weight: bold;padding: 10px;">Product ID</th>
                      <th style="font-weight: bold;padding: 10px;">Product Name</th>
                      <th style="font-weight: bold;padding: 10px;">Product Quantity</th>
                      <th style="font-weight: bold;padding: 10px;">Product Price</th>
                      <th style="font-weight: bold;padding: 10px;">Subtotal</th>
                    </tr>';
    //   echo "Inserted into database";
      $user_id = $_SESSION['user'];
      $query4 = "select B.* from producthead as A inner join productdetails as B on A.id=B.head_id where A.user_id='".$user_id."'";
      $result4 = mysqli_query($conn,$query4);
      if($result4)
      {
        while($row = mysqli_fetch_array($result4))
        {
          $query1 = "INSERT INTO `orders`(`head_id`, `productid`, `imagelink`, `product_name`, `quantity`, `price`, `peritempreice`,`vendor_name`) VALUES ('".$row[1]."',".$row[2].",'".$row[3]."','".$row[4]."',".$row[5].",".$row[6].",".$row[7].",'".$row[8]."')";
          $msg.='<tr>
                  <td style="padding: 10px;">'.$row[1].'</td>
                  <td style="padding: 10px;">'.$row[4].'</td>
                  <td style="padding: 10px;">'.$row[5].'</td>
                  <td style="padding: 10px;">'.$row[7].'</td>
                  <td style="padding: 10px;">'.$row[6].'</td>
                </tr>';
          $query2 = "delete from `productdetails` where id=".$row[0];
          mysqli_query($conn,$query1);
          mysqli_query($conn,$query2);
        }
        $msg.='<tr>
                  <th  style="padding: 10px;font-weight: bold;text-align: center;" colspan="5">
                    Total Price : '.$amount.'
                  </th>
                </tr>
                </table>
                </body>
                </html>';
      }
      else
      {

      }
      
    }
    else
    {
      echo mysqli_error($conn);
    }

    echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
    echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
    echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;

//   echo "<pre>";
//   print_r($response);
//   echo "</pre>";
  echo "$msg";
  $msg = wordwrap($msg,70);
    $headers= "MIME-Version: 1.0"."\r\n";
    $headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers.= "From: internship@akshatsinghal.me"."\r\n";
    $headers.= "Cc: akshat.singhal2016@vitstudent.ac.in"."\r\n";
    // send email
    mail($response['payments'][0]['buyer_email'],"Order receipt",$msg,$headers);
    ?>


    <?php
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}



  ?>


      
    </div> <!-- /container -->


  </body>
</html>