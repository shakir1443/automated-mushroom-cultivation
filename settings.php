<!DOCTYPE html>
<?php
include("session.php"); 
?>
<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>AMCS Analytics</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
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
                            <li class="has_sub">
								<a  href="settings.php" class="waves-effect"><i class="ti-menu-alt"></i><span>Settings</span></a>
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
                                <h4 class="page-title">AUTOMATED MUSHROOM CULTIVATION SYSTEM</h4>
                                <p class="text-muted page-title-alt">Temperature & Time Settings Opiton</p>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="portlet" align="center"><!-- /primary heading -->
                                    
                                        <h3 class="portlet-title text-dark">
										
                                            Set Temperature
                                        </h3>
										<br>
                                        <div class="portlet-widgets">
                                            
											
                                            
                                            <input type="text" maxlength = "3" name="temp" id = "temp">
                                            <br> <br>
                                            <input type="submit" value="Submit" onclick = "temp()">
                                             
                                        </div>
										<div class="portlet-heading">
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="portlet" align="center"><!-- /primary heading -->
                                    
                                        <h3 class="portlet-title text-dark">
										&nbsp
                                            Set Time
                                        </h3>
                                        <p>i.e. 04:05 or 17:00 or 11:30</p>
										<br>
                                        <div class="portlet-widgets">
                                      
											&nbsp
                                             Time 1:
                                            <input type="text" name="time1" id = "time1">
											<br><br>
											&nbsp
											Time 2:
                                            <input type="text" name="time2" id = "time2">
											<br><br>
											&nbsp
											Time 3:
                                            <input type="text" name="time3" id = "time3">
											<br><br>
											&nbsp
											Time 4:
                                            <input type="text" name="time4" id = "time4">
											<br><br>
											&nbsp
											Time 5:
                                            <input type="text" name="time5" id = "time5">
                                            <br><br>
											&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
											<input type="submit" value="Submit" onClick="get_time()" align="center">
                                           
                                        </div>
										<div class="portlet-heading">
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                   

                            

                        </div>


                        



                        


                    </div> <!-- container -->

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

        <script src="assets/plugins/flot-chart/jquery.flot.min.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.time.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.resize.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.pie.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.selection.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.stack.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.orderBars.min.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.crosshair.js"></script>
        <script src="assets/pages/jquery.flot.init.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
		<script src="assets/js/customjs/dashboard_3.js"></script>
		

    </body>

</html>
