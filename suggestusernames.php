<?php 

	require "connect.php";
	$uname = trim($_POST['uname']);
	$arr = array();
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		if(empty($uname))
		{
			echo "";
		}
		else
		{
			echo "Suggested Usernames<p>";
			$query = "select user_id from login2";
			$result = mysqli_query($conn,$query);
			while($row = mysqli_fetch_array($result))
			{
				array_push($arr, $row[0]);
			}
			for ($i=0; $i < 3; $i++) { 
				$temp = $uname.rand(1,999);
				while(in_array($temp, $arr))
				{
					$temp = $uname.rand(1,999);
				}
				echo "<a val='$temp' class='sugg' style='cursor : pointer; max-width : 30px;'>".$temp."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			echo "</p>";
		}
		
	}
	else
	{
		mysqli_error($conn);
	}

?>
<script type="text/javascript">
	$(".sugg").click(function()
	{
		$("#keyupfield").val($(this).text());
		$("#spanninguser").html("");
		$(".suggestions").html("");
	});
</script>