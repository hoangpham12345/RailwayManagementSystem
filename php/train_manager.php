<?php
  function getTrainStatus($con, $trainID){
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $query = "SELECT * FROM schedule WHERE train = '$trainID' ORDER BY sequence_number";
    $result = mysqli_query($con, $query);
    $stationA = null;
    $stationB = null;
    $currentTime = time();
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
    return array($status, $stationA, $stationB);
  }
?>
