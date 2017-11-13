var net = require("net");
var colors = require("colors");
var mysql  = require('mysql');
var moment = require('moment');
var server = net.createServer();

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





server.on("connection", function (socket){
var remoteAddress = socket.remoteAddress + ":" + socket.remotePort;
console.log("New client connnection is made %s".green, remoteAddress);

  socket.on("data", function (d) {
        console.log("Data from %s : %s".cyan,remoteAddress, d); // connecting server and socket
		
	var buffer1 = new Buffer(d);
    var bf = buffer1.toString('utf8');
	var bf_arr = bf.split(",");
	//console.log(bf_arr);
	var Light = bf_arr[0];
	var soil_moist = bf_arr[1];
	var Co2 = bf_arr[2];
	var temperature = bf_arr[3];
	var humidity = bf_arr[4];
	var Date = moment().format('DD/MM/YYYY');
	var Time = moment().format('HH:mm:ss');
	
	console.log("Date:"+Date+", Time:"+Time+", Light:"+Light+", Soil Moisture:"+soil_moist+", CO2:"+Co2+", Temperature:"+temperature+", Humdity:"+humidity); // spliting the recieved string in comma separated way and printing in console 
    var sinfo = { date: Date,time: Time, light: Light, soil: soil_moist, co2: Co2, temp: temperature, hum: humidity };
	connection.query('INSERT INTO sensorinfo SET ? ',sinfo, 
		function(err,rows){
		if(err) throw err;
		console.log("Inserted");		
		});
     });
	

   socket.once("close", function () {
   console.log("Connection from %s closed".yellow, remoteAddress);
  });

  socket.on("error", function (err){
    console.log("Connection %s error: %s".red, remoteAddress, err.message);
        });
});

server.listen(8000, function() {
         console.log("server listening to %j", server.address());
});