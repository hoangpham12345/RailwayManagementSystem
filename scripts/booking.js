
window.onload = function(){
  RailMap.setup();
  let trainlist = document.getElementById("trainlist");
  let rows = trainlist.querySelectorAll('table tr');
  rows = Array.prototype.slice.call(rows);
  for(let r of rows){
    if(rows.indexOf(r) == 0)
      continue;
    r.onmousedown = ()=>{
      requestSchedule(r.children[1].innerHTML)
    };
  }
}

function requestSchedule(trainID){
  request = createRequest();
  if(!request){
    alert("Can't create request");
    return;
  }

  let url = 'php/get_schedule.php?trainid=' + trainID;
  request.open("GET", url, true);
  request.onreadystatechange = updateSchedule;
  request.send(null);
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
  console.log(backBtn);
}

function backToTrainList(){
  let trainlist = document.getElementById("trainlist");
  trainlist.classList.remove("hiding");
  let scheduleList = document.getElementById('schedulelist');
  scheduleList.classList.add("hiding");
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
