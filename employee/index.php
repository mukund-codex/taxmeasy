<?php
	include 'include/config.php';
	include 'include/admin-functions.php';
	$admin = new AdminFunctions();
    
    $loggedInUserDetailsArr = $admin->sessionExists();

	if($loggedInUserDetailsArr && $loggedInUserDetailsArr['user_type'] == 'employee' ){
		header("location: dashboard.php");
		exit();
	}

    // if($loggedInUserDetailsArr['user_type'] != 'employee') {
    //     header("location: index.php");
    //     exit();
    // }

	$csrf = new csrf();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);
	
	if(isset($_POST['signin'])){
		if($csrf->check_valid('post')) {
			$admin->adminlogin  ($_POST, "dashboard.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Web Admin panel</title>
    <link rel="icon" type="image/png" href="images/fav.png">
    <link rel="stylesheet" href="css_new/font-awesome.min.css">
    <link rel="stylesheet" href="css_new/bootstrap.min.css">
    <link rel="stylesheet" href="css_new/animate.min.css">
    <link rel="stylesheet" href="css_new/style.css">
    <link rel="stylesheet" href="css_new/color.css">
    <link rel="stylesheet" href="css_new/responsive.css">
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
                <div class="col-md-12">
                    <div class="admin-lock vh100">
                        <div class="admin-form">
                            <div class="logo"><img src="images/taxmeeasy-logo.png" alt="" width="50px"></div>
                            <h4>TAXMEASY</h4>
                            <span>Please enter your information</span>
                            <br>
                            <form method="post">
                                <input type="text" class="form-control" id="inputEmail" placeholder="User Name" name="username" required autofocus>
                                <br>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password" autocomplete="off" name="password" required>
                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>" />
                                <br>
                                <div class="clearfix"><button  name="signin" type="submit">sign in</button></div>
                            </form>
                            <!-- <span>Don't have an account? <a href="register.html" title="">Sign up</a></span> </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js_new/jquery.js"></script>
    <script src="js_new/bootstrap.min.js"></script>
    <script src="js_new/custom.js"></script>
</body>

<!-- Mirrored from wpkixx.com/html/wooble/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Mar 2021 14:41:52 GMT -->

</html>