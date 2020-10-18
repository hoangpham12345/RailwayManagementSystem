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
		<script src="scripts/booking.js"></script>
	</head>
	<body>

    <?php require_once('header.php'); ?>

		<div id="leftinfo">
	    <div id="trainlist" class="listtable scrollpane">
	  		<table>
	        <tr>
	         <th></th>
	  		   <th>ID</th>
	   		   <th>Name</th>
	   		   <th>Status</th>
	   		   <th>Next</th>
	        </tr>
					<?php
						function loadTrains(){
			      	$con = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);
							if(!$con){
								echo "Can't create connection";
								return;
							}

							$query = "SELECT * FROM train";
							$result = mysqli_query($con, $query);

							while($row = mysqli_fetch_array($result)){
								$trainID = $row['id'];
								$trainName = $row['name'];
								echo "<tr>";
								echo "<td><image src='images/trainicon.svg'></td>";
								echo "<td>$trainID</td>";
								echo "<td>$trainName</td>";
								echo "<td>Unknown</td>";
								echo "<td>Unknown</td>";
								echo "</tr>";
							}
						}
						loadTrains();
					?>
	  		</table>
	    </div>

			<div id="schedulelist"></div>
		</div>

    <canvas id="map" width="600px" height="600px"></canvas>

    <?php require_once('footer.php'); ?>

	</body>
</html>
