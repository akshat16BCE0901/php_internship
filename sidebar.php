<div class="sidebar">
 	<?php

 		$query = "select * from subcategories where maincategory=$cat";
 		$result = mysqli_query($conn,$query);
 		if($result)
 		{
 			while($row = mysqli_fetch_array($result))
 			{
 				echo "<a style='cursor:pointer;' class='show_products' golink=".$row[0].">".$row[1]."</a>";
 			}
 		}

 	?>
 	<br>
 	<div class="brands">
 		
 	</div>
</div>