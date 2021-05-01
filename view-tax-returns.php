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

    $sql = "SELECT cr.*, cl.name, cl.email, cl.mobile, cl.username FROM client_returns cr JOIN clients cl ON cl.id = cr.client_id WHERE cr.deleted_at = '0000-00-00 00:00:00' AND cl.id = '".$client_id."'  order by cr.created_at DESC";
    $query = $func->query($sql);

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
        <div class="" style="overflow:hidden;">
            <br><br>
            <div class="logo text-center"><img src="images/taxmeeasy-logo.png" alt="" width="50px">
                <h2>TAXMEASY</h2><br><br>
                <h4>Tax Return Documents</h4>
            </div>
            <br><br>
            <div class="row p-5 box">
                <div class="widget">
                    <table class="prj-tbl striped bordered table-responsive">
                        <thead class="">
                            <tr>
                                <th><em>ID</em></th>
                                <th><em>Name</em></th>
                                <th><em>Email</em></th>
                                <th><em>Mobile</em></th>
                                <th><em>Tax Return Document</em></th>
                                <th><em>Date</em></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; while($data = $func->fetch($query)) { $document_url = substr($data['document_url'], 3); ?>
                            <tr>
                                <td><span><?php echo $i; ?></span></td>
                                <td><i><?php echo $data['name']; ?></i></td>
                                <td><i><?php echo $data['email']; ?></i></td>
                                <td><i><?php echo $data['mobile']; ?></i></td>
                                <td><i><a href="<?php echo $document_url; ?>">View Tax Return Document</a></i></td>
                                <td><i><?php echo $data['created_at']; ?></i></td>
                            </tr>
                        <?php $i++; } ?>
                        </tbody>
                    </table>
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