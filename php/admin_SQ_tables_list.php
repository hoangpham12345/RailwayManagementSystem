<?php 
  require_once('database_connect.php');
  if (!($result = mysqli_query($con, $_GET['q']))){
    echo("Error: " . mysqli_error($con));
    mysqli_close($con);
    return;
  }
  $n = 0;     // number of columns retrieved
  echo '<ul id="database_tables_list">';
  while ($row = mysqli_fetch_array($result)){
      // echo '<li class ="database_table">' . strtoupper($row[0]) . '</li>';
      echo '<li class ="database_table">' . $row[0] . '</li>';
  }
  echo '</ul>';
  mysqli_free_result($result);
  mysqli_close($con);
?>