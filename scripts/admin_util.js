function displayResult(){
    query = document.getElementById("query").value;
    if (query.length == 0) return;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("result_div").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "php/admin_query.php?q="+query, true);
    xhttp.send();
}