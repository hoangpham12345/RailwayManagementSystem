<?php
  $from = $_POST['from_station'];
  $to = $_POST['to_station'];
  $route = unserialize($_POST['route']);
  $name = $_POST['passenger_name'];
  $phone = $_POST['passenger_phone'];
  $date = $_POST['date'];

  include_once("database_connect.php");

  $query = "SELECT name FROM station WHERE id = '$from'";
  $result = mysqli_query($con, $query);
  if($row = mysqli_fetch_array($result))
    $fromName = $row['name'];
  $query = "SELECT name FROM station WHERE id = '$to'";
  $result = mysqli_query($con, $query);
  if($row = mysqli_fetch_array($result))
    $toName = $row['name'];

  $query = "SELECT * FROM booking WHERE date = '$date' AND train = '$route->trainID' AND (start_sn < '$route->endSeq' AND end_sn > '$route->startSeq')";
  $result = mysqli_query($con, $query);
  $numSeats = 72;
  $numCoachs = 24;
  $currentCoach = 1;
  $currentSeat = 0;
  while($row = mysqli_fetch_array($result)){
    $usedCoach = $row['coach'];
    $usedSeat = $row['seat'];
    if($currentCoach < $usedCoach){
      $currentCoach = $usedCoach;
      $currentSeat = $usedSeat;
    }
    if($currentSeat < $usedSeat)
      $currentSeat = $usedSeat;
  }
  $currentSeat ++;
  if($currentSeat > $numSeats){
    $currentSeat = 1;
    $currentCoach ++;
    if($currentCoach > $numCoachs){
      // REQUEST MORE COACH
    }
  }

  $trainID = $route->trainID;
  $trainName = $route->trainName;
  $startTime = $route->startTime;
  $endTime = $route->endTime;
  $startSeq = $route->startSeq;
  $endSeq = $route->endSeq;
  $trainID = $route->trainID;
  $trainName = $route->trainName;

  $query = "INSERT INTO booking (date, r_from, r_to, coach, seat, train, start_sn, end_sn, passenger_name, passenger_tel) VALUES ".
                               "('$date', '$from', '$to', $currentCoach, $currentSeat, '$trainID', $startSeq, $endSeq, '$name', '$phone');";
  $result = mysqli_query($con, $query);

  $heading = "Location: ../ticket.php?fromName=$fromName&toName=$toName&from=$from&to=$to" .
  "&date=$date&startTime=$startTime&endTime=$endTime" .
  "&trainID=$trainID&trainName=$trainName" .
  "&seat=$currentSeat&coach=$currentCoach&startSeq=$startSeq&endSeq=$endSeq" .
  "&name=$name&tel=$phone";
  header($heading);
  exit();
?>
