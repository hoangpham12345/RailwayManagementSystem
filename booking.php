<?php require_once('connection_var.php'); ?>
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
		<script src="scripts/map.js"></script>
		<script src="scripts/map_sql_generator.js"></script>
		<script>window.onload = RailMap.setup;</script>
	</head>
	<body>

    <?php require_once('header.php'); ?>

    <div id="trainlist">
  		<table>
        <tr>
         <th></th>
  		   <th>ID</th>
   		   <th>Name</th>
   		   <th>Status</th>
   		   <th>Next</th>
        </tr>
        <tr>
         <td><image src="images/trainicon.svg"></td>
   		   <td>A</td>
  		   <td>Train 1</td>
   		   <td>Running</td>
   		   <td>California</td>
        </tr>
        <tr>
         <td><image src="images/trainicon.svg"></td>
   		   <td>B</td>
  		   <td>Train 2</td>
   		   <td>Running</td>
   		   <td>Las Vegas</td>
        </tr>
        <tr>
         <td><image src="images/trainicon.svg"></td>
   		   <td>C</td>
  		   <td>Train 3</td>
   		   <td>Waiting</td>
   		   <td>Oregon</td>
        </tr>
  		</table>
    </div>
    <canvas id="map" width="600px" height="600px"></canvas>

    <?php require_once('footer.php'); ?>

	</body>
</html>
