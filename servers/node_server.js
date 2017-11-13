/* Pusher.js
Server side node.js script that services real-time websocket requests
Allows websocket connections to subscribe and publish to MQTT topics
*/

var sys = require('util');
var net = require('net');
var mqtt = require('mqtt');
var colors = require("colors");
var mysql  = require('mysql');
var moment = require('moment');


var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'mushroomdb'
}); // Database Connection

connection.connect(function(err){
if(!err) {
    console.log("Database is connected ... nn");    
} else {
    console.log("Error connecting database ... nn");    
}
}); // checking database Connection

 
// create a socket object that listens on port 5000
var io = require('socket.io').listen(5000);
 
// create an mqtt client object and connect to the mqtt broker
var client = mqtt.connect('mqtt://182.48.84.180');
var client1  = mqtt.connect('mqtt://182.48.84.180');

 
client1.on('connect', function () {
  client1.subscribe('presence');
  console.log("Subscribing to presence");
});
 
client1.on('message', function (topic, message) {
  // message is Buffer
  console.log("Start Listening");
  var payload = message.toString();
  console.log(payload);
  if(topic=='presence')
	{
		var Date = moment().format('DD/MM/YYYY');
        var Time = moment().format('HH:mm:ss');
		var Status = 0;
		var edtime = payload;
		var timeinfo = { date: Date,time: Time,edisontime: edtime,status: Status};
		connection.query('INSERT INTO timekeeping SET ? ',timeinfo, 
		function(err,rows){
		if(err) throw err;
		console.log("Time info Inserted");
		client1.publish("reload","ok");
		});
	}
});
 
io.sockets.on('connection', function (socket) {
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