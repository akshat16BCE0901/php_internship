<?php 
	$cat = $_POST['category'];
	$subcat = $_POST['subcat'];
	include 'connect.php';
	$subcat = $_POST['subcat'];
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		echo "<div style='padding:20px;'>";
		$query = "select distinct(brand) from products where subcatid=$subcat";
 		$result = mysqli_query($conn,$query);
 		if($result)
 		{
 			echo "<div><h4>Filter By Brands : </h4></div>";
 			while($row = mysqli_fetch_array($result))
 			{
 				echo "<input class='brand-check' type='checkbox' value='".$row[0]."' name='brand'> ".$row[0]."<br>";
 			}
 		}
	}
	else
	{
		echo mysqli_error($conn);

	}
	
?>
<script type="text/javascript">
	$('.brand-check').change(function()
		{
			var fav = [];
			$.each($("input[name='brand']:checked"),function()
			{
				fav.push($(this).val());
			});
			var bb = "'";
			bb+=fav[0];
			bb+="'";
			for (var i = 1; i < fav.length; i++) {
				bb+=",'";
				bb+=fav[i];
				bb+="'";
			}
			var quer = "";
			if(fav.length==0)
			{
				quer = "select * from products where subcatid = <?php echo($subcat) ?>";
			}
			else
			{
				quer = "select * from products where subcatid = <?php echo($subcat) ?> and brand in ("+bb+")";
			}
			
			$.ajax({

				type : 'POST',
				url : 'shopping_content.php',
				data : {

					brand : quer,
					tt : <?php echo $subcat; ?>

				},
				success : function(data)
				{
					$(".content").hide().html(data).fadeIn(500);
				}

			});
		});
</script>