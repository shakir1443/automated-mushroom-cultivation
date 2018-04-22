var net = require("net");
var colors = require("colors");
var mysql  = require('mysql');
var moment = require('moment');
var mqtt = require('mqtt');
var server = net.createServer();
var io = require('socket.io').listen(4000);

var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '123456',
  database : 'mushdb'
}); // Database Connection

connection.connect(function(err){
if(!err) {
    console.log("Database is connected ... nn");    
} else {
    console.log("Error connecting database ... nn");    
}
}); // checking database Connection

var client = mqtt.connect('mqtt://182.163.112.207');
client.on('connect', function () {
  client.subscribe('mushroom/sensor_data');
  console.log("Subscribing to mushroom/sensor_data");
  client.subscribe('mushroom/ack');
  console.log("Subscribing to mushroom/ack");
});


client.on('message', function (topic, message) {
  // message is Buffer
    console.log(message.toString());
    if(topic=='mushroom/ack')
    {
      var status = message.toString();
      var Date = moment().format('DD/MM/YYYY');
      var Time = moment().format('HH:mm:ss');
      var timeinfo = {date: Date, time: Time, status: status};
      connection.query('INSERT INTO timekeeping SET ? ',timeinfo,
      function(err,rows){
      if(err) throw err;
      console.log('Time info inserted');
      });
    }
    if(topic=='mushroom/sensor_data')
    {
	var buffer1 = new Buffer(message);
    var bf = buffer1.toString('utf8');
	var bf_arr = bf.split(",");
	//console.log(bf_arr);
	var hum = bf_arr[0];
	var temp = bf_arr[1];
	var co2 = bf_arr[2];
	var light = bf_arr[3];
	var Date = moment().format('DD/MM/YYYY');
	var Time = moment().format('HH:mm:ss');
	console.log("Date:"+Date+", Time:"+Time+", Humidity:"+hum+", Temperature:"+temp+", CO2:"+co2+", Light:"+light); 
// spliting the recieved string in comma separated way and printing console 
    var sinfo = { date: Date,time: Time, hum: hum, temp: temp, co2: co2, light: light};
	connection.query('UPDATE sensorinfo SET ? where id = 1',sinfo, 
		function(err,rows){
		if(err) throw err;
		console.log("Inserted");		
		});
     }
 });

io.sockets.on('connection', function (socket) {
    console.log("Client Connected");
    // socket connection indicates what mqtt topic to subscribe to in data.topic
    socket.on('subscribe', function (data) {
        console.log('Subscribing to '+data.topic);
        socket.join(data.topic);
        client.subscribe(data.topic);
    });
    // when socket connection publishes a message, forward that message
    // the the mqtt broker
    socket.on('publish', function (data) {
        console.log('Publishing to '+data.topic);
        client.publish(data.topic,data.payload);
    });
});

// listen to messages coming from the mqtt broker
client.on('message', function (topic, payload, packet) {
    console.log(topic+'='+payload);
    io.sockets.emit('mqtt',{'topic':String(topic),
                            'payload':String(payload)});
});

