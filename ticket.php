<?php
  $from = $_POST['from_station'];
  $to = $_POST['to_station'];
  $route = unserialize($_POST['route']);
  $name = $_POST['passenger_name'];
  $phone = $_POST['passenger_phone'];
  $date = $_POST['date'];

  include_once("php/database_connect.php");
  $query = "INSERT INTO booking (date, r_from, r_to, coach, seat, train, start_sn, end_sn, passenger_name, passenger_tel) VALUES ".
                               "('$date', '$from', '$to', 1, 1, '$route->trainID', $route->startSeq, $route->endSeq, '$name', '$phone');";
  $result = mysqli_query($con, $query);
?>

<html>
  <head>
		<meta charset="utf-8">
    <title>TICKET</title>
		<link rel="icon" type="image/png" href="images/icon.svg"></link>
		<link rel="stylesheet" type="text/css" href="stylesheet/rms.css"></link>
		<link rel="stylesheet" type="text/css" href="stylesheet/ticket.css"></link>
  </head>
  <body>
    <h1>YOUR BOOKING WAS SUCCESSFUL</h1>
    <?php
      echo "<p>So you wanna go from $from to $to</p>";
      echo "<p>On date $date</p>";
      echo "<p>And you wanna take the train ". $route->trainName . " from " . $route->startTime . " to " . $route->endTime . "</p>";
      echo "<p>The sequence numbers are " . $route->startSeq . " - " . $route->endSeq . "</p>";
      echo "<p>Your name is $name and we will contact your $phone to confirm later</p>";
      // echo "<p>Query: $query</p>";
      // echo "<p>Result: $result</p>";
      if(!$result){
        $erro = mysqli_error($con);
        echo "<p>Error: $erro</p>";
      }
    ?>
    <h2>Thank you for using our service</h2>
  </body>
</html>
