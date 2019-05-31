<script type="text/javascript" src=""></script>
<?php
	// the message
		
	if(!isset($_POST['msg']))
	{
		?>
			
			<script type="text/javascript">
				$.ajax({

					type : 'POST',
					url : 'sendmail.php',
					data : {

						msg : "<html><head><title></title></head><body><h1>Hello</h1></body></html>"
					}

				});
			</script>

		<?php
	}
	else
	{
		$msg = $_POST['msg'];
		$msg = wordwrap($msg,70);
		$headers = "From: internship@akshatsinghal.me"."\r\n";
		$headers.= "Cc: akshat.singhal2016@vitstudent.ac.in"."\r\n";
		$headers. = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// send email
		mail("akshat.yash@rediffmail.com","Test Email",$msg,$headers);	
	}
	
?>
