var mysql  = require('mysql');
var Transport = require('bipsms');
var net = require("net");
var colors = require("colors");
var server = net.createServer();

var transport = new Transport({username:'shakir1443',password:'Nila101010$'});
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    password : '',
    database : 'smsservice'
}); // Database Connection



server.on("connection", function (socket){
var remoteAddress = socket.remoteAddress + ":" + socket.remotePort;


    socket.on("data", function (d) {
	console.log("%s".cyan, d); // connecting server and socket

	var buffer1 = new Buffer(d);

        var bf = buffer1.toString('utf8');
	var bf_arr = bf.split(",");
	console.log(bf_arr);
	var dev_id = bf_arr[0];
	var user_id=bf_arr[1];
	var time=bf_arr[2];
	var splittime = time.split(" ");

	console.log(dev_id +" "+ user_id+" " + time); // spliting the recieved string in comma separated way and printing in console

	//===========================================Check time============================//
    connection.query("SELECT name,phone FROM smsalert Where userid = ?",[user_id],
        function (err, result) {
        if (err) throw err;
         var sms =
            {
                 from :'InfoSMS',
                 to : result[0].phone,
                 text :'Date:'+splittime[0]+' '+result[0].name+' Has Arrived at '+splittime[1],
            }
        console.log(sms);
        transport.sendSingleSMS(sms, function(error, response) {
        console.log(response);
        console.log(response.messages);

    });
});

    socket.write("Message Recieved " + d);
});

   socket.once("close", function () {
   console.log("Connection from %s closed".yellow, remoteAddress);
  });
  socket.on("error", function (err){
    console.log("Connection %s error: %s".red, remoteAddress, err.message);
	});
});

server.listen(9000, function() {
	 console.log("server listening to %j", server.address());
});
