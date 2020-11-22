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
    <script src="scripts/admin_util.js"></script>
  </head>
  <body>
    <?php require_once('header.php');?>

      <div id="query_panel">
        <form>
          <label for="query">Enter the SQL query</label><br>
          <!-- <textarea id="query" name="query" rows="5" cols="100">' . $query . '</textarea><br>'-->
          <textarea id="query" name="query" rows="5" cols="100"></textarea><br>
          <!-- <input type="submit" value="GO">'; -->
        </form>
        <button type="button" onclick="displayResult()">Query</button>';
      </div>

      <div id="result_div"></div>

    <?php require_once('footer.php');?>

  </body>
</html>