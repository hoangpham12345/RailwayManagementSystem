<?php
  // for testing in local
  function local_var(){
    define('SERVER', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'localdb');
  }

  //for using in Azure
  function server_var(){
    define('SERVER', '127.0.0.1:51119');
    define('USERNAME', 'azure');
    define('PASSWORD', '6#vWHD_$');
    define('DATABASE', 'localdb');
  }

  // local_var();
  server_var();

  $con = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);

  if(!$con){
    echo "Can't create connection";
  }
?>
