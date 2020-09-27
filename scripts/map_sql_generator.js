RailMap.generateSQL = function() {
  schedules = [];
  schedules[0] = {
    id: 'TA01',
    path: ['A01', 'A02', 'A03', 'A04', 'A05', 'A04', 'A06', 'C01', 'C02', 'C01', 'A06', 'A04', 'A03', 'A02', 'A01']
  }
  schedules[1] = {
    id: 'TA05',
    path: ['A05', 'A04', 'A03', 'A02', 'A01', 'A02', 'B01', 'B02', 'B01', 'A02', 'A03', 'A04', 'A05']
  }
  schedules[2] = {
    id: 'TC02',
    path: ['C02', 'C01', 'A06', 'A04', 'A03', 'A02', 'A01', 'A02', 'A03', 'A04', 'A05', 'A04', 'A06', 'C01', 'C02']
  }
  schedules[3] = {
    id: 'TB02',
    path: ['B02', 'B01', 'B03', 'B01', 'A02', 'A03', 'A04', 'A05', 'A04', 'A03', 'A02', 'B01', 'B02']
  }

  let sql = "";
  for(let s of schedules){
    sql += RailMap.generateSQL1(s.id, s.path) + "\n";
  }
  return sql;
}

RailMap.generateSQL1 = function(trainID, stations){
  let time = new Date();
  time.setHours(1, 0, 0);
  let cur = RailMap.stations.get(stations[0]);
  console.log('start: ' + cur.id + ' time-out: ' + RailMap.formatTime(time));

  let sql = "";

  for(let i = 0; i<stations.length; i++){
    let next = RailMap.stations.get(stations[i]);

    // Dist
    let dist = RailMap.distance(cur, next);

    // Time
    let minutePerUnit = 20;
    let breakMinute = 5;
    let timeIN = RailMap.getRoundedDate(5, time.getTime() + (dist * minutePerUnit) * 60 * 1000);
    let timeOUT = RailMap.getRoundedDate(5, timeIN.getTime() + breakMinute * 60 * 1000);

    sql += RailMap.generateSQL2(trainID, i, stations[i], RailMap.formatTime(timeIN), RailMap.formatTime(timeOUT)) + "\n";
    cur = next;
    time = timeOUT;
  }

  return sql;
}

RailMap.generateSQL2 = function(trainID, sequenceNumber, stationID, timeIn, timeOut){
  return "INSERT INTO `schedule` (`train`, `sequence_number`, `station`, `time_in`, `time_out`) VALUES ('"
  + trainID + "', '" + sequenceNumber + "', '" + stationID + "', '" + timeIn + "', '" + timeOut + "');";
}

RailMap.getRoundedDate = (minutes, t) => {
  let ms = 1000 * 60 * minutes; // convert minutes to ms
  return new Date(Math.round(t / ms) * ms);
}

RailMap.formatTime = function(date){
  let h =  date.getHours();
  h = h<10? "0"+h : h;
  let m = date.getMinutes();
  m = m<10? "0"+m : m;
  return h + ":" + m + ":00";
}
