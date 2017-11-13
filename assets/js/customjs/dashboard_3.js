$(document).ready(function($) {
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
