var m = require('mraa');
var mqtt    = require('mqtt');
var sleep = require('sleep');
var moment = require('moment');
var client  = mqtt.connect('mqtt://182.48.84.180');
//var client1  = mqtt.connect('mqtt://182.163.112.205');

var Led13 = new m.Gpio(13); //Fan hooked up to digital pin 13 (or built in pin $
Led13.dir(m.DIR_OUT); //set the gpio direction to output
var Led12 = new m.Gpio(12); //Water hooked up to digital pin 12 (or built in pi$
Led12.dir(m.DIR_OUT); //set the gpio direction to output
Led13.write(1);
Led12.write(1);

var time;
time = moment().format('HH:mm:ss');
var time1= "00:30:00";
var time2= "04:30:00";
var time3= "08:30:00";
var time4= "12:00:00";

var fan_state="off";
var water_state="off";

function schedule(){
        time = moment().format('HH:mm:ss');

          console.log(time);
 if(time == time1 || time == time2 || time == time3 || time == time4)
 {
  console.log("send time");

   //client.publish('presence',time.toString(),function(){ console.log("Time se$

   Led13.write(0);
   console.log("Fan turned on");
   sleep.sleep(30);
   Led13.write(1);
 console.log("Fan turned off");
   sleep.sleep(2);

   Led12.write(0);
   console.log("Water turned on");
   sleep.sleep(13);
   Led12.write(1);
   console.log("Water turned off");
   sleep.sleep(2);
   client.publish('presence',time);

   } // end if

}


client.on('connect', function () {
        client.subscribe('smcms');
        client.subscribe('smcms1');
        client.subscribe('presence');
        client.subscribe('chk');
    });


setInterval(schedule,1000);


client.on('message', function (topic, message) {
        if(topic=="smcms"){
                if(message == 'on'){
                        Led13.write(0)
                        console.log('Fan Turned ON');
                        fan_state = "on";
                }else{
                        Led13.write(1);
                        console.log('Fan Turned OFF');
                        fan_state = "off";
                }
                //client.publish('fan_status',fan_state);
          }
        else if(topic=="smcms1"){
                if(message == 'on'){
                        Led12.write(0);
                        console.log('Water Turned ON');
                        water_state = "on";
                }else{
                        Led12.write(1);
                        console.log('Water Turned OFF');
                        water_state = "off";
                }
 //client.publish('water_status',water_state);
        }
        else if(topic=="chk"){
                if(message == "chk_status"){

                 client.publish('fan_status',fan_state);
                 client.publish('water_status',water_state);
                                   }

                              }

});
