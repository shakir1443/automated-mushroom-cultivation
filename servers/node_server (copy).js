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


var db_config = {
  host     : 'localhost',
  user     : 'root',
  password : '123456',
  database : 'mushdb'
}; // Database Connection

var connection;

function handleDisconnect(){
    connection = mysql.createConnection(db_config);
    console.log("Database is connected");
    connection.connect(function(err) {              // The server is either down
    if(err) {                                     // or restarting (takes a while sometimes).
      console.log('error when connecting to db:', err);
      setTimeout(handleDisconnect, 2000); // We introduce delay before attempting toreconnect,
    }                                     // to avoid hot loop and to allow our node script to
  });                                     // process asynchronous requests in the meantime.
                                          // If you're also serving http, display a 503 error.
  connection.on('error', function(err) {
    console.log('db error', err);
    if(err.code === 'PROTOCOL_CONNECTION_LOST') { // Connection to the MySQL server is usually
      handleDisconnect();                         // lost due to either server restart, or a
    } else {                                      // connnection idle timeout (the wait_timeout
      throw err;                                  // server variable configures this)
    }
  });
}

handleDisconnect();

 
// create a socket object that listens on port 5000
var io = require('socket.io').listen(4000);
 
// create an mqtt client object and connect to the mqtt broker
var client = mqtt.connect('mqtt://182.48.84.180');

 
client.on('connect', function () {
  client.subscribe('presence');
  console.log("Subscribing to presence");
});
 
client.on('message', function (topic, message) {
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
