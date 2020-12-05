<?php
  require_once('php/authorize.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" charset="utf-8">
		<title>Railway Management System Admin</title>
		<link rel="icon" href="images/icon.svg"></link>
    <link rel="stylesheet" type="text/css" href="stylesheet/admin.css"></link>
    <script src="scripts/admin_util.js"></script>
  </head>
  <body>

    <header>
      <table id="headerTable">
        <tr>
          <td width="40%"><img src='images/icon1.svg' width='60px' height='60px' align="right"></td>
          <td><h1>Railway Management System Admin</h1></td>
        </tr>
      </table>
    </header>

    <nav id="toolbar"> 
      <ul id="list_toolbar">
        <li id="manage_tab">SYSTEM MANAGEMENT</li>
        <li id="fix_request">FIX REQUEST</li>
        <li id="feedback_management">FEEDBACK MANAGEMENT</li>
      </ul>
    </nav>

    <ul id="drop_down_list" class="hidden">
      <li id="simple_management">SIMPLE MANAGEMENT</li>
      <li id="advance_query">ADVANCED QUERY</li>
    </ul>

    <div id = "simple_manage_panel" class="hidden">
      <div id ="tables_list"></div>
      <div id ="display_content"></div>
    </div>

    <div id="query_panel" class="hidden">
      <form>
        <p id="query_label">Enter the SQL query</p>
        <textarea id="query" name="query" placeholder="Right now, please using this with only SELECT, SHOW and DESC (DESCRIBE) commands."></textarea><br>
        <!-- <input type="submit" value="GO">'; -->
      </form>
      <table id="query_buttons">
        <tr>
          <td><button type="button" id="query_button" class="query_selection">Query</button></td>
          <td><button type="button" id="clear_button" class="query_selection">Clear</button></td>
        </tr>
      </table>
      <p id="query_indicator"></p>
      <div id="result_div"></div>
    </div>

    <!-- <div id="result_div" class="hidden"></div> -->

    <footer>
      <p>Copyright &copy 2020 by Visualization group. All right reserved</p>
    </footer>

  </body>
</html>