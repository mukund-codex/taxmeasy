<?php
	include_once 'include/config.php';
	include_once 'include/admin-functions.php';
	$admin = new AdminFunctions();
	$pageName = "Employee List";
	$pageURL = 'employee-list.php';
	$addURL = 'add-employee.php';
	$deleteURL = 'delete-employee.php';
	$tableName = 'employees';

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

	$sql = "SELECT * FROM ".PREFIX.$tableName." WHERE deleted_at IS NULL order by created_at DESC";
	$results = $admin->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wpkixx.com/html/wooble/tabels.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Mar 2021 14:41:43 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Taxmeasy | Employee List</title>
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
                                            <h4>Employee List</h4>
                                            <a href="add-employee.php" title="" class="btn-st drk-blu-clr" style="float:right;margin-top:-20px;">Add Employee</a>
                                        </div>
                                        <div class="table-styles">
                                            <div class="widget">
                                                <table class="prj-tbl striped table-responsive">
                                                    <thead class="color">
                                                        <tr>
                                                            <th><i class="all-slct"></i></th>
                                                            <th><em>Sr No.</em></th>
                                                            <th><em>Name</em></th>
                                                            <th><em>Email</em></th>
                                                            <th><em>Mobile</em></th>
                                                            <th><em>Designation</em></th>
                                                            <th><em>Employee Code</em></th>
                                                            <th><em>Username</em></th>
                                                            <th><em>Created Date</em></th>
                                                            <th><em>Updated Date</em></th>
                                                            <th><em>Action</em></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $x = (10*$pageNo)-9;
                                                        while($row = $admin->fetch($results)){
                                                            $file_name = str_replace('', '-', strtolower( pathinfo($row['banner_img'], PATHINFO_FILENAME)));
                                                            $ext = pathinfo($row['banner_img'], PATHINFO_EXTENSION);
                                                    ?>
                                                        <tr>
                                                            <td><i class="sngl-slct"></i></td>
                                                            <td><?php echo $x++; ?></td>
                                                            <td><i><?php echo $row['name'] ?></i></td>
                                                            <td><i><?php echo $row['email'] ?></i></td>
                                                            <td><i><?php echo $row['mobile'] ?></i></td>
                                                            <td><i><?php echo $row['designation'] ?></i></td>
                                                            <td><i><?php echo $row['emp_code'] ?></i></td>
                                                            <td><i><?php echo $row['username'] ?></i></td>
                                                            <td><i><?php echo $row['created_at'] ?></i></td>
                                                            <td><i><?php echo $row['updated_at'] ?></i></td>
                                                            <td>
                                                                <a href="<?php echo $addURL; ?>?edit&id=<?php echo $row['id'] ?>" name="edit" class="" title="Click to edit this row"><i class="fa fa-pencil"></i></a>
                                                                <a class="" href="<?php echo $deleteURL; ?>?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" title="Click to delete this row, this action cannot be undone."><i class="fa fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php
							                                }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
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