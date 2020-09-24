<?php
  require_once('database_var.php');
  $con = mysqli_connect($server, $username, $password, $database);
  if ($con){
    $query = "SELECT * FROM station";
    $result = mysqli_query($con, $query) or die('Error querying database.');
    while ($row = mysqli_fetch_array($result)){
      $id = $row['id'];
      $name = $row['NAME'];
      echo $id . " " . $name . '<br/>';
    }
  }
  mysqli_close($con);
?>
