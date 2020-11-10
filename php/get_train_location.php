<?php
  function connect(){
    global $con;
    require_once('connection_var.php');
    $con = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);
    if(!$con){
      echo "Can't create connection";
      return;
    }
  }
  connect();
?>

<?php
  function getTrainLoc($trainID){
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    global $con;
    $query = "SELECT * FROM schedule WHERE train = '$trainID' ORDER BY sequence_number";
    $result = mysqli_query($con, $query);
    $stationA = null;
    $stationB = null;
    $timeA = null;
    $timeB = null;
    $currentTime = time();
    while($row = mysqli_fetch_array($result)){
      $timein = strtotime($row['time_in']);
      $timeout = strtotime($row['time_out']);
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
      }
      $timeA = $timeout;
    }
    $lerp = ($currentTime - $timeA) / ($timeB - $timeA);
    if($stationA == $stationB)
      $lerp = 1;
    $trainLoc = array("trainID"=>$trainID, "stationA"=>$stationA, "stationB"=>$stationB, "lerp"=>$lerp);
    return $trainLoc;
  }

  $query = "SELECT * FROM train";
  $result = mysqli_query($con, $query);

  $data = array();
  while($row = mysqli_fetch_array($result)){
    array_push($data, getTrainLoc($row['id']));
  }
  echo json_encode($data);
?>
