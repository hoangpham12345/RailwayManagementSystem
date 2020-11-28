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
      $from = $_GET['from_station'];
      $to = $_GET['to_station'];
      $route = unserialize($_GET['route']);
      // print_r($route);
      $name = $_GET['passenger_name'];
      $phone = $_GET['passenger_phone'];
      echo "<p>So you wanna go from $from to $to</p>";
      echo "<p>And you wanna take the train ". $route->trainName . " from " . $route->startTime . " to " . $route->endTime . "</p>";
      echo "<p>The sequence numbers are " . $route->startSeq . " - " . $route->endSeq . "</p>";
      echo "<p>Your name is $name and we will contact your $phone to confirm later or not</p>";
    ?>
    <h2>Thank you for using our service</h2>
  </body>
</html>
