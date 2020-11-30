
window.onload = function(){
  document.getElementById('searchtabnav').addEventListener('click', searchTabClicked);
  document.getElementById('booktabnav').addEventListener('click', bookTabClicked);
  RailMap.setup();
  let trainlist = document.getElementById('trainlist');
  let rows = trainlist.querySelectorAll('table tr');
  rows = Array.prototype.slice.call(rows);
  for(let r of rows){
    if(rows.indexOf(r) == 0)
      continue;
    r.onmousedown = ()=>{
      requestSchedule(r.children[1].innerHTML);
    };
    r.onmouseover = ()=>{
      RailMap.highlightTrain(r.children[1].innerHTML, 0);
    };
    r.onmouseleave = ()=>{
      RailMap.unHighlightTrain(r.children[1].innerHTML, 0);
    }
  }

  // BOOKING FORM
  let deleteRoute = function () {document.getElementById('route_field').innerHTML = "";};
  document.getElementById('from_station_field').addEventListener('change', deleteRoute);
  document.getElementById('to_station_field').addEventListener('change', deleteRoute);
  document.getElementById('findroutebtn').addEventListener('click', findRoute);
}

function searchTabClicked(){
  document.getElementById('booktab').classList.add('hiding');
  document.getElementById('searchtab').classList.remove('hiding');
  document.getElementById('booktabnav').classList.remove('selected');
  document.getElementById('searchtabnav').classList.add('selected');
}

function bookTabClicked() {
  document.getElementById('searchtab').classList.add('hiding');
  document.getElementById('booktab').classList.remove('hiding');
  document.getElementById('searchtabnav').classList.remove('selected');
  document.getElementById('booktabnav').classList.add('selected');
}

function findRoute(){
  let fromS = document.getElementById('from_station_field').value;
  let toS = document.getElementById('to_station_field').value;
  if(fromS == toS){
    alert("From Station cannot be the same as To Station.\nWhy do you even need take a train? Come on!");
    return;
  }
  let request = createRequest();
  if(!request){
    alert("Can't create request!");
    return;
  }
  let url = 'php/find_route.php?fromstation=' + fromS + '&tostation=' + toS;
  request.open("GET", url, true);
  request.onreadystatechange = function(){
    if(request.readyState != 4 || request.status != 200)
      return;
    document.getElementById('route_field').innerHTML = request.responseText;
    let routeCount = document.getElementById('route_field').length;
    if(routeCount == 0)
      alert("Sorry, we cannot find any train that serves your need.\nPerhaps you should break down to multiple trips");
  };
  request.send(null);
}

function requestSchedule(trainID){
  request = createRequest();
  if(!request){
    alert("Can't create request");
    return;
  }

  let url = 'php/get_schedule.php?trainid=' + trainID;
  request.open("GET", url, true);
  request.trainID = trainID;
  request.onreadystatechange = updateSchedule;
  request.send(null);
  RailMap.highlightTrain(trainID, 1);
}

function updateSchedule(){
  if(request.readyState != 4 || request.status != 200)
    return;

  let scheduleList = document.getElementById('schedulelist');
  scheduleList.innerHTML = request.responseText;
  let trainlist = document.getElementById("trainlist");
  trainlist.classList.add("hiding");
  scheduleList.classList.remove("hiding");
  let backBtn = document.getElementById('backbutton');
  backBtn.addEventListener('click', () => {backToTrainList()});

  let rows = scheduleList.querySelectorAll('#trains-schedulelist table tr');
  rows = Array.prototype.slice.call(rows);
  for(let r of rows){
    if(rows.indexOf(r) == 0)
      continue;
    r.onmouseover = ()=>{
      RailMap.highlightStation(r.children[2].innerHTML);
    };
    r.onmouseleave = ()=>{
      RailMap.unHighlightStation(r.children[2].innerHTML);
    }
  }

}

function backToTrainList(){
  let trainlist = document.getElementById("trainlist");
  trainlist.classList.remove("hiding");
  let scheduleList = document.getElementById('schedulelist');
  scheduleList.classList.add("hiding");
  RailMap.unHighlightTrain(null, 1);
}

function createRequest() {
  let request;
  try {
    request = new XMLHttpRequest();
  } catch (tryMS) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (otherMS) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (failed) {
        request = null;
      }
    }
  }
  return request;
}
