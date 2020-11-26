<?php
  require_once('database_connect.php');
  $query = "SELECT * FROM station";
  $result = mysqli_query($con, $query);
  $data = array();
  while($row = mysqli_fetch_array($result)){
    $data[$row['id']] = $row['name'];
  }
  echo json_encode($data);
?>
