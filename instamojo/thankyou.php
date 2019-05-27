<?php 

  session_start();
  include '../connect.php';
  $conn = mysqli_connect($servername,$username,$password,$database);
  if($conn)
  {
    $user_id = $_SESSION['user'];
    $query = "select B.* from producthead as A inner join productdetails as B on A.id=B.head_id where A.user_id='".$user_id."'";
    $result = mysqli_query($conn,$query);
    if($result)
    {
      while($row = mysqli_fetch_array($result))
      {
        $query1 = "INSERT INTO `orders`(`head_id`, `productid`, `imagelink`, `product_name`, `quantity`, `price`, `peritempreice`) VALUES ('".$row[1]."',".$row[2].",'".$row[3]."','".$row[4]."',".$row[5].",".$row[6].",".$row[7].")";
        $query2 = "delete from `productdetails` where id=".$row[0];
        mysqli_query($conn,$query1);
        mysqli_query($conn,$query2);
      }
    }
    else
    {

    }
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
      echo "Inserted into database";
    }
    else
    {
      echo mysqli_error($conn);
    }

    echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
    echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
    echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;

  echo "<pre>";
   print_r($response);
  echo "</pre>";
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