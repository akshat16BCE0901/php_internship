<?php 
session_start();
$_SESSION['correct']=false;
$_SESSION['randnum2']++;
$invoiceid = $_POST["invoiceid"];
$amount = $_POST["amount"];
$user = $_POST["user"];
$phone = $_POST["phone"];
$email = $_POST["email"];


include 'src/instamojo.php';

$api = new Instamojo\Instamojo('3bc57542c20f0f83e20592adc66736b6', 'a011175702d3c9212182b2a2e6153562','https://www.instamojo.com/api/1.1/');


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $invoiceid,
        "amount" => $amount,
        "buyer_name" => $user,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://internship.akshatsinghal.me/instamojo/thankyou.php",
        "webhook" => "http://internship.akshatsinghal.me/instamojo/webhook.php"
        ));
    //print_r($response);

    $pay_ulr = $response['longurl'];
    
    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
  ?>