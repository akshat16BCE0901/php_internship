<div class="main-page">
			<div class="col_3">
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-dollar icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>$452</strong></h5>
                      <span>Total Revenue</span>
                    </div>
                </div>
        	</div>
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php

                      	$result = mysqli_query($conn,"select count(*) from login");
                      	if($result)
                      	{
                      		$row = mysqli_fetch_array($result);
                      		echo $row[0];
                      	}

                       ?></strong></h5>
                      <span>Registrations</span>
                    </div>
                </div>
        	</div>
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-money user2 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>$1012</strong></h5>
                      <span>Expenses</span>
                    </div>
                </div>
        	</div>
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php

                      	$result = mysqli_query($conn,"select count(distinct(user_id)) from producthead");
                      	if($result)
                      	{
                      		$row = mysqli_fetch_array($result);
                      		echo $row[0];
                      	}

                       ?></strong></h5>
                      <span>Distinct Visitors</span>
                    </div>
                </div>
        	 </div>
        	<div class="col-md-3 widget">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php

                      	$result = mysqli_query($conn,"select count(*) from producthead");
                      	if($result)
                      	{
                      		$row = mysqli_fetch_array($result);
                      		echo $row[0];
                      	}

                       ?></strong></h5>
                      <span>Page Visits</span>
                    </div>
                </div>
        	 </div>
        	<div class="clearfix"> </div>
			</div>
		
			<div class="row-one widgettable">
				<div class="col-md-7 content-top-2 card">
					<div class="agileinfo-cdr">
						<div class="card-header">
	                        <h3>Weekly Sales</h3>
	                    </div>
						
							<div id="Linegraph" style="width: 98%; height: 350px">
							</div>
							
					</div>
				</div>
				<div class="col-md-3 stat">
					<div class="content-top-1">
					<div class="col-md-6 top-content">
						<h5>Invoice Amount remaining</h5>
						<label><?php 

							$result = mysqli_query($conn,'select ((select sum(amount) from invoice)-(select sum(amountpaid) from invoicedetails)) as remaining from dual');
	                      	if($result) 
	                      	{
	                      		$row = mysqli_fetch_array($result);
	                      		echo $row[0];
	                      	} ?></label>
					</div>
					<div class="col-md-6 top-content1">	   
						<div id="demo-pie-1" class="pie-title-center" data-percent="<?php

	                      	$result = mysqli_query($conn,'select round(((select ((select sum(amount) from invoice)-(select sum(amountpaid) from invoicedetails)) as remaining from dual)/(select sum(amount) from invoice))*100) as fraction from dual');
	                      	if($result) 
	                      	{
	                      		$row = mysqli_fetch_array($result);
	                      		echo $row[0];
	                      	}

	                       ?>"> <span class="pie-value"></span> </div>
					</div>
					 <div class="clearfix"> </div>
					</div>
					<div class="content-top-1">
						<h3 align="center">Reviews</h3>
						<br>
						<div class="col-md-6 top-content1">	   
							<div class="fb-like" data-href="https://www.facebook.com/SIAMVIT/" data-width="100" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
						</div>
					 <div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-2 stat">
					<div class="content-top">
						<div class="top-content facebook">
							<a href="#"><i class="fa fa-facebook"></i></a>
						</div>
						<ul class="info">
							<li class="col-md-6"><b>1,296</b><p>Friends</p></li>
							<li class="col-md-6"><b>647</b><p>Likes</p></li>
							<div class="clearfix"></div>
						</ul>
					</div>
					<div class="content-top">
						<div class="top-content twitter">
							<a href="#"><i class="fa fa-twitter"></i></a>
						</div>
						<ul class="info">
							<li class="col-md-6"><b>1,997</b><p>Followers</p></li>
							<li class="col-md-6"><b>389</b><p>Tweets</p></li>
							<div class="clearfix"></div>
						</ul>
					</div>
					<div class="content-top">
						<div class="top-content google-plus">
							<a href="#"><i class="fa fa-google-plus"></i></a>
						</div>
						<ul class="info">
							<li class="col-md-6"><b>1,216</b><p>Followers</p></li>
							<li class="col-md-6"><b>321</b><p>shares</p></li>
							<div class="clearfix"></div>
						</ul>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
				
				<div class="charts">
					<div class="col-md-4 charts-grids widget">
						<div class="card-header">
							<h3>Bar chart</h3>
						</div>
						
						<div id="container" style="width: 100%; height:270px;">
							<canvas id="canvas"></canvas>
						</div>
						<button id="randomizeData">Randomize Data</button>
						<button id="addDataset">Add Dataset</button>
						<button id="removeDataset">Remove Dataset</button>
						<button id="addData">Add Data</button>
						<button id="removeData">Remove Data</button>
						
					</div>
					
					<div class="col-md-4 charts-grids widget states-mdl">
						<div class="card-header">
							<h3>Column & Line Graph</h3>
						</div>
						<div id="chartdiv"></div>
					</div>
			
					<div class="clearfix"> </div>
				</div>
				
	
		<!-- for amcharts js -->
			<script src="js/amcharts.js"></script>
			<script src="js/serial.js"></script>
			<script src="js/export.min.js"></script>
			<link rel="stylesheet" href="css/export.css" type="text/css" media="all" />
			<script src="js/light.js"></script>
		<!-- for amcharts js -->

    		<script  src="js/index1.js"></script>
	
			<div class="charts">		
			<div class="mid-content-top charts-grids">
				<div class="middle-content">
						<h4 class="title">Carousel Slider</h4>
					<!-- start content_slider -->
					<div id="owl-demo" class="owl-carousel text-center">
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider1.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider2.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider3.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider4.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider5.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider6.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider7.jpg" alt="name">
						</div>
						
					</div>
				</div>
					<!--//sreen-gallery-cursual---->
			</div>
		</div>
		
		<div class="col_1">
			
			<div class="clearfix"> </div>
			
				</div>
				
			</div>
<script type="text/javascript">
	$(document).ready(function()
	{
		$(".disanchor").click(function()
		{
			var link  = $(this).attr("hef");
			$.ajax({

				type : 'POST',
				url : link,
				data : {



				},
				success : function(data)
				{
					$("#page-wrapper").html(data);
				}

			});
		});
		$(".masteranchor").click(function()
	      {
	        var link  = $(this).attr("hef");
	        
	          $.ajax({

	            type : 'POST',
	            url : link,
	            data : {



	            },
	            success : function(data)
	            {
	              $("#page-wrapper").html(data);
	            }

	          });
	      });
	});
</script>
