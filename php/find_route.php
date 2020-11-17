<?php
  require_once('database_connect.php');

  function allTrains(){
    global $con;
    $query = "SELECT * FROM train";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)){
      $trainID= $row['id'];
      $trainName = $row['name'];
      echo "<option>$trainID ($trainName)</option>";
    }
  }

  function validTrains(){
    $fromStation = $_REQUEST['fromstation'];
    $toStation = $_REQUEST['tostation'];
    $startTrain = null;
    $startSequence = null;
    $startTime = null;
    global $con;
    $query = "SELECT * FROM schedule, train WHERE schedule.train = train.id ORDER BY train, sequence_number";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)){
      $train = $row['train'];
      $sequence = $row['sequence_number'];
      $station = $row['station'];
      if ($station == $fromStation) {
        $startTrain = $train;
        $startSequence = $sequence;
        $startTime = substr($row['time_out'], 0,  5);
      }
      if ($station == $toStation && $train == $startTrain) {
        $endTime = substr($row['time_in'], 0, 5);
        $trainName = $row['name'];
        echo "<option>[$startTime] - [$endTime] Train: $startTrain ($trainName)</option>";
        $startTrain = null;
        $startSequence = null;
        $startTime = null;
      }

    }
  }

  validTrains();
?>
