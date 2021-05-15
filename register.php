<?php

	include('site-config.php'); 

    $csrf = new csrf();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);

	if(isset($_POST['register'])){
		if($csrf->check_valid('post')) {
			$data = $func->clientRegister($_POST);
            header("location: index.php");
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
    <title>Registration</title>
    <link rel="icon" type="image/png" href="images/fav.png">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/line-icons.css">
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
                            <h4>Sign Up Account</h4>
                            <span>Please enter information</span>
                            <br>
                            <form method="post">
                                <input type="text" class="form-control" name="name" placeholder="First Name">
                                <br>
                                <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                                <br>
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                <br>
                                <input type="text" class="form-control" name="email" placeholder="Email Address">
                                <br>
                                <input type="text" class="form-control" name="mobile" placeholder="Mobile Number">
                                <br>
                                <input type="text" class="form-control" name="username" placeholder="Username">
                                <br>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <br>
                                <input type="password" class="form-control" name="re-password" placeholder="Confirm Password">
                                <br>
                                <input type="text" class="form-control" name="state" placeholder="State">
                                <br>
                                <input type="text" class="form-control" name="city" placeholder="City">
                                <br>
                                <input type="text" class="form-control" name="pincode" placeholder="Pincode">
                                <br>
                                <input type="text" class="form-control" name="address" placeholder="Address">
                                <br>
                                <span>Date Of Birth</span>
                                <input type="date" class="form-control" name="dob" placeholder="Date Of Birth">

                                <input type="checkbox" id="checkbox">
                                <label for="checkbox">I accept the <a href="#" title="">terms & Conditions</a></label>
                                <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>" />
                                <button type="submit" name="register">sign up</button>
                            </form>
                        <span>Already a member? <a href="employee-login.html" title="">Sign in</a></span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>