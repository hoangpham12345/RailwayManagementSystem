<table>
  <tr>
   <th></th>
   <th>Sequence</th>
   <th>ID</th>
   <th>Name</th>
   <th>Time in</th>
   <th>Time out</th>
  </tr>

  <?php
    function load(){
      $trainID = $_REQUEST['trainid'];

      require_once('connection_var.php');
      $con = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);
      if(!$con){
        echo "Can't create connection";
        return;
      }

      $query = "SELECT sequence_number, station.id AS id, station.name AS name, time_in, time_out FROM schedule, station WHERE schedule.train = '$trainID' AND schedule.station = station.id ORDER BY sequence_number;";
      $result = mysqli_query($con, $query);

      if(!$result){
        echo mysqli_error($con);
        return;
      }

      while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td><image src='images/railstation.svg'></td>";
        echo "<td>" . $row['sequence_number'] . "</td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['time_in'] . "</td>";
        echo "<td>" . $row['time_out'] . "</td>";
        echo "</tr>";
      }
    }

    load();
  ?>

</table>
