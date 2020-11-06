var RailMap = {};

RailMap.dim = 20; // number of columns & rows in grid
RailMap.mouseX = RailMap.mouseY = 0;
RailMap.background = new Image();
RailMap.background.src = 'images/railmap.svg';
RailMap.gridActive = false;

// =========================================================== EVENTS

RailMap.keyDown = function(event) {
  if(event.key == "g"){
      RailMap.gridActive = !RailMap.gridActive;
  }

  if(event.key == "t"){
      let request = createRequest();
      if(!request){
        alert("Can't create request");
        return;
      }

      let url = 'php/get_train_location.php?trainid=' + 'TA01';
      request.open("GET", url, true);
      request.onreadystatechange = function(){
        if(request.readyState != 4 || request.status != 200)
          return;
        console.log(request.responseText);
      };
      request.send(null);
  }

  // if(event.key == "s"){
  //   console.log(RailMap.generateSQL());
  // }
}

RailMap.mouseDown = function(event) {
}

RailMap.mouseMoved = function(event) {
  let canvas = document.getElementById('map');
  RailMap.mouseX = event.offsetX - parseFloat($(canvas).css('padding-left'));
  RailMap.mouseY = event.offsetY - parseFloat($(canvas).css('padding-top'));
  let u = RailMap.drawUnit(canvas);
  RailMap.cellX = Math.floor(RailMap.mouseX / u);
  RailMap.cellY = Math.floor(RailMap.mouseY / u);
}

// =========================================================== UTIL

RailMap.distance = function(stationA, stationB){
  let dx = stationA.x - stationB.x;
  let dy = stationA.y - stationB.y;
  return Math.sqrt(dx * dx + dy * dy);
}

// =========================================================== SETUPS

RailMap.setup = function(){
  let canvas = document.getElementById('map');
  canvas.onclick = RailMap.mouseDown;
  canvas.onmousemove = RailMap.mouseMoved;
  canvas.setAttribute("tabindex", 0);
  canvas.addEventListener('keydown', RailMap.keyDown);
  RailMap.stations = new Map();
  RailMap.addStation(1, 1, 'A01');
  RailMap.addStation(3, 3, 'A02');
  RailMap.addStation(6, 6, 'A03');
  RailMap.addStation(6, 12, 'A04');
  RailMap.addStation(6, 17, 'A05');
  RailMap.addStation(8, 14, 'A06');
  RailMap.addStation(12, 3, 'B01');
  RailMap.addStation(18, 3, 'B02');
  RailMap.addStation(14, 5, 'B03');
  RailMap.addStation(14, 14, 'C01');
  RailMap.addStation(17, 12, 'C02');
  RailMap.tracks = [];
  RailMap.addTrack('A01', 'A02');
  RailMap.addTrack('A02', 'B01');
  RailMap.addTrack('B01', 'B02');
  RailMap.addTrack('A03', 'A01');
  RailMap.addTrack('A03', 'A04');
  RailMap.addTrack('A04', 'A05');
  RailMap.addTrack('B01', 'B03');
  RailMap.addTrack('A04', 'A06');
  RailMap.addTrack('A06', 'C01');
  RailMap.addTrack('C01', 'C02');
  RailMap.refreshTrains();
  window.requestAnimationFrame(RailMap.display);
}

RailMap.addStation = function(x, y, id){
  RailMap.stations.set(id, {x : x, y : y, id: id});
}

RailMap.addTrack = function(stationIDa, stationIDb){
  RailMap.tracks.push({a : RailMap.stations.get(stationIDa), b : RailMap.stations.get(stationIDb)});
}

RailMap.addTrain = function(id, stationIDa, stationIDb, lerpingValue){
  RailMap.trains.set(id, {
    id : id,
    s1 : RailMap.stations.get(stationIDa),
    s2 : RailMap.stations.get(stationIDb),
    lerp: lerpingValue
  });
}

RailMap.refreshTrains = function(){
  RailMap.trains = new Map();

  let request = createRequest();
  if(!request){
    alert("Can't create request");
    return;
  }

  let url = 'php/get_train_location.php?';
  request.open("GET", url, true);
  request.onreadystatechange = function(){
    if(request.readyState != 4 || request.status != 200)
      return;
    let data = JSON.parse(request.responseText);
    for(let train of data){
      RailMap.addTrain(train.trainID, train.stationA, train.stationB, train.lerp);
    }
  };
  request.send(null);

}

// =========================================================== DISPLAYS

