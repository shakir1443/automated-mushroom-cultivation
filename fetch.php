<?php
//fetch.php;
 include("session.php");
 
if(isset($_POST["view"]))
{

 if($_POST["view"] != '')
 {
  $update_query = "UPDATE timekeeping SET status=1 WHERE status=0";
  mysqli_query($conn, $update_query);
 }
 $query = "SELECT * FROM timekeeping ORDER BY id DESC LIMIT 4";
 $result = mysqli_query($conn, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
	$time =date("h:i:s A", strtotime($row["time"]));
   $output .= '
   <li>
								<a href="dashboard_2.php" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                    <p class="notify-details">Water & Air Given at<small class="text-muted">'.$time.', '.$row["date"].'</small></p>
                                </a>
   </li>
   <li class="divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM timekeeping WHERE status=0";
 $result_1 = mysqli_query($conn, $query_1);
 $count = mysqli_num_rows($result_1);
 
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>
