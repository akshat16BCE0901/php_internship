<?php 
	require '../connect.php';
	$conn =mysqli_connect($servername,$username,$password,$database);
	$obj = json_decode($_POST["arr"], false);
	$id = $_POST['id'];
	$alreadythere = array();
	$query = "select menu from adminmenus where user=$id";
	$res = mysqli_query($conn,$query);
	if($res)
	{
		while($row = mysqli_fetch_array($res)) 
		{
			array_push($alreadythere, intval($row[0]));
		}
	}
	$count=0;
	$array = ($obj->params);
	for ($i=0; $i < count($array); $i++) {

		if(in_array(intval($array[$i]), $alreadythere))
		{
			echo "";
		}
		else
		{
			$query = "insert into adminmenus(`user`,`menu`) values($id,".intval($array[$i]).")";
			if(mysqli_query($conn,$query))
			{
				echo "";
			}
			else
			{
				echo mysqli_error($conn);
				$count++;
			}
		}
	}
	if($count!=0)
	{
		echo "ERROR WHILE SETTING PRIVILEGES";
	}
	else
	{
		echo "Privileges added!!";
	}


?>