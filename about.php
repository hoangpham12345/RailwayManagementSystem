<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Railway Management System</title>
		<link rel="icon" type="image/png" href="images/icon.svg"></link>
		<link rel="stylesheet" type="text/css" href="stylesheet/rms.css"></link>
		<link rel="stylesheet" type="text/css" href="stylesheet/about.css"></link>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.10.2/p5.js"></script>
	</head>
	<body>

		<?php require_once('header.php');?>

		<div class="mapouter">
			<div class="gmap_canvas">
				<!-- <iframe width="400" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=international%20university&t=&z=13&ie=UTF8&iwloc=&output=embed"  generated code -->
				<iframe width="400" height="400" id="gmap_canvas" src="https://www.google.com/maps/embed?origin=mfe&pb=!1m3!2m1!1sinternational+university!6i16" 
					frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
			</div>
		</div>
		
		<?php require_once('footer.php');?>

	</body>
</html>
