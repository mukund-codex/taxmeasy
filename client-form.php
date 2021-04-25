<?php
	include('site-config.php'); 

	$loggedInUserDetailsArr = $func->sessionExists();
    
    if(empty($loggedInUserDetailsArr) && $loggedInUserDetailsArr['user_type'] != 'client' ){
        header("location: index.php");
		exit();
	}
    
    $csrf = new csrf();
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);

    $client_id = $_GET['client_id'];

    $sql = "select cl.*, cd.client_id, cd.alternate_number, cd.pan_number, cd.aadhar_number, cd.bank_name, cd.ifsc_code, cd.yearly_income, cd.total_expenses, cd.mediclaim_amount, cd.insurance_amount, cd.rent_income, cd.housing_interest, cd.housing_repayment, cd.gender, cd.income_type, cd.document_type from clients cl LEFT JOIN client_details cd ON cl.id = cd.client_id where cl.id = ".$client_id." order by cd.id desc";
    $query = $func->query($sql);
    $data = $func->fetch($query);

    if(isset($_POST['submit'])){
		if($csrf->check_valid('post')) {	
			$result = $func->addClientDetails($_POST, $_FILES);
			header("location: client-form.php?client_id=".$client_id."&registersuccess");
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
    <title>Client Form</title>
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
        <div class="container mt-5">
            <div class="row p-5 box">
                <form role="form" action="" method="post" id="form" enctype="multipart/form-data">
                    <div class="logo text-center"><img src="images/taxmeeasy-logo.png" alt="" width="50px">
                        <h2>TAXMEASY</h2><br><br>
                        <h4>Please enter Client details</h4>
                    </div>
                    <br><br>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="name" placeholder="* Complete Name"
                                    value="<?php if(!empty($data['name'])) { echo $data['name']; } ?>">
                                <br>
                                <input type="text-area" class="form-control" name="state" placeholder="* State"
                                    value="<?php if(!empty($data['state'])) { echo $data['state']; } ?>">
                                <br>
                                <input type="text-area" class="form-control" name="address" placeholder="* Address"
                                    value="<?php if(!empty($data['address'])) { echo $data['address']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="bank_name" placeholder="* Bank Name"
                                    value="<?php if(!empty($data['bank_name'])) { echo $data['bank_name']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="total_expenses"
                                    placeholder="Total Expenses"
                                    value="<?php if(!empty($data['total_expenses'])) { echo $data['total_expenses']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="rent_income" placeholder="Rent Income"
                                    value="<?php if(!empty($data['rent_income'])) { echo $data['rent_income']; } ?>">
                                <br>
                                <div>Gender</div>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="gender" id="btnradio1"
                                        autocomplete="off" value="Male"
                                        <?php if($data['gender'] == 'Male') { echo 'checked'; } ?>>
                                    <label class="btn btn-outline-primary" for="btnradio1">MALE</label>

                                    <input type="radio" class="btn-check" name="gender" id="btnradio2"
                                        autocomplete="off" value="Female"
                                        <?php if($data['gender'] == 'Female') { echo 'checked'; } ?>>
                                    <label class="btn btn-outline-primary" for="btnradio2">FEMALE</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="pan_number" placeholder="* PAN No."
                                    value="<?php if(!empty($data['pan_number'])) { echo $data['pan_number']; } ?>">
                                <br>
                                <input type="text-area" class="form-control" name="city" placeholder="* City"
                                    value="<?php if(!empty($data['city'])) { echo $data['city']; } ?>">
                                <br>

                                <input type="text" class="form-control" name="aadhar_number" placeholder="* Aadhar No."
                                    value="<?php if(!empty($data['aadhar_number'])) { echo $data['aadhar_number']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="ifsc_code" placeholder="* Bank IFSC code"
                                    value="<?php if(!empty($data['ifsc_code'])) { echo $data['ifsc_code']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="mediclaim_amount"
                                    placeholder="Total mediclaim policy amount"
                                    value="<?php if(!empty($data['mediclaim_amount'])) { echo $data['mediclaim_amount']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="housing_interest"
                                    placeholder="Housing Loan Interest %"
                                    value="<?php if(!empty($data['housing_interest'])) { echo $data['housing_interest']; } ?>">
                                <br>

                                <div>Income</div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="income_type"
                                        id="flexRadioDefault1" value="Self Employed"
                                        <?php if($data['income_type'] == 'Self Employed') { echo 'checked'; } ?> />
                                    <label class="form-check-label" for="flexRadioDefault1"> Self Employed </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="income_type"
                                        id="flexRadioDefault2" value="Salaried"
                                        <?php if($data['income_type'] == 'Salaried') { echo 'checked'; } ?> />
                                    <label class="form-check-label" for="flexRadioDefault2"> Salaried </label>
                                </div>


                            </div>
                            <div class="col-md-4">

                                <input type="text" class="form-control" name="mobile" placeholder="* Mobile No."
                                    value="<?php if(!empty($data['mobile'])) { echo $data['mobile']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="pincode" placeholder="* Pin Code"
                                    value="<?php if(!empty($data['pincode'])) { echo $data['pincode']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="alternate_number"
                                    placeholder="Alternate No."
                                    value="<?php if(!empty($data['alternate_number'])) { echo $data['alternate_number']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="yearly_income"
                                    placeholder="Total Yearly Income"
                                    value="<?php if(!empty($data['yearly_income'])) { echo $data['yearly_income']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="insurance_amount"
                                    placeholder="Total Insurance Amount"
                                    value="<?php if(!empty($data['insurance_amount'])) { echo $data['insurance_amount']; } ?>">
                                <br>
                                <input type="text" class="form-control" name="housing_repayment"
                                    placeholder="Housing Loan Repayment"
                                    value="<?php if(!empty($data['housing_repayment'])) { echo $data['housing_repayment']; } ?>">
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputFile">
                                        Upload Bank Passbook
                                    </label>
                                    <input type="file" name="documents[]" class="form-control" id="exampleInputFile"
                                        multiple />
                                </div>
                                <?php 
                                    $docSql = "SELECT * FROM client_documents WHERE client_id = ".$data['id'];
                                        $docQuery = $func->query($docSql);
                                        $i = 1;
                                        while($docData = $func->fetch($docQuery)) {
                                            if(!empty($docData['document_url'])) {
                                ?>
                                        <a href="<?php echo $docData['document_url']; ?>" target="_blank"> View Document <?php echo $i; ?></a><br>
                                <?php $i++; } } ?>
                                <br>
                                <br><br><br>
                                <input type="hidden" name="<?php echo $token_id; ?>"
                                    value="<?php echo $token_value; ?>" />
                                <input type="hidden" name="client_id" id="client_id"
                                    value="<?php if(!empty($data['id'])) { echo $data['id']; } ?>" <div
                                    class="clearfix"><button class="btn btn-info form-control" name="submit"
                                    type="submit">SUBMIT</button>
                            </div>
                        </div>

                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>


</html>