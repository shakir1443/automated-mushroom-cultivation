var socket = io.connect('http://192.168.2.91:5000');

            jQuery(document).ready(function($) {



			//donut chart
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
                $(".knob").knob();
            // donut chart end

			//status check
			socket.emit('publish', {topic:"chk",payload:"chk_status"});
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


			// fan
			function fanOn(){
								if (document.getElementById('fan-slider').checked)
									{
										document.getElementById("fan-img").src = "image/fan.gif";
										socket.emit('publish', {topic:"smcms",payload:"on"});
										} else {
										        document.getElementById("fan-img").src = "image/fanstop.png";
												socket.emit('publish', {topic:"smcms",payload:"off"});
												}
							}
			// fan end

			// water
			function waterOn() {
								if (document.getElementById('water-slider').checked)
									{
										document.getElementById("water-img").src = "image/water.gif";
										socket.emit('publish', {topic:"smcms1",payload:"on"});
									} else {
											document.getElementById("water-img").src = "image/waterstop.png";
											socket.emit('publish', {topic:"smcms1",payload:"off"});
										}
								}

			//water end

			//socket(mqtt)

			socket.on('connect', function () {
				socket.on('mqtt', function (msg) {
					console.log(msg.topic+' '+msg.payload);
					if(msg.topic=="fan_status"){
						if(msg.payload=="on"){
						    $('#fan-slider').prop('checked', true);
							$('#fan-img').attr('src','image/fan.gif');

						}
                        else if(msg.payload=="off"){
							 $('#fan-slider').prop('checked', false);
							 $('#fan-img').attr('src','image/fanstop.png');
						 }
					}

					if(msg.topic=="water_status"){
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
					socket.emit('subscribe',{topic:'fan_status'});
					socket.emit('subscribe',{topic:'water_status'});
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
