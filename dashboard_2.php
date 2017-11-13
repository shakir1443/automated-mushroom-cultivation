<!DOCTYPE html>
<?php
include("session.php"); 
?>
<html>
    

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>AMCS Environment History</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/slider.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/customjs/dashboard_2.js"></script>
		
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.php" class="logo"><img src="image/mushroomicon.png" height="50" width="50"><span>AMCS</span></a>
                        <!-- Image Logo here -->
                    </div>
                </div>

               <!-- Button mobile view to collapse sidebar menu -->
                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                        <li class="list-inline-item dropdown notification-list">
						    <!-- notification -->
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-bell noti-icon"></i>
                                <span class="badge badge-pink noti-icon-badge count"></span>
                            </a>
                             							
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
								<div class="dropdown-item noti-title">
										<h5><span class="badge badge-danger float-right"></span>Notification</h5>
								 </div>
								<div class ="dropdown-menu-alt"></div>							 
                            </div>
                        </li>

                        <li class="list-inline-item notification-list">
                            <a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
                                <i class="dripicons-expand noti-icon"></i>
                            </a>
                        </li>                       

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="image/profile.ico" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">                               
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                </a>
                                <!-- item-->
                                <a href="logout.php" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
					<ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                        

                            <li class="text-muted menu-title">Navigation</li>

                            <li class="has_sub">							   
								<a  href="index.php" class="waves-effect"><i class="ti-home"></i><span>Control Panel</span></a>
							</li>
							<li class="has_sub">
								<a  href="dashboard_2.php" class="waves-effect"><i class="ti-menu-alt"></i><span>Environment History</span></a>
                            </li>                          
                            <li class="has_sub">
								<a  href="dashboard_3.php" class="waves-effect"><i class="ti-bar-chart"></i><span>Analytics</span></a>
                            </li>
                            
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">                    
                    <div class="container">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
							<div class="btn-group pull-right m-t-15">
                                  <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">SELECT HISTORY</button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">                                        
                                        <a class="dropdown-item" href="#" onclick="showcontrolinfo()">CONTROL INFO</a>
									    <a class="dropdown-item" href="#" onclick="showsensorinfo()">SENSOR INFO</a>
                                    </div>
									<script language="javascript">												
												function showsensorinfo() {													
															$('#sensorinfo').show();
															$('#timekeeping').hide();	
												}
												function showcontrolinfo() {													
															$('#sensorinfo').hide();
															$('#timekeeping').show();												
												}												
										</script>
                                </div>
                                <h4 class="page-title">AUTOMATED MUSHROOM CULTIVATION SYSTEM</h4>
                                <p class="text-muted page-title-alt">Environment History</p>
                            </div>
                        </div>						

                        <div id="sensorinfo" class="row">
                            <div class="col-12">
                                <div class="card-box">

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive" data-pattern="priority-columns">
                                            <table id="sensortable" class="table  table-striped">
											
                                                <thead>
                                                <tr>                                                    
                                                    <th data-priority="1">Date</th>
                                                    <th data-priority="3">Time</th>
                                                    <th data-priority="1">Light(Lux)</th>
                                                    <th data-priority="3">Soil Moisture(%)</th>
                                                    <th data-priority="3">CO<sub>2</sub>(ppm)</th>
                                                    <th data-priority="6">Temperature(°C)</th>
                                                    <th data-priority="6">Humidity(%)</th>                                                    
                                                </tr>
                                                </thead>
												<div id="sql" style="display: none;">
												<?php
                                                    $sql = "SELECT sensorinfo.date as date,sensorinfo.time as time,sensorinfo.light as light,sensorinfo.soil as soil,sensorinfo.co2 as co2,sensorinfo.temp as temp,sensorinfo.hum as hum FROM sensorinfo order by sensorinfo.id DESC LIMIT 25";                                                     
													  $result = mysqli_query($conn, $sql);
													  if (mysqli_num_rows($result) > 0) {
													  // output data of each row
													  while($row = mysqli_fetch_assoc($result)) {                                                             													  
												?>
												</div>
												 <tbody>
												
                                               
                                                <tr>                                                   
                                                    <td><?php echo $row["date"] ?></td>
                                                    <td><?php echo date("h:i:s A", strtotime($row["time"])); ?></td>
                                                    <td><?php echo $row["light"] ?></td>
                                                    <td><?php echo $row["soil"] ?></td>
                                                    <td><?php echo $row["co2"] ?></td>
                                                    <td><?php echo $row["temp"] ?></td>
													<td><?php echo $row["hum"] ?></td>                                                    
                                                </tr>
										        
                                                </tbody>
												<div id="sqlend" style="display: none;">
												<?php
												    } 
													  }else {
														echo "0 results";
														}
													//mysqli_close($conn);
												?>
												</div>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
						
						
						<div id="timekeeping" class="row">
                            <div class="col-12">
                                <div class="card-box">

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive" data-pattern="priority-columns">
                                            <table id="timekeepingtable" class="table  table-striped">
                                                <thead>
                                                <tr>                                                    
                                                    <th data-priority="1">Date</th>
                                                    <th data-priority="3">Local Time</th>
													<th data-priority="3">System Time</th>													
                                                </tr>
                                                </thead>
												<div id="sql1" style="display: none;">
												<?php
                                                    $sql1 = "SELECT timekeeping.date as tdate,timekeeping.time as ttime,timekeeping.edisontime as etime FROM timekeeping order by timekeeping.id DESC LIMIT 25";                                                     
													  $result1 = mysqli_query($conn, $sql1);
													  if (mysqli_num_rows($result1) > 0) {
													  // output data of each row
													  while($row1 = mysqli_fetch_assoc($result1)) {                                                             													  
												?>
												</div>
												 <tbody>                                               
                                                <tr>                                                   
                                                    <td><?php echo $row1["tdate"] ?></td>
                                                    <td><?php echo date("h:i:s A", strtotime($row1["ttime"])); ?></td>
													<td><?php echo date("h:i:s A", strtotime($row1["etime"])); ?></td>
                                                </tr>										        
                                                </tbody>
												<div id="sql1end" style="display: none;">
												<?php
												    } 
													  }else {
														echo "0 results";
														}
													mysqli_close($conn);
												?>
												</div>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>												
                </div> <!-- content -->

                <footer class="footer text-right">
                     DataSoft&copy; 2016 - 2017. All rights reserved.
                </footer>

            </div>
        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/plugins/peity/jquery.peity.min.js"></script>

        <!-- jQuery  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>       
        <script src="assets/plugins/raphael/raphael-min.js"></script>
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>        
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>		
		
		
    </body>
</html>