var net = require("net");
var colors = require("colors");
var mysql  = require('mysql');
var moment = require('moment');
var server = net.createServer();


server.on("connection", function (socket){
var remoteAddress = socket.remoteAddress + ":" + socket.remotePort;
console.log("New client connnection is made %s".green, remoteAddress);

  socket.on("data", function (d) {
        console.log("Data from %s : %s".cyan,remoteAddress, d); // connecting server and socket
	var buffer1 = new Buffer(d);
    var bf = buffer1.toString('utf8');
     });
   socket.once("close", function () {
   console.log("Connection from %s closed".yellow, remoteAddress);
  });

  socket.on("error", function (err){
    console.log("Connection %s error: %s".red, remoteAddress, err.message);
        });
});

server.listen(3000, function() {
         console.log("server listening to %j", server.address());
});
