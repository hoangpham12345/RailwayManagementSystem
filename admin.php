<?php
  require_once('php/authorize.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" charset="utf-8">
		<title>Railway Management System</title>
		<link rel="icon" href="images/icon.svg"></link>
    <link rel="stylesheet" type="text/css" href="stylesheet/admin.css"></link>
  </head>
  <body>
    <?php
      require_once('header.php');

      require_once('connection_var.php');
      if(isset($_POST['query']) &&!empty($_POST['query'])){
        $query = $_POST['query'];
      }
      $con = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);


      echo '<div id="query_panel">';
        echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '"';
          echo '<label for="query">Enter the SQL query</label><br>';
          echo '<textarea id="query" name="query" rows="5" cols="100">' . $query . '</textarea><br>';
          //echo '<textarea id="query" name="query" rows="5" cols="100"></textarea><br>';
          echo '<input type="submit" value="GO">';
        echo '</form>';
        if ($con){
          if(isset($query) &&!empty($query)){
            if (!($result = mysqli_query($con, $query))){
             echo("Error" . mysqli_error($con));
             mysqli_close($con);
            }
            $n = 0;     // number of columns retrieved
            echo '<table id="result_table">';
            echo '<tr>';
            while ($field = mysqli_fetch_field($result)){
              $fname = $field->name;
              echo '<td>' . $fname . '</td>';
              $n++;
            }
            echo '</tr>';
            while ($row = mysqli_fetch_array($result)){
              echo '<tr>';
              for($i = 0; $i <$n; $i++){
                echo '<td>' . $row[$i] . '</td>';
              }
              echo '</tr>';
            }
            echo '</table>';
            mysqli_free_result($result);
            mysqli_close($con);
          }
        }
      echo '</div>';

      require_once('footer.php');
    ?>
  </body>
</html>
