<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();
	$pageName = "Add Client Details";
	$pageURL = 'add-client-details.php';
	$tableName = 'clients';
    $subTable = 'client_details';

	if(!$loggedInUserDetailsArr = $admin->sessionExists()){
		header("location: admin-login.php");
		exit();
	}

	//include_once 'csrf.class.php';
	$csrf = new csrf();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);

	if(isset($_GET['page']) && !empty($_GET['page'])) {
		$pageNo = trim($admin->strip_all($_GET['page']));
	} else {
		$pageNo = 1;
	}
	$linkParam = "";


	$query = "SELECT COUNT(*) as num FROM ".PREFIX.$tableName;
	$total_pages = $admin->fetch($admin->query($query));
	$total_pages = $total_pages['num'];


	include_once "include/pagination.php";
	$pagination = new Pagination();
	$paginationArr = $pagination->generatePagination($pageURL, $pageNo, $total_pages, $linkParam);
 
    $client_id = $_GET['client_id'];

	$sql = "SELECT cl.*, cd.client_id, cd.alternate_number, cd.pan_number, cd.aadhar_number, cd.bank_name, cd.ifsc_code, cd.yearly_income, cd.total_expenses, cd.mediclaim_amount, cd.insurance_amount, cd.rent_income, cd.housing_interest, cd.housing_repayment, cd.gender, cd.income_type, cd.document_type FROM ".PREFIX.$tableName." cl LEFT JOIN $subTable cd ON cl.id = cd.client_id WHERE cl.id = '$client_id'";
	$results = $admin->query($sql);
    $data = $admin->fetch($results);

    if(isset($_POST['register'])) {
		if($csrf->check_valid('post')) {
            $id = trim($admin->escape_string($admin->strip_all($_POST['client_id'])));
            if(empty($data['client_id'])) {
                $result = $admin->addClientDetails($_POST, $_FILES);
            }else {
                $result = $admin->updateClientDetails($_POST, $_FILES);
            }
			header("location:".$pageURL."?updatesuccess&client_id=".$id);
			exit;
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
    <title>Taxmeasy | Client Details</title>
    <link rel="icon" type="image/png" href="images/fav.png">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/line-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
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
                                    <div class="gap inner-bg">
                                        <div class="element-title">
                                            <h4>Client Details</h4>
                                            
                                        </div>
                                        <div class="pnl-bdy billing-sec">
                                            <form role="form" action="" method="post" id="form" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label>Full Name </label>
                                                        <input type="text" value="<?php echo $data['name']; ?>" disabled>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label>Email </label>
                                                        <input type="email" value="<?php echo $data['email']; ?>" disabled>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label>Mobile </label>
                                                        <input type="text" value="<?php echo $data['mobile']; ?>" disabled>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label>State </label>
                                                        <input type="text" value="<?php echo $data['state']; ?>" disabled>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label>City </label>
                                                        <input type="text" value="<?php echo $data['city']; ?>" disabled>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label>Pincode </label>
                                                        <input type="text" value="<?php echo $data['pincode']; ?>" disabled>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 field">
                                                        <label>Address </label>
                                                        <input type="text" value="<?php echo $data['address']; ?>" disabled>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Alternate Number </label>
                                                        <input type="text" name="alternate_number" id="alternate_number" value="<?php echo $data['alternate_number']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> PAN Card Number <span>*</span></label>
                                                        <input type="text" name="pan_number" value="<?php echo $data['pan_number']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Aadhar Card Number <span>*</span></label>
                                                        <input type="text" name="aadhar_number" value="<?php echo $data['aadhar_number']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Bank Name <span>*</span></label>
                                                        <input type="text" name="bank_name" value="<?php echo $data['bank_name']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> IFSC Code <span>*</span></label>
                                                        <input type="text" name="ifsc_code" value="<?php echo $data['ifsc_code']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Yearly Income </label>
                                                        <input type="text" name="yearly_income" value="<?php echo $data['yearly_income']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Total Expenses </label>
                                                        <input type="text" name="total_expenses" value="<?php echo $data['total_expenses']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Total Mediclaim Amount </label>
                                                        <input type="text" name="mediclaim_amount" value="<?php echo $data['mediclaim_amount']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Total Insurance Amount </label>
                                                        <input type="text" name="insurance_amount" value="<?php echo $data['insurance_amount']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Rent Income </label>
                                                        <input type="text" name="rent_income" value="<?php echo $data['rent_income']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Housing Loan Interest </label>
                                                        <input type="text" name="housing_interest" value="<?php echo $data['housing_interest']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Housing Loan Repayment </label>
                                                        <input type="text" name="housing_repayment" value="<?php echo $data['housing_repayment']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Gender </label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="Male" style="width:5%;height:13px;" <?php if($data['gender'] == 'Male') { echo "checked"; } ?> >
                                                            <label class="form-check-label" for="flexRadioDefault1"> Male </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female" style="width:5%;height:13px;" <?php if($data['gender'] == 'Female') { echo "checked"; } ?> >
                                                            <label class="form-check-label" for="flexRadioDefault2"> Female </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Income Type </label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="income_type" id="flexRadioDefault1" value="Self Employed" style="width:5%;height:13px;" <?php if($data['income_type'] == 'Self Employed') { echo "checked"; } ?> >
                                                            <label class="form-check-label" for="flexRadioDefault1"> Self Employed </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="income_type" id="flexRadioDefault2" value="Salaried" style="width:5%;height:13px;" <?php if($data['income_type'] == 'Salaried') { echo "checked"; } ?> >
                                                            <label class="form-check-label" for="flexRadioDefault2"> Salaried </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label> Nature of Business </label>
                                                        <input type="text" name="nature_business" value="<?php echo $data['nature_business']; ?>">
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field"> 
                                                        <span class="upload-image">Upload Documents</span>
                                                        <label class="fileContainer"> <span>upload</span>
                                                            <input type="file" name="documents[]" class="form-control" id="exampleInputFile" multiple /><br>
                                                        </label><br>
                                                        
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <label>Uploaded Documents<label><br>
                                                        <?php $docSql = "SELECT * FROM client_documents WHERE client_id = ".$data['id'];
                                                                $docQuery = $admin->query($docSql);
                                                                $i = 1;
                                                                while($docData = $admin->fetch($docQuery)) {
                                                                    if(!empty($docData['document_url'])) {
                                                        ?>
                                                                <a href="<?php echo $docData['document_url']; ?>" target="_blank"> View Document <?php echo $i; ?></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <?php $i++; } } ?>
                                                    </div>
                                                    <div class="col-md-9 col-sm-6">
                                                       
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 field">
                                                        <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>" />
                                                        <input type="hidden" name="client_id" value="<?php echo $data['id']; ?>"/>
                                                        <button type="submit" name="register" style="margin-top:29px;float:right;"><i class="fa fa-pencil"></i>&nbsp;&nbsp;	Update Client Details</button>
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
    <script src="js/bootstrap.min.js"></script>
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/echart.min.js"></script>
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/custom2.js"></script>
    <script src="js/flatweather.min.js"></script>
    <script src="js/html5lightbox.js"></script>
    <script src="js/custom.js"></script><!-- scripts -->

</body>

<!-- Mirrored from wpkixx.com/html/wooble/tabels.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Mar 2021 14:41:43 GMT -->

</html>