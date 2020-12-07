<?php
  $fromName = $_GET['fromName'];
  $toName = $_GET['toName'];
  $from = $_GET['from'];
  $to = $_GET['to'];
  $date = $_GET['date'];
  $startTime = $_GET['startTime'];
  $endTime = $_GET['endTime'];
  $trainID = $_GET['trainID'];
  $trainName = $_GET['trainName'];
  $seat = $_GET['seat'];
  $coach = $_GET['coach'];
  $startSeq = $_GET['startSeq'];
  $endSeq = $_GET['endSeq'];
  $name = $_GET['name'];
  $tel = $_GET['tel'];
?>
<html>
  <head>
		<meta charset="utf-8">
    <title>TICKET</title>
		<link rel="icon" type="image/png" href="images/icon.svg"></link>
		<link rel="stylesheet" type="text/css" href="stylesheet/ticket.css"></link>
  </head>
  <body>
    <h1>YOUR BOOKING WAS SUCCESSFUL</h1>
    <table>
      <tr>
        <th colspan = "4">
          <?php echo "<p> TRAIN TICKET </p>";?>
        </th>
      </tr>
      <tr>
        <td colspan="4" id="fromto">
          <?php echo "<p>$fromName ($from) - $toName ($to)</p>";?>
        </td>
      </tr>
      <tr>
        <td colspan="2" id="date">
          <?php echo "<p>$date</p>";?>
        </td>
        <td colspan="2" id="time">
          <?php echo "<p>". $startTime . " - " . $endTime . "</p>";?>
        </td>
      </tr>
      <tr>
        <td colspan="4" id="train">
          <?php echo "<p> TRAIN : " . $trainName . " (" . $trainID . ") </p>"?>
        </td>
      </tr>
      <tr>
        <td colspan="1" id="seat">
          <?php echo "<p> Seat Number : " . $seat . "</p>"?>
        </td>
        <td colspan="1" id="coach">
          <?php echo "<p> Coach Number : " . $coach . "</p>"?>
        </td>
        <td colspan="2" id="seq">
          <?php echo "<p> Sequence Numbers : " . $startSeq . " - " . $endSeq . "</p>"?>
        </td>
      </tr>
      <tr>
        <td colspan="2" id="passenger_name">
          <?php echo "<p>Passenger Name : $name</p>"?>
        </td>
        <td colspan="2" id="passenger_tel">
          <?php echo "<p>Passenger Tel : $tel</p>"?>
        </td>
      </tr>
    </table>
    <h2>Thank you for using our service</h2>
    <div id="backoption">
      <a href="booking.php">Back to booking page</a>
      <br>
      <a href="index.php">Back to home page</a>
    </div>
  </body>
</html>
