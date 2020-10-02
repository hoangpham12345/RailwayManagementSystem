<?php
  require_once('database_var.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Railway Management System</title>
		<link rel="icon" href="images/icon.svg"></link>
		<link rel="stylesheet" type="text/css" href="stylesheet/rms.css"></link>
		<link rel="stylesheet" type="text/css" href="stylesheet/booking.css"></link>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.10.2/p5.js"></script>
		<script>$(function(){$("#visual-header").load("header.html")});</script>
		<script>$(function(){$("#visual-footer").load("footer.html")});</script>
		<script src="scripts/map.js"></script>
		<script src="scripts/map_sql_generator.js"></script>
		<script>window.onload = RailMap.setup;</script>
	</head>
	<body>
		<header id="top">
			<div id="visual-header"></div>
		</header>
		<section>
		   <canvas id="map" width="600px" height="600px">
		</section>
		<footer>
			<div id="visual-footer"></div>
		</footer>
	</body>
</html>
