<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();
	// $pageName = "Home Page";
	// $pageURL = 'welcome.php';
	// $addURL = 'home-carousel-add.php';
	// $deleteURL = 'home-carousel-delete.php';
	// $tableName = 'home_carousel';
    $adminData = $admin->sessionExists();
	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: index.php");
		exit();
	}

    $sql1 = "select count(id) as total_client from clients where deleted_at IS NULL";
    $results1 = $admin->query($sql1);
    $clientData = $admin->fetch($results1);

    $sql2 = "select count(id) as total_emp from employees where deleted_at IS NULL";
    $results2 = $admin->query($sql2);
    $empData = $admin->fetch($results2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Taxmeasy | Admin panel</title>
    <link rel="icon" type="image/png" href="images/fav.png">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/line-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="css/jquery.datepicker.min.css">
    <!-- calander -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <div class="panel-layout">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-page">
                        
                        <?php include('common/header.php'); ?>

                        <!-- side header -->

                        <?php include('common/topbar.php'); ?>

                        <div class="main-content">

                            <?php include('common/responsive-header.php'); ?>
                            
                            <!-- responsive header -->
                            <div class="panel-body">
                                <div class="content-area">
                                    <div class="sub-bar">
                                        <div class="sub-title">
                                            <h4>Dashboard:</h4>
                                            <span>Welcome To web Admin Panel!</span>
                                        </div>
                                        <ul class="bread-crumb">
                                            <li><a href="#" title="">Home</a></li>
                                            <li>Dashbord</li>
                                        </ul>
                                    </div>
                                    <!-- top subbar -->
                                    <div class="info-section">
                                        <div class="panel-widget">
                                            <div class="b-meta">
                                                <i class="icon-people"></i>
                                                <div class="info-meta">
                                                    <h4><?php echo $clientData['total_client']; ?></h4>
                                                    <span>Total Clients</span>
                                                </div>
                                                <!-- <span class="seventy blue"></span> -->
                                            </div>
                                        </div>
                                        <div class="panel-widget">
                                            <div class="b-meta">
                                                <i class="icon-people"></i>
                                                <div class="info-meta">
                                                    <h4><?php echo $empData['total_emp']; ?></h4>
                                                    <span>Total Employees </span>
                                                </div>
                                                <!-- <span class="fifty purpal"></span> -->
                                            </div>
                                        </div>
                                        <!-- <div class="panel-widget">
												<div class="b-meta">
													<i class="icon-like"></i>
													<div class="info-meta">
														<h4>8289</h4>
														<p>40%</p>
														<span>Email Enquiries </span> </div>
													<span class="fourty green"></span> </div>
											</div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="bottombar">
                                <span>© 2021. Taxmeasy. All Rights Reserved.</span>
                            </div>
                            <!-- bottombar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="side-panel">
        <h4 class="panel-title">General Setting</h4>
        <form method="post">
            <div class="setting-row">
                <span>use night mode</span>
                <input type="checkbox" id="nightmode1" />
                <label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Notifications</span>
                <input type="checkbox" id="switch22" />
                <label for="switch22" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Notification sound</span>
                <input type="checkbox" id="switch33" />
                <label for="switch33" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>My profile</span>
                <input type="checkbox" id="switch44" />
                <label for="switch44" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Show profile</span>
                <input type="checkbox" id="switch55" />
                <label for="switch55" data-on-label="ON" data-off-label="OFF"></label>
            </div>
        </form>
        <h4 class="panel-title">Account Setting</h4>
        <form method="post">
            <div class="setting-row">
                <span>Sub users</span>
                <input type="checkbox" id="switch66" />
                <label for="switch66" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>personal account</span>
                <input type="checkbox" id="switch77" />
                <label for="switch77" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Business account</span>
                <input type="checkbox" id="switch88" />
                <label for="switch88" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Show me online</span>
                <input type="checkbox" id="switch99" />
                <label for="switch99" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Delete history</span>
                <input type="checkbox" id="switch101" />
                <label for="switch101" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Expose author name</span>
                <input type="checkbox" id="switch111" />
                <label for="switch111" data-on-label="ON" data-off-label="OFF"></label>
            </div>
        </form>
    </div><!-- side panel -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/echart.min.js"></script>
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/calander.min.js"></script>
    <script src="js/sparkline.js"></script>
    <!-- calander -->
    <script src="js/calander-int.js"></script>
    <!-- calander -->
    <script src="js/custom.js"></script>
    <!-- scripts -->
    <script src="js/custom2.js"></script>
    <script src="js/jvectormap.js"></script><!-- jvactor map -->

</body>


<!-- Mirrored from wpkixx.com/html/wooble/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Mar 2021 14:41:23 GMT -->

</html>