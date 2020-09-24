var RailMap = {};

RailMap.dim = 20; // number of columns & rows in grid
RailMap.mouseX = RailMap.mouseY = 0;
RailMap.background = new Image();
RailMap.background.src = 'images/railmap.svg';
RailMap.gridActive = false;

RailMap.keyDown = function(event) {
  if(event.key == "g"){
      RailMap.gridActive = !RailMap.gridActive;
  }
}

RailMap.mouseDown = function(event) {
  RailMap.mouseX = event.layerX;
  RailMap.mouseY = event.layerY;

  let date = new Date();
  let str = date.getHours() + " : " + date.getMinutes() + " : " + date.getSeconds();
  console.log(date);
}

RailMap.setup = function(){
  let canvas = document.getElementById('map');
  canvas.onclick = RailMap.mouseDown;
  canvas.setAttribute("tabindex", 0);
  canvas.addEventListener('keydown', RailMap.keyDown);
  RailMap.stations = [];
  RailMap.addStation(1, 1);
  RailMap.addStation(3, 3);
  RailMap.addStation(12, 3);
  RailMap.addStation(18, 3);
  RailMap.addStation(6, 6);
  RailMap.addStation(6, 12);
  RailMap.addStation(6, 17);
  RailMap.addStation(14, 5);
  RailMap.addStation(8, 14);
  RailMap.addStation(14, 14);
  RailMap.addStation(17, 12);

  RailMap.tracks = [];
  RailMap.addTrack(0, 1);
  RailMap.addTrack(1, 2);
  RailMap.addTrack(2, 3);
  RailMap.addTrack(4, 1);
  RailMap.addTrack(4, 5);
  RailMap.addTrack(5, 6);
  RailMap.addTrack(2, 7);
  RailMap.addTrack(5, 8);
  RailMap.addTrack(8, 9);
  RailMap.addTrack(9, 10);
  window.requestAnimationFrame(RailMap.display);

  RailMap.trains = [];
  RailMap.trains.push();
}

RailMap.addStation = function(xx, yy){
  RailMap.stations.push({x : xx, y : yy});
}

RailMap.addTrack = function(station1, station2, midpoints){
  RailMap.tracks.push({a : RailMap.stations[station1], b : RailMap.stations[station2]});
}

RailMap.addTrain = function(station1, station2, time1, time2){
  RailMap.trains.push({
    s1 : RailMap.stations[station1],
    s2 : RailMap.stations[station2],
    t1 : time1,
    t2 : time2
  });
}

RailMap.display = function(){
  var canvas = document.getElementById('map');
  var ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  // ctx.fillStyle = 'rgb(207, 184, 145)';
  // ctx.fillRect(0, 0, canvas.width, canvas.height);
  ctx.drawImage(RailMap.background, 0, 0);

  RailMap.displayGrid(canvas);
  RailMap.displayTracks(canvas);
  for(let t of RailMap.stations)
    RailMap.displayStation(t, canvas);
  for(let t of RailMap.trains)
    RailMap.displayTrain(t, canvas);

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
  let x = Math.floor(RailMap.mouseX / u);
  let y = Math.floor(RailMap.mouseY / u);
  ctx.fillRect(x * u, y * u, u, u);
  ctx.font = "10px Arial";
  ctx.fillStyle = 'white';
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';
  ctx.fillText("(" + x + ", " + y + ")", x * u + u/2, y * u + u/2);
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
  let u = canvas.width / RailMap.dim;
  let ctx = canvas.getContext('2d');
  let radius = u * 0.3;
  ctx.lineWidth = 2;
  ctx.strokeStyle = 'black';
  ctx.fillStyle = 'white';
  ctx.beginPath();
  ctx.arc(station.x * u + u/2, station.y * u + u/2, radius, 0, 2 * Math.PI);
  ctx.fill();
  ctx.stroke();

  ctx.font = "10px Arial";
  ctx.fillStyle = 'black';
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';
  ctx.fillText(RailMap.stations.indexOf(station), station.x * u + u/2, station.y * u + u/2);
}

RailMap.displayTrain = function(train, canvas){
  let u = canvas.width / RailMap.dim;
  let ctx = canvas.getContext('2d');
  let radius = u * 0.3;
  ctx.lineWidth = 2;
  ctx.strokeStyle = 'black';
  ctx.fillStyle = 'red';
  ctx.beginPath();
  ctx.arc(train.station.x * u + u/2, train.station.y * u + u/2, radius, 0, 2 * Math.PI);
  ctx.fill();
  ctx.stroke();
}
