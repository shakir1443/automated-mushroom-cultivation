var socket = io.connect('http://182.163.112.207:4000');


            jQuery(document).ready(function($) {


			//donut chart
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
                $(".knob").knob();
            // donut chart end

			//status check
			socket.emit('publish', {topic:"mushroom/chk-status",payload:"1"});
			// end status check

			//notification
			function load_unseen_notification(view ='')
							 {
							  $.ajax({
							   url:"fetch.php",
							   method:"POST",
							   data:{view:view},
							   dataType:"json",
							   success:function(data)
							   {
								$('.dropdown-menu-alt').html(data.notification);
								if(data.unseen_notification > 0)
								{
								 $('.count').html(data.unseen_notification);
								}
								else{
									$('.count').html(0);
								}
							   }
							  });
							 }

				load_unseen_notification();

				$(document).on('click', '.dropdown-menu-alt', function(){
							  $('.count').html('');
							  load_unseen_notification('yes');
							 });

				setInterval(function(){
						load_unseen_notification();
							}, 3000);

			 //notification
            });

            function temp(){
               var t = document.getElementById('temp').value;
               socket.emit('publish',{topic:"mushroom/temp",payload:t});
}

           function get_time(){
               var timehold = new Array(8);
               var t1 = document.getElementById('time1').value;
               var t2 = document.getElementById('time2').value;
               var t3 = document.getElementById('time3').value;
               var t4 = document.getElementById('time4').value;
               var t5 = document.getElementById('time5').value;
               var comma = ",";
               var zero = "0";
               timehold[0] = t1.concat(comma);
               if(t2){
               timehold[1] = timehold[0].concat(t2);
               timehold[2] = timehold[1].concat(comma);                
}              else{
               timehold[1] = timehold[0].concat(zero);
               timehold[2] = timehold[1].concat(comma);   
}               

               if(t3){
               timehold[3] = timehold[2].concat(t3);
               timehold[4] = timehold[3].concat(comma);  
}             
              else{
               timehold[3] = timehold[2].concat(zero);
               timehold[4] = timehold[3].concat(comma);
}             
               if(t4){
               timehold[5] = timehold[4].concat(t4);
               timehold[6] = timehold[5].concat(comma);  
}             
               else{
               timehold[5] = timehold[4].concat(zero);
               timehold[6] = timehold[5].concat(comma);
}
               if(t5){
               timehold[7] = timehold[6].concat(t5); 
}              else{
               timehold[7] = timehold[6].concat(zero);
}
               socket.emit('publish',{topic:"mushroom/time",payload:timehold[7]});
               alert("Time Set Successfully");
}

// fan
function fan(){
if (document.getElementById('fan-slider').checked)
{
	document.getElementById("fan-img").src = "image/fan.gif";
	socket.emit('publish', {topic:"mushroom/user_input", payload:"5"});   

} 
else 
{
    document.getElementById("fan-img").src = "image/fanstop.png";
	socket.emit('publish', {topic:"mushroom/user_input",payload:"4"});
}
}
// fan end

// water
function waterOn() {
if (document.getElementById('water-slider').checked)
{
	document.getElementById("water-img").src = "image/water.gif";
	socket.emit('publish', {topic:"mushroom/user_input",payload:"2"});
} 
else
{
	document.getElementById("water-img").src = "image/waterstop.png";
	socket.emit('publish', {topic:"mushroom/user_input",payload:"3"});
}
}

			//water end

			//socket(mqtt)

			socket.on('connect', function () {
				socket.on('mqtt', function (msg) {
					console.log(msg.topic+' '+msg.payload);
					if(msg.topic=="mushroom/fan-status"){
						if(msg.payload=="on"){
						    $('#fan-slider').prop('checked', true);
							$('#fan-img').attr('src','image/fan.gif');

						}
                        else if(msg.payload=="off"){
							 $('#fan-slider').prop('checked', false);
							 $('#fan-img').attr('src','image/fanstop.png');
						 }
					}

					if(msg.topic=="mushroom/pump-status"){
						if(msg.payload=="on"){
							  document.getElementById("water-img").src = "image/water.gif";
						      $('#water-slider').prop('checked', true);
							  $('#water-img').attr('src','image/water.gif');

						}
                         else if(msg.payload=="off"){
							 $('#water-slider').prop('checked', false);
							 $('#water-img').attr('src','image/waterstop.png');
						 }
					}
					if(msg.topic=="reload"){
						if(msg.payload =="ok"){
							load_unseen_notification();
						}
					}

				});
					socket.emit('subscribe',{topic:'fan-status'});
					socket.emit('subscribe',{topic:'pump-status'});
					socket.emit('subscribe',{topic:'reload'});
			});



			// socket(mqtt) end

			/*function update(){
                $('#sql').load("index.php #sql");
				$('#sql1').load("index.php #sql1");
                $('#hum').load("index.php #hum");
            }
            setInterval( 'update()', 60000 );
			setInterval(function() {
				location.reload();
			}, 180000);	*/

			function oyesterimg() {
			document.getElementById("mush-img").src = "image/oyester.png";
            document.getElementById("mush-name").innerHTML="OYSTER";
			}
			function shitakeimg() {
			document.getElementById("mush-img").src = "image/shitake.png";
            document.getElementById("mush-name").innerHTML ="SHITAKE";
			}
			function buttonimg() {
			document.getElementById("mush-img").src = "image/button.png";
            document.getElementById("mush-name").innerHTML="BUTTON";
			}
			function milkyimg() {
			document.getElementById("mush-img").src = "image/milky.jpg";
            document.getElementById("mush-name").innerHTML="MILKY";
			}
