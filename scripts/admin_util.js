function displayResult(){
    document.getElementById("query_indicator").innerHTML = "";
    var query = document.getElementById("query").value;
    if (query.length == 0) return;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("query_indicator").innerHTML = "Command executed successfully.\n"
            document.getElementById("result_div").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "php/admin_query.php?q="+query, true);
    xhttp.send();
}

function displayTableContent(event){
    table = event.target;
    var query = "SELECT * FROM "+ table.textContent;
    console.log(query);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("display_content").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "php/admin_query.php?q="+query, true);
    xhttp.send();

}

function displayDatabaseTables(){
    var query = "SHOW TABLES";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tables_list").innerHTML = this.responseText;
            var tables = document.getElementsByClassName("database_table");
            for (var i = 0; i < tables.length; i++){
                tables[i].addEventListener("click", displayTableContent, false);
            }
        }
    };
    xhttp.open("GET", "php/admin_SQ_tables_list.php?q="+query, true);
    xhttp.send();
}

function clearQuery(){
    document.getElementById("query").value = "";
    document.getElementById("query_indicator").innerHTML = "";
}

function showSelection(){
    document.getElementById("drop_down_list").className ="";
    document.getElementById("drop_down_list").style.top = (document.getElementById("manage_tab").offsetTop + document.getElementById("manage_tab").offsetHeight - 5).toString() + "px"; 
    // document.getElementById("drop_down_list").style.left = document.getElementById("manage_tab").offsetLeft;
    document.getElementById("drop_down_list").style.width = (document.getElementById("manage_tab").offsetWidth).toString() + "px";
    // console.log(document.getElementById("drop_down_list").style.top);
    // console.log(document.getElementById("manage_tab").offsetTop  + document.getElementById("manage_tab").offsetHeight);
    // console.log(document.getElementById("manage_tab").offsetWdith);
    // console.log(document.getElementById("drop_down_list").style.width);
}

function hideSelection(){
    document.getElementById("drop_down_list").className = "hidden";
}

function displaySimpleManagement(){
    //start
    document.getElementById("start").innerHTML = "";
    document.getElementById("start").className = "hidden";
    //advance query
    document.getElementById("query_panel").className = "hidden";
    document.getElementById("query").value = "";
    document.getElementById("query_indicator").innerHTML = "";
    document.getElementById("result_div").innerHTML = "";
    //simple management
    document.getElementById("simple_manage_panel").className = "";
    document.getElementById("tables_list").innerHTML = "";
    document.getElementById("display_content").innerHTML = "";
}

function displayAdvancedQuery(){
    //start
    document.getElementById("start").innerHTML = "";
    document.getElementById("start").className = "hidden";
    //advance query
    document.getElementById("simple_manage_panel").className = "hidden";
    document.getElementById("tables_list").innerHTML = "";
    document.getElementById("display_content").innerHTML = "";
    //simple management
    document.getElementById("query").value = "";
    document.getElementById("query_indicator").innerHTML = "";
    document.getElementById("result_div").innerHTML = "";
    document.getElementById("query_panel").className = "";

}

function listOfOnloadFunction(){
    document.getElementById("manage_tab").addEventListener("mouseout", hideSelection, false);
    document.getElementById("manage_tab").addEventListener("mouseover", showSelection, false);
    document.getElementById("drop_down_list").addEventListener("mouseover", showSelection, false);
    document.getElementById("drop_down_list").addEventListener("mouseout", hideSelection, false);
    document.getElementById("query_button").addEventListener("click", displayResult, false);
    document.getElementById("clear_button").addEventListener("click", clearQuery, false);
    document.getElementById("advance_query").addEventListener("click", displayAdvancedQuery, false);
    document.getElementById("simple_management").addEventListener("click", displayDatabaseTables, false);
    document.getElementById("simple_management").addEventListener("click", displaySimpleManagement, false);
}

window.addEventListener("load", listOfOnloadFunction, false);
