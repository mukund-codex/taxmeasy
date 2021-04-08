<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();
	$pageName = "Employee";
	$parentPageURL = 'employee-list.php';
	$pageURL = 'add-employee.php';

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}

	//include_once 'csrf.class.php';
	$csrf = new csrf();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);

	if(isset($_POST['register'])){
		if($csrf->check_valid('post')) {			
			$result = $admin->addEmployee($_POST);
			header("location:".$pageURL."?registersuccess");
			exit;
		}
	}

	if(isset($_GET['edit'])){
		$id = $admin->escape_string($admin->strip_all($_GET['id']));
		$data = $admin->getUniqueEmployeeById($id);
	}

	if(isset($_POST['update'])) {
		if($csrf->check_valid('post')) {
			$id = trim($admin->escape_string($admin->strip_all($_POST['id'])));
			$result = $admin->updateEmployee($_POST);
			header("location:".$pageURL."?updatesuccess&edit&id=".$id);
			exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wpkixx.com/html/wooble/edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Mar 2021 14:41:52 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Taxmeasy | Add Employee</title>
    <link rel="icon" type="image/png" href="images/fav.png">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/line-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="css/jquery.datepicker.min.css">
    <!-- calander -->
    <link rel="stylesheet" href="css/flatweather.css">
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
                                    <div class="inner-bg">
                                        <div class="element-title">
                                            <h4>Add Employee</h4>
                                        </div>
                                        <div class="pnl-bdy billing-sec">
                                            <form method="post">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 field">
                                                        <label>Full Name <span>*</span> </label>
                                                        <input type="text" name="name" id="name" placeholder="Full Name" value="<?php if(isset($_GET['edit'])){ echo $data['name']; }?>" required>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 field">
                                                        <label>Email <span>*</span> </label>
                                                        <input type="email" name="email" id="email" placeholder="Email ID" value="<?php if(isset($_GET['edit'])){ echo $data['email']; }?>" required>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 field">
                                                        <label>Mobile <span>*</span> </label>
                                                        <input type="text" name="mobile" id="mobile" placeholder="Mobile Number" value="<?php if(isset($_GET['edit'])){ echo $data['mobile']; }?>" required>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 field">
                                                        <label>Designation </label>
                                                        <input type="text" name="designation" id="designation" placeholder="Designation" value="<?php if(isset($_GET['edit'])){ echo $data['designation']; }?>">
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 field">
                                                        <label>Username </label>
                                                        <input type="text" name="username" id="username" placeholder="Username" required value="<?php if(isset($_GET['edit'])){ echo $data['username']; }?>">
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 field">
                                                        <label>Password </label>
                                                        <input type="password" name="password" id="password" placeholder="Password" value="<?php if(isset($_GET['edit'])){ echo $data['password']; }?>" required>
                                                    </div>
                                                    <div class="col-md-10 col-sm-6 field">
                                                        <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>" />
                                                    </div>
                                                    <div class="col-md-2 col-sm-6 field">
                                                    <?php
                                                        if(isset($_GET['edit'])){ ?>
                                                            <input type="hidden" class="form-control" name="id" id="" required="required" value="<?php echo $id ?>"/>
                                                            <button type="submit" name="update" ><i class="fa fa-pencil"></i>Update <?php echo $pageName; ?></button>
                                                    <?php }else { ?>
                                                            <button type="submit" name="register" ><i class="icon-signup"></i>Add <?php echo $pageName; ?></button>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                            </form>
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

    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/echart.min.js"></script>
    <script src="js/nice-select.js"></script>
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/custom2.js"></script>
    <script src="js/flatweather.min.js"></script>
    <script src="js/html5lightbox.js"></script>
    <script src="js/custom.js"></script><!-- scripts -->

</body>

<!-- Mirrored from wpkixx.com/html/wooble/edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Mar 2021 14:41:52 GMT -->

</html>