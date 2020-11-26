<?php
  require_once('database_connect.php');
  $query = "SELECT * FROM track";
  $result = mysqli_query($con, $query);
  $data = array();
  while($row = mysqli_fetch_array($result)){
    array_push($data, array('s1'=>$row['station_a'], 's2'=>$row['station_b']));
  }
  echo json_encode($data);
?>
