<?php
  require_once('database_connect.php');

  function findTrains(){
    global $con;
    $query = "SELECT * FROM train";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)){
      $trainID= $row['id'];
      $trainName = $row['name'];
      echo "<option>$trainID ($trainName)</option>";
    }
  }
  findTrains();
?>
