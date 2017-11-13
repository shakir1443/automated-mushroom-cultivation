$(document).ready(function($) {
				$('#sensorinfo').hide();

                function load_unseen_notification(view = '')
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
							  }, 5000);
			});
			function update(){
				$('#sql').load("dashboard_2.php #sql");
                $('#sensortable').load("dashboard_2.php #sensortable");
				$('#sqlend').load("dashboard_2.php #sqlend");
				$('#sql1').load("dashboard_2.php #sql1");
				$('#timekeepingtable').load("dashboard_2.php #timekeepingtable");
				$('#sql1end').load("dashboard_2.php #sql1end");
            }
            setInterval( 'update()', 5000 );