RailMap.display = function(){
  var canvas = document.getElementById('map');
  var ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  ctx.drawImage(RailMap.background, 0, 0);

  RailMap.displayGrid(canvas);
  RailMap.displayTracks(canvas);
  for(let t of RailMap.stations.values())
    RailMap.displayStation(t, canvas);
  RailMap.displayTrains(canvas);

  RailMap.displaySelectedCell(canvas);
  window.requestAnimationFrame(RailMap.display);
}

RailMap.drawUnit = function(canvas){
  return canvas.width / RailMap.dim;
}

RailMap.displayGrid = function(canvas){
  if(!RailMap.gridActive) return;
  let u = RailMap.drawUnit(canvas);
  let ctx = canvas.getContext('2d');
  ctx.strokeStyle = 'rgb(0, 0, 0, 0.3)';
  ctx.lineWidth = 1;
  ctx.beginPath();
  for(let i = 0; i<RailMap.dim; i++)
  for(let j = 0; j<RailMap.dim; j++){
    ctx.rect(i * u, j * u, u, u);
  }
  ctx.stroke();
}

RailMap.displaySelectedCell = function(canvas){
  if(!RailMap.gridActive) return;
  let u = RailMap.drawUnit(canvas);
  let ctx = canvas.getContext('2d');
  ctx.fillStyle = 'rgb(0, 0, 0, 0.3)';
  let x = RailMap.cellX;
  let y = RailMap.cellY;
  ctx.fillRect(x * u, y * u, u, u);
  ctx.font = "20px Arial";
  ctx.fillStyle = 'black';
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';
  ctx.fillText("(" + x + ", " + y + ")", canvas.width - 40, canvas.height - 20);
}

RailMap.displayTracks = function(canvas){
  let ctx = canvas.getContext('2d');
  ctx.lineCap = "round";
  ctx.strokeStyle = 'rgb(0, 0, 0)';
  ctx.lineWidth = 10;
  for(let t of RailMap.tracks)
    RailMap.displayTrack(t, canvas);

  ctx.strokeStyle = 'rgb(0, 207, 222)';
  ctx.lineWidth = 8;
  for(let t of RailMap.tracks)
    RailMap.displayTrack(t, canvas);
}

RailMap.displayTrack = function(track, canvas){
  let u = RailMap.drawUnit(canvas);
  let ctx = canvas.getContext('2d');
  ctx.beginPath();
  ctx.moveTo(track.a.x * u + u/2, track.a.y * u + u/2);
  ctx.lineTo(track.b.x * u + u/2, track.b.y * u + u/2);
  ctx.stroke();
}

RailMap.displayStation = function(station, canvas){
  let selected = station.x == RailMap.cellX && station.y == RailMap.cellY;
  let u = canvas.width / RailMap.dim;
  let ctx = canvas.getContext('2d');
  let radius = selected? u * 0.6 : u * 0.5;
  ctx.lineWidth = 2;
  ctx.strokeStyle = 'black';
  ctx.fillStyle = selected? 'rgb(232, 205, 130)' : 'white';
  ctx.beginPath();
  ctx.arc(station.x * u + u/2, station.y * u + u/2, radius, 0, 2 * Math.PI);
  ctx.fill();
  ctx.stroke();

  ctx.font = "900 10px Arial";
  ctx.fillStyle = 'black';
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';
  ctx.fillText(station.id, station.x * u + u/2, station.y * u + u/2);
}

RailMap.displayTrains = function(canvas){
  let u = canvas.width / RailMap.dim;
  let ctx = canvas.getContext('2d');
  let radius = u * 0.3;
  ctx.lineWidth = 2;
  let lerp = function(a, b, l){
    return a + (b-a) * l;
  }

  for(let train of RailMap.trains.values()){
    let x = lerp(train.s1.x, train.s2.x, train.lerp);
    let y = lerp(train.s1.y, train.s2.y, train.lerp);
    let xCan = x * u + u/2;
    let yCan = y * u + u/2;
    ctx.strokeStyle = 'black';
    ctx.fillStyle = 'red';
    ctx.beginPath();
    ctx.arc(xCan, yCan, radius, 0, 2 * Math.PI);
    ctx.fill();
    ctx.stroke();

    let offsetY = 25;
    ctx.fillStyle = 'white';
    ctx.strokeStyle = 'black';
    let boxW = 40;
    let boxH = 20;
    ctx.beginPath();
    ctx.rect(xCan - boxW/2, yCan - boxH/2 - offsetY, boxW, boxH);
    ctx.fill();
    ctx.stroke();
    ctx.font = "900 10px Arial";
    ctx.fillStyle = 'black';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(train.id, xCan, yCan - offsetY)
  }
}
