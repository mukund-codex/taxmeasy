<?php

	include('site-config.php'); 

	$loggedInUserDetailsArr = $func->sessionExists();
    
    if(empty($loggedInUserDetailsArr) && $loggedInUserDetailsArr['user_type'] == 'client' ){
        header("location: client-form.php");
		exit();
	}
    $csrf = new csrf();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);

	if(isset($_POST['signin'])){
		if($csrf->check_valid('post')) {
			$func->adminlogin($_POST, "client-form.php");
		}
	}

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wpkixx.com/html/wooble/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Mar 2021 14:41:52 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Web Admin panel</title>
    <link rel="icon" type="image/png" href="images/fav.png">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
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
                <div class="col-md-12">
                    <div class="admin-lock vh100">
                        <div class="admin-form">
                            <div class="logo"><img src="images/taxmeeasy-logo.png" alt="" width="50px"></div>
                            <h4>TAXMEASY</h4>
                            <span>Please enter your user information</span>
                            <br>
                            <form method="post">
                                <input type="text" name="username" class="form-control" placeholder="Email Address" required>
                                <br>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>                                
                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>" />
                                <br>
                                <div class="clearfix"><button type="submit" name="signin" id = "signin">sign in</button></div>
                            </form>
                            <span>Don't have an account? <a href="register.php" title="">Sign up</a></span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>

<!-- Mirrored from wpkixx.com/html/wooble/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Mar 2021 14:41:52 GMT -->

</html>