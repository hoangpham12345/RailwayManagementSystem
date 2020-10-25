<?php
	require_once('php/connection_var.php');
	$con = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);
	if(!$con){
		echo "Can't create connection";
		return;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Railway Management System</title>
		<link rel="icon" href="images/icon.svg"></link>
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
			<div id="usertab">
				<table>
					<tr>
						<th id='searchtabnav' class="selected">SEARCH</th>
						<th id='booktabnav'>BOOK</th>
					</tr>
				</table>
			</div>

			<div id="searchtab">
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
								global $con;
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

			<form id="booktab" class="hiding" onsubmit="alert('Not implemented yet!');">
				<table>
					<tr>
						<td>From Station</td>
						<td>
							<select id="from_station_field" name="from_station">
								<?php
									function stationOptions(){
										global $con;
										$query = "SELECT * FROM station";
										$result = mysqli_query($con, $query);
										while($row = mysqli_fetch_array($result)){
											$stationID = $row['id'];
											$stationName = $row['name'];
											echo "<option>$stationID ($stationName)</option>";
										}
									}
									stationOptions();
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>To Station</td>
						<td>
							<select id="to_station_field" name="to_station">
								<?php
									stationOptions();
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Train</td>
						<td>
							<select id="train_field" name="train">
								<?php
									function findTrains(){
										global $con;
										$query = "SELECT * FROM train";
										$result = mysqli_query($con, $query);
										while($row = mysqli_fetch_array($result)){
										 	$trainID= $row['id'];
											$trainName = $row['name'];
											echo "<option>$trainID ($trainName)</option>";
										}
									}
									findTrains();
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Date</td>
						<td><input type="date" name="date" id="date_field"></td>
					</tr>
					<tr>
						<td>Coach Number</td>
						<td><input type="number" min="1" name="coach" id="coach_field"></td>
					</tr>
					<tr>
						<td>Seat Number</td>
						<td><input type="number" min="1" name="seat" id="seat_field"></td>
					</tr>
					<tr>
						<td>Passenger Name</td>
						<td><input type="text" name="passenger_name" id="passenger_name_field"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center"><input type="submit" value="Book"></td>
					</tr>
				</table>
			</form>
		</div>

    <canvas id="map" width="600px" height="600px"></canvas>

    <?php require_once('footer.php'); ?>

	</body>
</html>
