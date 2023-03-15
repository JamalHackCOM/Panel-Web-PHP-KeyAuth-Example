<?php

include '../../../credentials.php';
require '../../../key.php';

session_start();

if (!isset($_SESSION['user_data'])) // if user not logged in
{
        header("Location: ../");
        exit();
}

if(isset($_POST['logout']))
{
	session_destroy();
	header("Location: ../");
    exit();
}

if ($_SESSION["normalogin"] == "ok")
{
    //RETURNS FROM NORMAL API IF USER DOESN'T HAVE HWID LOCK
    $username = $_SESSION["user_data"]["username"];
    $subscription = $_SESSION["user_data"]["subscriptions"][0]->subscription;
    $expiry = $_SESSION["user_data"]["subscriptions"][0]->expiry;
    $ip = $_SESSION["user_data"]["ip"];
    $hwid = $_SESSION["user_data"]["hwid"];
    $createdate = $_SESSION["user_data"]["createdate"];
    $lastLogin = $_SESSION["user_data"]["lastlogin"];
    //           --------  END  --------, THIS SCRIPT WILL CONTINUE NOW

} else {
    //echo "SellerKey Login <br><br>";
    $sellerkey = ""; //CHANGE THIS <---
    $tempuser = $_SESSION["tempuser"];
    //echo $tempuser; // shows ^^
    $url = "https://keyauth.win/api/seller/?sellerkey=" . $sellerkey . "&type=userdata&user=" . $tempuser;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $responsedata = curl_exec($curl);
    $response = $responsedata;
    $json = json_decode($response);
    

    if ($json->success)
    {
        // IF REQUEST SUCCESS IT WILL CONTINUE PHP FILE
    } else {
        //This will show SellerAPI Failed request as modern.
        ?>
	<?php
                exit();
    }

    //ALL THINGS FROM SELLERAPI REQUEST THAT YOU CAN USE :)
    $username = $json->username;
    $subscription = $json->subscriptions[0]->subscription;
    $timeleft = $json->subscriptions[0]->timeleft;
    $expiry = $json->subscriptions[0]->expiry;
    $ip = $json->ip;
    $hwid = $json->hwid;
    $createdate = $json->createdate;
    $lastLogin = $json->lastlogin;
    //--------  END  --------
}

$numuusers = $_SESSION["fullsession"]->appinfo->numUsers;
$numOnlineUsers = $_SESSION["fullsession"]->appinfo->numOnlineUsers;
$numKeys = $_SESSION["fullsession"]->appinfo->numKeys;
$appVersion = $_SESSION["fullsession"]->appinfo->version;
$customerPanelLink = $_SESSION["fullsession"]->appinfo->customerPanelLink;

?>
		<?php

$KeyAuthApp = new KeyAuth\api($name, $ownerid, $version);

