<?php
	require_once('php/database_connect.php');
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

		<div class="centerEl">
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
			    <div id="trainlist" class="listtable scrollpane heightA">
			  		<table>
			        <tr>
			         <th>Train</th>
			  		   <th>ID</th>
			   		   <th>Name</th>
			   		   <th>Status</th>
			   		   <th>Current Track</th>
			        </tr>
							<?php
								require_once("php/train_manager.php");
								function loadTrains(){
									global $con;
									$query = "SELECT * FROM train";
									$result = mysqli_query($con, $query);

									while($row = mysqli_fetch_array($result)){
										$trainID = $row['id'];
										$trainName = $row['name'];
										$trainStatus = getTrainStatus($con, $trainID);
										echo "<tr>";
										echo "<td><image src='images/trainicon.svg'></td>";
										echo "<td>$trainID</td>";
										echo "<td>$trainName</td>";
										echo "<td>$trainStatus[0]</td>";
										echo "<td>$trainStatus[1] - $trainStatus[2]</td>";
										echo "</tr>";
									}
								}
								loadTrains();
							?>
			  		</table>
			    </div>

					<div id="schedulelist"></div>
				</div>

				<form id="booktab" class="hiding" action="php/process_booking.php" method="post">
					<table>
						<tr>
							<td colspan="2" class="title">START & END</td>
						</tr>

						<tr>
							<td>From Station</td>
							<td>
								<select id="from_station_field" name="from_station" required>
									<?php
										function stationOptions(){
											global $con;
											$query = "SELECT * FROM station";
											$result = mysqli_query($con, $query);
											while($row = mysqli_fetch_array($result)){
												$stationID = $row['id'];
												$stationName = $row['name'];
												echo "<option value='$stationID'>$stationID ($stationName)</option>";
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
								<select id="to_station_field" name="to_station" required>
									<?php
										stationOptions();
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td colspan="2" style="text-align: center"><input type="button" id="findroutebtn" value="Find Route"></td>
						</tr>

						<tr>
							<td colspan="2" class="title">TRAIN & DATE</td>
						</tr>

						<tr>
							<td>Train</td>
							<td>
								<select id="route_field" name="route" required>
								</select>
							</td>
						</tr>
						<tr>
							<td>Date</td>
							<?php
								$tomorrow = date('Y-m-d');
								echo "<td><input type='date' name='date' id='date_field' min='$tomorrow' required></td>";
							?>
						</tr>

						<tr>
							<td colspan="2" class="title">PASSENGER INFO</td>
						</tr>

						<tr>
							<td>Your Name</td>
							<td><input type="text" name="passenger_name" id="passenger_name_field" placeholder="Ex: Jack" required></td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td><input type="tel" name="passenger_phone" id="passenger_phone_field" placeholder="Ex: 0796940493" pattern="0{1}[0-9]{9}" required></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center"><input type="submit" value="Book"></td>
						</tr>
					</table>
				</form>
			</div>
	    <canvas id="map" width="600px" height="600px"></canvas>
		</div>

    <?php require_once('footer.php'); ?>

	</body>
</html>
