<?php
  require_once('database_connect.php');
  require_once('train_manager.php');
  
  $query = "SELECT * FROM train";
  $result = mysqli_query($con, $query);

  $data = array();
  while($row = mysqli_fetch_array($result)){
    array_push($data, getTrainLoc($row['id']));
  }
  echo json_encode($data);
?>