$url = "https://keyauth.win/api/seller/?sellerkey={$sellerkey}&type=getsettings";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($curl);
$json = json_decode($resp);
$download = $json->download;
$webdownload = $json->webdownload;
$appcooldown = $json->cooldown;
?>
			<!DOCTYPE html>
			<html lang="en">

			<head>
				<!-- Required meta tags -->
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				<title>Change Log | MrGarabato</title>
				<!-- plugins:css -->
				<link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
				<link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
				<!-- endinject -->
				<!-- Plugin css for this page -->
				<link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css">
				<link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
				<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
				<script src="https://cdn.keyauth.uk/dashboard/assets/libs/jquery/dist/jquery.min.js"></script>
				<!-- Custom CSS -->
				<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
				<script src="https://cdn.keyauth.uk/dashboard/unixtolocal.js"></script>
				<!-- End plugin css for this page -->
				<!-- inject:css -->
				<!-- endinject -->
				<!-- Layout styles -->
				<link rel="stylesheet" href="../../assets/css/style.css">
				<!-- End layout styles -->
				<link rel="shortcut icon" href="/img/logo0020.png" /> </head>

			<body>
				<div class="container-scroller">
					<!-- partial:../../partials/_sidebar.html -->
					<nav class="sidebar sidebar-offcanvas" id="sidebar">
						<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
							<a class="sidebar-brand brand-logo"><img src="/img/bannerx.png" alt="logo" /></a>
							<a class="sidebar-brand brand-logo-mini"><img src="/img/logo0020.png" alt="logo" /></a>
						</div>
						<style>
						.sidebar .nav:not(.sub-menu) > .nav-item:hover:not(.nav-category):not(.account-dropdown) > .nav-link {
							background: #010409c7!important
						}
						
						.sidebar .nav .nav-item .menu-icon {
							background: #21262d!important;
						}
						
						.preview-icon {
							background: #21262d!important;
						}
						
						.navbar-dropdown {
							background: #161b22!important;
						}
						
						.content-wrapper {
							background: #010409!important;
						}
						
						.navbar .navbar-brand-wrapper {
							background: #161b22;
						}
						
						.footer {
							background: #010409!important;
						}
						
						.sidebar {
							background: #0d1117;
						}
						
						.navbar {
							background: #161b22;
						}
						
						.sidebar .sidebar-brand-wrapper {
							background: #161b22!important;
						}
						
						.card {
							background-color: #0d1117;
							border-color: #30363d!important;
							border-style: solid;
							border-width: 1px;
							border-radius: 6px;
						}
						
						.sidebar .nav .nav-item.active > .nav-link {
							background: #010409!important;
						}
						
						.navbar .navbar-brand-wrapper .navbar-brand.brand-logo-mini img {
							width: calc(70px - 40px);
							max-width: 100%;
							height: 28px;
							margin: auto;
						}
						
						.sidebar .sidebar-brand-wrapper .sidebar-brand.brand-logo-mini img {
							width: calc(70px - 40px);
							max-width: 100%;
							height: 28px;
							margin: auto;
						}
						
						.navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown .dropdown-item {
							margin-bottom: 0;
							padding: 11px 13px;
							padding-top: 11px;
							padding-right: 13px;
							padding-bottom: 11px;
							padding-left: 13px;
							cursor: pointer;
						}
						
						.dropdown-item {
							display: none;
						}
						
						.btn-outline-custom.active,
						.btn-outline-custom:active,
						.btn-outline-custom.focus,
						.btn-outline-custom:focus,
						.btn-outline-custom:not(:disabled):hover,
						.btn-custom.focus,
						.btn-custom:focus,
						.btn-custom:not(:disabled):hover {
							color: #fff!important;
						}
						
						.bg-custom,
						.btn-custom,
						.nav-pills .nav-link.active,
						.nav-pills .show>.nav-link {
							color: #fff;
						}
						
						:root {
							color-scheme: dark;
						}
						</style>
						<style type="text/css">
						.size-thumbnail {
							max-width: 100%;
							height: auto
						}
						
						a:link {
							text-decoration: none
						}
						
						* {
							max-width: none
						}
						
						a {
							cursor: pointer
						}
						
						a img {
							border: 0
						}
						
						.fn-header-row-break {
							background: #222;
							color: white
						}
						
						.fn-break-inner {
							overflow: hidden;
							position: relative
						}
						
						.fn-break h2 {
							margin: 0;
							font-size: 20px!important;
							line-height: 60px!important;
							height: 60px;
							padding-left: 20px;
							background: #0d1117;
							float: left;
							position: relative;
							z-index: 1
						}
						
						.fn-break h2 .fa {
							font-size: 20px
						}
						
						.fn-break-gradient {
							float: left;
							position: relative;
							z-index: 1;
							width: 20px;
							background: #0d1117;
							height: 60px
						}
						
						.fn-break-gradient.left {
							box-shadow: 10px 10px 17px #121820
						}
						
						.fn-break-gradient.right {
							float: right;
							box-shadow: -10px -10px 17px #121820
						}
						
						.fn-break .fn-break-content {
							width: 99999px;
							max-width: none;
							position: relative
						}
						
						.fn-break .fn-break-content>ul {
							height: 60px;
							margin: 0;
							z-index: 0;
							position: absolute;
							top: 0;
							left: -100%;
							padding: 0
						}
						
						.fn-break .item {
							display: inline-block
						}
						
						.fn-break .item .item-categories {
							display: block;
							margin: 21.5px 10px 0 0;
							height: 20px;
							line-height: 20px;
							font-size: 10px;
							padding: 0 5px;
							text-transform: uppercase;
							position: relative;
							float: left
						}
						
						.fn-break .item .item-categories a {
							color: white;
							display: block;
							line-height: 20px
						}
						
						.fn-break .item .item-title {
							display: inline-block;
							line-height: 60px;
							height: 60px;
							margin: 0;
							padding: 0 40px 0 0;
							opacity: .8
						}
						
						.fn-break .item .item-title a {
							color: white;
							font-weight: normal;
							font-size: 16px
						}
						
						.fn-primary {
							margin: 0 auto;
							border-top: 1px solid transparent
						}
						</style>
						<ul class="nav">
							<li class="nav-item profile">
								<div class="profile-desc">
									<div class="profile-pic">
										<div class="count-indicator"> <img class="img-xs rounded-circle " src="/img/usernull.png" alt=""> <span class="count bg-success"></span> </div>
										<div class="profile-name">
											<h5 class="mb-0 font-weight-normal"><?php echo $username; ?></h5> <span><?php echo $subscription; ?></span> </div>
									</div>
									<li class="nav-item nav-category"> <span class="nav-link">Home</span> </li>
									<li class="nav-item menu-items">
										<a class="nav-link" href="/dashboard/"> <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span> <span class="menu-title">Dashboard</span> </a>
										<li class="nav-item nav-category"> <span class="nav-link">Products</span> </li>
										<li class="nav-item menu-items">
											<a class="nav-link" href="../../pages/download/"> <span class="menu-icon">
                <i class="mdi mdi-download"></i>
              </span> <span class="menu-title">Download</span> </a>
										</li>
										<li class="nav-item menu-items">
											<a class="nav-link" href="https://discord.gg/uUsVxrZzzu" target="_blank"> <span class="menu-icon">
                <i class="mdi mdi-account-circle"></i>
              </span> <span class="menu-title">Support</span> </a>
										</li>
										<li class="nav-item menu-items active">
											<a class="nav-link" href="../../pages/changelog/"> <span class="menu-icon">
                <i class="mdi mdi-book-minus"></i>
              </span> <span class="menu-title">Change Log</span> </a>
										</li>
						</ul>
					</nav>
					<!-- partial -->
					<div class="container-fluid page-body-wrapper">
						<!-- partial:../../partials/_navbar.html -->
						<nav class="navbar p-0 fixed-top d-flex flex-row">
							<div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
								<a class="navbar-brand brand-logo-mini"><img src="/img/logo02.png" alt="logo" /></a>
							</div>
							<div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
								<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"> <span class="mdi mdi-menu"></span> </button>
								<ul class="navbar-nav navbar-nav-right">
									<li class="nav-item dropdown d-none d-lg-block">
										<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
											<h6 class="p-3 mb-0">Projects</h6>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item preview-item">
												<div class="preview-thumbnail">
													<div class="preview-icon bg-dark rounded-circle"> <i class="mdi mdi-file-outline text-primary"></i> </div>
												</div>
												<div class="preview-item-content">
													<p class="preview-subject ellipsis mb-1">Software Development</p>
												</div>
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item preview-item">
												<div class="preview-thumbnail">
													<div class="preview-icon bg-dark rounded-circle"> <i class="mdi mdi-web text-info"></i> </div>
												</div>
												<div class="preview-item-content">
													<p class="preview-subject ellipsis mb-1">UI Development</p>
												</div>
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item preview-item">
												<div class="preview-thumbnail">
													<div class="preview-icon bg-dark rounded-circle"> <i class="mdi mdi-layers text-danger"></i> </div>
												</div>
												<div class="preview-item-content">
													<p class="preview-subject ellipsis mb-1">Software Testing</p>
												</div>
											</a>
											<div class="dropdown-divider"></div>
											<p class="p-3 mb-0 text-center">See all projects</p>
										</div>
									</li>
									<li class="nav-item dropdown border-left">
										<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
											<h6 class="p-3 mb-0">Messages</h6>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item preview-item">
												<div class="preview-thumbnail"> <img src="assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic"> </div>
												<div class="preview-item-content">
													<p class="preview-subject ellipsis mb-1">Mark send you a message</p>
													<p class="text-muted mb-0"> 1 Minutes ago </p>
												</div>
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item preview-item">
												<div class="preview-thumbnail"> <img src="assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic"> </div>
												<div class="preview-item-content">
													<p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
													<p class="text-muted mb-0"> 15 Minutes ago </p>
												</div>
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item preview-item">
												<div class="preview-thumbnail"> <img src="assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic"> </div>
												<div class="preview-item-content">
													<p class="preview-subject ellipsis mb-1">Profile picture updated</p>
													<p class="text-muted mb-0"> 18 Minutes ago </p>
												</div>
											</a>
											<div class="dropdown-divider"></div>
											<p class="p-3 mb-0 text-center">4 new messages</p>
										</div>
									</li>
									<li class="nav-item dropdown border-left">
										<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown"> <i class="mdi mdi-bell"></i> <span class="count bg-danger"></span> </a>
										<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
											<h6 class="p-3 mb-0">Notifications</h6>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item preview-item">
												<div class="preview-thumbnail">
													<div class="preview-icon bg-dark rounded-circle"> <i class="mdi mdi-calendar text-success"></i> </div>
												</div>
												<div class="preview-item-content">
													<p class="preview-subject mb-1">New update</p>
													<p class="text-muted ellipsis mb-0"> We are working on it </p>
												</div>
											</a>
									</li>
									<li class="nav-item dropdown">
										<a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
											<div class="navbar-profile"> <img class="img-xs rounded-circle" src="/img/usernull.png" alt="">
												<p class="mb-0 d-none d-sm-block navbar-profile-name">
													<?php echo $username; ?>
												</p> <i class="mdi mdi-menu-down d-none d-sm-block"></i> </div>
										</a>
										<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
											<h6 class="p-3 mb-0">Profile</h6>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item preview-item">
												<div class="preview-thumbnail">
													<div class="preview-icon bg-dark rounded-circle"> <i class="mdi mdi-logout text-danger"></i> </div>
												</div>
												<div class="preview-item-content">
													<form method="POST">
														<button class="btn btn-outline-custom me-0" style="padding-left: 0;" name="logout">Log out</button>
													</form>
												</div>
											</a>
									</li>
								</ul>
								<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas"> <span class="mdi mdi-format-line-spacing"></span> </button>
								</div>
						</nav>
						<!-- partial -->
						<div class="main-panel">
							<div class="content-wrapper">
								<div class="page-header">
									<h3 class="page-title">UI_MrGarabato</h3>
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="/dashboard/">Home</a></li>
											<li class="breadcrumb-item active" aria-current="page">Change Log</li>
										</ol>
									</nav>
								</div>
								<div class="row">
									<div class="col-lg-6 grid-margin stretch-card">
										<div class="card">
											<div class="card-body">
												<h4 class="card-title">Change Log</h4>
												<div class="col-12">
													<ul>
														<li class="mb-3"> <strong><span class="text-bold text-success">Current version <?php echo $appVersion; ?></span></strong>
															<ul>
																<li><span class="text-bold text-danger">Version 2.8</span></li>
																<li><span class="text-bold text-danger">Version 2.7</span></li>
																<li><span class="text-bold text-danger">Version 2.6</span></li>
																<li><span class="text-bold text-danger">Version 2.5</span></li>
																<li><span class="text-bold text-danger">Version 2.4</span></li>
																<li><span class="text-bold text-danger">Version 2.3</span></li>
																<li><span class="text-bold text-danger">Version 2.2</span></li>
																<li><span class="text-bold text-danger">Version 2.1</span></li>
																<li><span class="text-bold text-danger">Version 2.0</span></li>
															</ul>
														</li>
														<li class="mb-3"> <strong><span class="text-bold text-danger">version 1.9</span></strong>
															<ul>
																<li><span class="text-bold text-danger">Version 1.8</span></li>
																<li><span class="text-bold text-danger">Version 1.7</span></li>
																<li><span class="text-bold text-danger">Version 1.6</span></li>
																<li><span class="text-bold text-danger">Version 1.5</span></li>
																<li><span class="text-bold text-danger">Version 1.4</span></li>
																<li><span class="text-bold text-danger">Version 1.3</span></li>
																<li><span class="text-bold text-danger">Version 1.2</span></li>
																<li><span class="text-bold text-danger">Version 1.1</span></li>
																<li><span class="text-bold text-info">Initial Release Version 1.0</span></li>
															</ul>
														</li>
												</div>
											</div>
										</div>
									</div>
									<!-- content-wrapper ends -->
									<!-- partial:../../partials/_footer.html -->
									<style>
									.footer a {
										color: #9665ff;
										font-size: inherit;
									}
									</style>
									<footer class="footer">
										<br>
										<br>
										<br>
										<div class="d-sm-flex justify-content-center justify-content-sm-between"> <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © MrGarabato | Created with ❤ by <a href="https://discord.com/users/959935214895890532"target="_blank"><span>Zarfala</span></a>
											</span>
										</div>
									</footer>
									<!-- partial -->
								</div>
								<!-- main-panel ends -->
							</div>
							<!-- page-body-wrapper ends -->
						</div>
						<!-- container-scroller -->
						<!-- plugins:js -->
						<script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
						<!-- endinject -->
						<!-- Plugin js for this page -->
						<!-- End plugin js for this page -->
						<!-- inject:js -->
						<script src="../../assets/js/off-canvas.js"></script>
						<script src="../../assets/js/hoverable-collapse.js"></script>
						<script src="../../assets/js/misc.js"></script>
						<script src="../../assets/js/settings.js"></script>
						<script src="../../assets/js/todolist.js"></script>
						<!-- endinject -->
						<!-- Custom js for this page -->
						<!-- End custom js for this page -->
			</body>

			</html>