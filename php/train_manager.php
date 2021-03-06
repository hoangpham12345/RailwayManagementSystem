<?php
  function getCurrentTime() {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    return time();
    // return mktime(2,20,0,11,23,2020);0
  }

  function getTrainLoc($trainID){
    global $con;
    $query = "SELECT * FROM schedule WHERE train = '$trainID' ORDER BY sequence_number";
    $result = mysqli_query($con, $query);
    $stationA = null;
    $stationB = null;
    $timeA = null;
    $timeB = null;
    $currentTime = getCurrentTime();
    // echo date("H:i:s", $currentTime)  . "\n";
    while($row = mysqli_fetch_array($result)){
      $timein = strtotime($row['time_in']);
      $timeout = strtotime($row['time_out']);
      // echo " timein: " . date("H:i:s", $timein) . " timeout: " . date("H:i:s", $timeout) . "\n";
      if($currentTime < $timein){
        $stationB = $row['station'];
        $timeB = $timein;
        break;
      }
      $stationA = $row['station'];
      $timeA = $timein;
      if($currentTime < $timeout){
        $stationB = $row['station'];
        $timeB = $timeout;
        break;
      }
      $timeA = $timeout;
    }
    $lerp = ($currentTime - $timeA) / ($timeB - $timeA);
    if($stationB == null){
      $stationB = $stationA;
    }
    if($stationA == null){
      $stationA = $stationB;
    }
    if($stationA == $stationB)
      $lerp = 1;
    $trainLoc = array("trainID"=>$trainID, "stationA"=>$stationA, "stationB"=>$stationB, "lerp"=>$lerp);
    return $trainLoc;
  }

  function getTrainStatus($con, $trainID){
    $query = "SELECT * FROM schedule WHERE train = '$trainID' ORDER BY sequence_number";
    $result = mysqli_query($con, $query);
    $stationA = null;
    $stationB = null;
    $currentTime = getCurrentTime();
    while($row = mysqli_fetch_array($result)){
      $timein = strtotime($row['time_in']);
      $timeout = strtotime($row['time_out']);
      if($currentTime < $timein){
        $stationB = $row['station'];
        break;
      }
      $stationA = $row['station'];
      if($currentTime < $timeout){
        $stationB = $row['station'];
        break;
      }
    }
    $status = $stationA == $stationB ? 'Waiting' : 'Running';
    if($stationB == null){
      $status = 'Stopped';
      $stationB = $stationA;
    }
    if($stationA == null){
      $status = 'Stopped';
      $stationA = $stationB;
    }
    return array($status, $stationA, $stationB);
  }
?>
