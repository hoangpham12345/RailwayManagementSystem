<?php
  require_once('database_connect.php');
?>

<div id='schedule_traindesc'>
  <table>
    <tr>
      <th id='backbutton'><a></a></th>
      <th><image src='images/trainicon.svg'></th>
      <?php
        function loadHeading(){
          global $con;
          $trainID = $_REQUEST['trainid'];
          $query = "SELECT name FROM train WHERE id = '$trainID';";
          $result = mysqli_query($con, $query);
          if(!$result){
            echo mysqli_error($con);
            return;
          }
          require_once("train_manager.php");
          if($row = mysqli_fetch_array($result)){
            $trainName = $row['name'];
            $trainStatus = getTrainStatus($con, $trainID);
            echo "<th>$trainID</th>";
            echo "<th>$trainName</th>";
            echo "<th>$trainStatus[0]</th>";
            echo "<th>$trainStatus[1] - $trainStatus[2]</th>";
          }
        }
        loadHeading();
       ?>
    </tr>
  </table>
</div>
<div id='trains-schedulelist' class="listtable scrollpane heightB">
  <table>
    <tr>
     <th>Station</th>
     <th>Sequence</th>
     <th>ID</th>
     <th>Name</th>
     <th>Time in</th>
     <th>Time out</th>
    </tr>
    <?php
      function load(){
        global $con;
        $trainID = $_REQUEST['trainid'];
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
</div>
