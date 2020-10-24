<?php require_once('php/connection_var.php'); ?>
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

			<form id="booktab" class="hiding" onsubmit="alert('Not implemented yet!');">
				<table>
					<tr>
						<td>From Station</td>
						<td>
							<input list="from_station_list" name="from_station" id="from_station_field">
						  <datalist id="from_station_list">
						    <option value="A01">
						    <option value="A02">
						    <option value="A03">
						    <option value="A04">
						    <option value="A05">
						  </datalist>
						</td>
					</tr>
					<tr>
						<td>To Station</td>
						<td>
							<input list="to_station_list" name="to_station" id="to_station_field">
						  <datalist id="to_station_list">
						    <option value="B01">
						    <option value="B02">
						    <option value="B03">
						    <option value="B04">
						    <option value="B05">
						  </datalist>
						</td>
					</tr>
					<tr>
						<td>Train</td>
						<td>
							<input list="avai_train_list" name="train" id="train_field">
						  <datalist id="avai_train_list">
						    <option value="TA01">
						    <option value="TB02">
						    <option value="TA05">
						    <option value="TC02">
						  </datalist>
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
