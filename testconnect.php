<?php
  $con = mysqli_connect("127.0.0.1:51110","azure","6#vWHD_$");    //for azure
   // $con = mysqli_connect("localhost","root","");    //for localhost
   if (!$con)
   {
    die('Could not connect: ' . mysql_error());
   }
   else
   {
    echo "Congrats! connection established successfully";
   }
   mysqli_close($con);
 ?>
