<!DOCTYPE html>
<?php
include("session.php"); 
?>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>AUTOMATED MUSHROOM CULTIVATION SYSTEM</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/slider.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/socket.io.min.js"></script>
		<script src="assets/js/customjs/index.js"></script>
		
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
										<h5><span class="badge badge-danger float-right "></span>Notification</h5>
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
                                <a href="#" class="dropdown-item notify-item">
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

            <div class="left side-menu fixed-left">
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
                                  <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Set Environment</button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#" onclick="oyesterimg()">OYSTER</a>
                                        <a class="dropdown-item" href="#" onclick="shitakeimg()">SHITAKE</a>
                                        <a class="dropdown-item" href="#" onclick="buttonimg()">BUTTON</a>
                                        <a class="dropdown-item" href="#" onclick="milkyimg()">MILKY</a>
                                    </div>																
                                </div>

                                <h4 class="page-title">AUTOMATED MUSHROOM CULTIVATION SYSTEM</h4>
                                <p class="text-muted page-title-alt">Control Panel</p>
                            </div>
                        </div>

                        <div class="row">
						    <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon pull-left">
									    <img id="mush-img" src="image/oyester.png" height="80" width="80"/>
										
                                    </div>									
                                    <div class="text-right">
										<h3 id="mush-name"><b>OYSTER</b></h3>									
                                        <p class="text-muted mb-0">MUSHROOM</p>
                                    </div>									
                                    <div class="clearfix"></div>
                                </div>
                            </div>
							<div id="sql" style="display: none;">
							<?php								
								$sql = "SELECT * FROM sensorinfo ORDER BY id DESC LIMIT 1";
								$result = mysqli_query($conn, $sql);
								if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) { 
							?>
							</div>
							
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon pull-left">
                                        <input class="knob" data-width="80" data-height="150" data-linecap=round data-fgColor="#02edd1" value="<?php echo $row["hum"]; ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".20"/>
                                    </div>
                                    <div class="text-right">
									<script>  var a =10;</script>
                                        <h3 class="text-dark"><b class="counter"><?php echo $row["hum"]; ?></b>%</h3>
                                        <p class="text-muted mb-0">HUMIDITY</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div id="light" class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon pull-left">
                                        <input class="knob" data-width="80" data-height="150" data-linecap=round data-fgColor="#02edd1" value="<?php echo $row["light"]; ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".20"/>
                                    </div>
                                    <div class="text-right">
									<script>  var a =10;</script>
                                        <h3 class="text-dark"><b class="counter"><?php echo $row["light"]; ?></b></h3>
                                        <p class="text-muted mb-0">LIGHT(LUX)</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div id="temp" class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon pull-left">
                                        <input class="knob" data-width="80" data-height="150" data-linecap=round data-fgColor="#ef8a2b" value="<?php echo $row["temp"]; ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".20"/>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><b class="counter"><?php echo $row["temp"]; ?></b>°C</h3>
                                        <p class="text-muted mb-0">TEMPERATURE</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                           <div id="soil" class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon pull-left">
                                        <input class="knob" data-width="80" data-height="150" data-linecap=round data-fgColor="#5fe28d" value="<?php echo $row["soil"]; ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".20"/>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><b class="counter"><?php echo $row["soil"]; ?></b>%</h3>
                                        <p class="text-muted mb-0">SOIL MOISTURE</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
							
							<div id="co2" class="col-md-6 col-lg-6 col-xl-4">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon pull-left">
                                        <input class="knob" data-width="80" data-height="150" data-linecap=round data-fgColor="#69777a" value="<?php echo $row["co2"]/10; ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".20"/>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><b class="counter"><?php echo $row["co2"]; ?></b></h3>
                                        <p class="text-muted mb-0">CO<sub>2</sub>(PPM)</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
							<div id="sql1" style="display: none;">
							<?php 
									}
								} 
								mysqli_close($conn);
							?>
							</div>
							
							<div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon pull-left">
                                        <img id="fan-img" src="image/fanstop.png" height="100" width="100"/>
                                    </div>
                                    <div class="text-right">
                                        <label class="switch">
										  <input type="checkbox" id="fan-slider" onclick="fanOn()">
										  <span class="slider"></span>
										</label>
                                        <h2 class="text-muted mb-0">FAN</h2>
                                    </div>									
                                    <div class="clearfix"></div>
                                </div>
                            </div>
							
							<div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon pull-left">
									    <img id="water-img" src="image/waterstop.png" height="100" width="100"/>
                                    </div>
                                    <div class="text-right">
                                       <label class="switch">
										  <input type="checkbox" id="water-slider" onclick="waterOn()">
										  <span class="slider"></span>
										</label>										
                                       <h2 class="text-muted mb-0">WATER</h2>
                                    </div>									
                                    <div class="clearfix"></div>
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