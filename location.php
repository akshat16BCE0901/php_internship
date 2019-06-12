<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
	<p id="demo"></p>
</body>
<script>
	var x = document.getElementById("demo");
	var url = "";
	function getLocation() {
	  if (navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(showPosition);
	  } else {
	    x.innerHTML = "Geolocation is not supported by this browser.";
	  }
	}
	function showPosition(position) {
	  x.innerHTML = "Latitude: " + position.coords.latitude + 
	  "<br>Longitude: " + position.coords.longitude;
	  var url = "http://maps.googleapis.com/maps/api/geocode/json?latlng="+position.coords.latitude+","+position.coords.longitude+"&sensor=true";
	  console.log(url);
	}
	getLocation();

</script>
</html>