<?php 
  require_once('database_connect.php');
  if (!($result = mysqli_query($con, $_GET['q']))){
    echo("Error: " . mysqli_error($con));
    mysqli_close($con);
    return;
  }
  $n = 0;     // number of columns retrieved
  echo '<table id="result_table">';
  echo '<tr id="result_table_header">';
  while ($field = mysqli_fetch_field($result)){
    $fname = $field->name;
    echo '<td>' . $fname . '</td>';
    $n++;
  }
  echo '</tr class="result_row">';
  while ($row = mysqli_fetch_array($result)){
    echo '<tr class="result_table_data">';
    for($i = 0; $i <$n; $i++){
      echo '<td>' . $row[$i] . '</td>';
    }
    echo '</tr>';
  }
  echo '</table>';
  mysqli_free_result($result);
  mysqli_close($con);
?>