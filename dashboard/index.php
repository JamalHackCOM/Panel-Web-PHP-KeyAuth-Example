<?php

include '../auth/Credentials.php';
require '../auth/Bypass.php';

session_start();

if (!isset($_SESSION['user_data'])) // if user not logged in
{
        header("Location: ../");
        exit();
}

if(isset($_POST['logout']))
{
	session_destroy();
	header("Location: /");
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
$cooldown = $json->cooldown;
$token = $json->token;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panel | ZetroCode</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/img/logo0020.png" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdn.keyauth.uk/dashboard/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Custom CSS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.keyauth.uk/dashboard/unixtolocal.js"></script>
</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0"> </div>
        </div>
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo"><img src="../assets/img/bannerx.png" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini"><img src="../assets/img/logo0020.png" alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator"> <img class="img-xs rounded-circle "
                                    src="../assets/img/usernull.png" alt=""> <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal"><?php echo $username; ?></h5>
                                <span><?php echo $subscription; ?></span>
                            </div>
                        </div>
                <li class="nav-item nav-category"> <span class="nav-link">Home</span> </li>
                <li class="nav-item menu-items active">
                    <a class="nav-link" href="/dashboard/"> <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span> <span class="menu-title">Dashboard</span> </a>
                <li class="nav-item nav-category"> <span class="nav-link">Products</span> </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../../dashboard/pages/download/"> <span class="menu-icon">
                            <i class="mdi mdi-download"></i>
                        </span> <span class="menu-title">Download</span> </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="" target="_blank"> <span class="menu-icon">
                            <i class="mdi mdi-account-circle"></i>
                        </span> <span class="menu-title">Support</span> </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../../dashboard/pages/changelog/"> <span class="menu-icon">
                            <i class="mdi mdi-book-minus"></i>
                        </span> <span class="menu-title">Change Log</span> </a>
                </li>
            </ul>
        </nav>
        <style>
        .sidebar .nav:not(.sub-menu)>.nav-item:hover:not(.nav-category):not(.account-dropdown)>.nav-link {
            background: #010409c7 !important
        }

        .sidebar .nav .nav-item .menu-icon {
            background: #21262d !important;
        }

        .preview-icon {
            background: #21262d !important;
        }

        .navbar-dropdown {
            background: #161b22 !important;
        }

        .content-wrapper {
            background: #010409 !important;
        }

        .navbar .navbar-brand-wrapper {
            background: #161b22;
        }

        .footer {
            background: #010409 !important;
        }

        .sidebar {
            background: #0d1117;
        }

        .navbar {
            background: #161b22;
        }

        .sidebar .sidebar-brand-wrapper {
            background: #161b22 !important;
        }

        .card {
            background-color: #0d1117;
            border-color: #30363d !important;
            border-style: solid;
            border-width: 1px;
            border-radius: 6px;
        }

        .sidebar .nav .nav-item.active>.nav-link {
            background: #010409 !important;
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
            color: #fff !important;
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
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini"><img src="../assets/img/logo0020.png" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize"> <span class="mdi mdi-menu"></span> </button>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown d-none d-lg-block">
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="createbuttonDropdown">
                                <h6 class="p-3 mb-0">Projects</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle"> <i
                                                class="mdi mdi-file-outline text-primary"></i> </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Software Development</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle"> <i
                                                class="mdi mdi-web text-info"></i> </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">UI Development</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle"> <i
                                                class="mdi mdi-layers text-danger"></i> </div>
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
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="messageDropdown">
                                <h6 class="p-3 mb-0">Messages</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail"> <img src="assets/images/faces/face4.jpg" alt="image"
                                            class="rounded-circle profile-pic"> </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                                        <p class="text-muted mb-0"> 1 Minutes ago </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail"> <img src="assets/images/faces/face2.jpg" alt="image"
                                            class="rounded-circle profile-pic"> </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                                        <p class="text-muted mb-0"> 15 Minutes ago </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail"> <img src="assets/images/faces/face3.jpg" alt="image"
                                            class="rounded-circle profile-pic"> </div>
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
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-bs-toggle="dropdown"> <i class="mdi mdi-bell"></i> <span
                                    class="count bg-danger"></span> </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                <h6 class="p-3 mb-0">Notifications</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle"> <i
                                                class="mdi mdi-bell text-danger"></i> </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Bypass</p>
                                        <p class="text-muted ellipsis mb-0"> Null </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle"> <i
                                                class="mdi mdi-calendar text-success"></i> </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">New update</p>
                                        <p class="text-muted ellipsis mb-0"> We are working on it </p>
                                    </div>
                                </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                <div class="navbar-profile"> <img class="img-xs rounded-circle"
                                        src="../assets/img/usernull.png" alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">
                                        <?php echo $username; ?>
                                    </p> <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Profile</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle"> <i
                                                class="mdi mdi-logout text-danger"></i> </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <form method="POST">
                                            <button class="btn btn-outline-custom me-0" style="padding-left: 0;"
                                                name="logout">Log out</button>
                                        </form>
                                    </div>
                                </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas"> <span class="mdi mdi-format-line-spacing"></span> </button>
                </div>
                <!-- <?php include_once('../assets/welcome-popup.php'); ?> -->
            </nav>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
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
                        background: #0d1117;
                        color: white
                    }

                    .fn-break-inner {
                        overflow: hidden;
                        position: relative
                    }

                    .fn-break h2 {
                        margin: 0;
                        font-size: 20px !important;
                        line-height: 60px !important;
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
                    <style type="text/css">
                    a,
                    a:hover,
                    .color,
                    .item-top .item-title a:hover,
                    .item-bot .item-title a:hover {
                        color: #D12F2F
                    }

                    .border,
                    .sneeit-percent-fill,
                    .sneeit-percent-mask,
                    .fn-bh-text-bg-bot-border .fn-block-title,
                    .fn-bh-bot-border .fn-block-title,
                    .sneeit-articles-pagination-content>a:hover,
                    .sneeit-percent-fill,
                    .sneeit-percent-mask {
                        border-color: #D12F2F
                    }

                    .bg,
                    .fn-block .item-mid .item-categories,
                    .fn-bh-text-bg-bot-border .fn-block-title-text,
                    .fn-bh-full-bg .fn-block-title,
                    .fn-block .item-meta .item-categories,
                    .sneeit-articles-pagination-content>a:hover,
                    .fn-block-mega-menu .sneeit-articles-pagination-content>a,
                    .fn-item-hl .item-big .item-bot-content,
                    .fn-item-hl .item-big .item-top,
                    .fn-item-hl .fn-blog .item-bot-content,
                    .fn-item-hl .fn-blog .item-top,
                    .fn-break .item .item-categories,
                    a.scroll-up,
                    input[type="submit"] {
                        background-color: #fc424a;
                        border-radius: 0.25rem;
                    </style>
                    <script type='text/javascript' id='flatnews-main-js-extra'>
                    /* <![CDATA[ */
                    var flatnews = {
                        "text": {
                            "Copy All Code": "Copy All Code",
                            "Select All Code": "Select All Code",
                            "All codes were copied to your clipboard": "All codes were copied to your clipboard",
                            "Can not copy the codes \/ texts, please press [CTRL]+[C] (or CMD+C with Mac) to copy": "Can not copy the codes \/ texts, please press [CTRL]+[C] (or CMD+C with Mac) to copy",
                            "THIS PREMIUM CONTENT IS LOCKED": "THIS PREMIUM CONTENT IS LOCKED",
                            "STEP 1: Share to a social network": "STEP 1: Share to a social network",
                            "STEP 2: Click the link on your social network": "STEP 2: Click the link on your social network"
                        },
                        "ajax_url": "https:\/\/demo.sneeit.com\/flatnews\/wp-admin\/admin-ajax.php",
                        "is_rtl": "",
                        "is_gpsi": "",
                        "facebook_app_id": "403849583055028",
                        "disqus_short_name": "magonetemplate",
                        "primary_comment_system": "wordpress",
                        "locale": "en_US"
                    };
                    /* ]]> */
                    </script>
                    <script type='text/javascript' src='js/main.min.js?ver=5.1' id='flatnews-main-js'></script>
                    <div class="fn-header-row fn-header-row-break">
                        <div class="fn-header-row-inner">
                            <div class="fn-break">
                                <div class="fn-break-inner">
                                    <h2>NOTICES <i class="fa fa-flash"></i></h2>
                                    <div class="fn-break-gradient left"></div>
                                    <div class="fn-break-content">
                                        <ul>
                                            <li class="item item-0"><span
                                                    class="item-categories"><a>IMPOARTANT</a></span>
                                                <h3 class="item-title"><a href="./pages/download/"><span> WITH THE RESET
                                                            IMEI PROGRAM DELETE YOUR EMULATOR TO AVOID BLACKLIST </span>
                                                        <span class="text-success">(Click here)</span><span> TO
                                                            DOWNLOAD</span>
                                                    </a></h3>
                                            </li>
                                            <li class="item item-1"><span class="item-categories"><a>NEW
                                                        UPDATE</a></span>
                                                <h3 class="item-title"><a href="./pages/download/"><span> NEW VERSION OF
                                                            THE PANEL <?php echo $appVersion; ?> AVAILABLE </span> <span
                                                            class="text-success">(Click here)</span><span> TO
                                                            DOWNLOAD</span>
                                                    </a></h3>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fn-break-gradient right"></div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <br>
                    <style>
                    .fn-header-row-break {
                        background-color: #0d1117;
                        border-color: #30363d !important;
                        border-style: solid;
                        border-width: 1px;
                        border-radius: 6px;
                    }
                    </style>
                    <div class="row">
                        <div class="col-sm-4 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Registered users</h5>
                                    <div class="row">
                                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                                <h2 class="mb-0"><?php echo $numuusers; ?></h2>
                                                <p class="text-success ms-2 mb-0 font-weight-medium">Activated</p>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right"> <i
                                                class="icon-lg mdi mdi-signal text-primary ms-auto"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Expire</h5>
                                    <div class="row">
                                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                                <h3 class="mb-0"><?php echo date('d/m/Y H:i:s', $expiry); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right"> <i
                                                class="icon-lg mdi mdi-calendar text-danger ms-auto"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Last login</h5>
                                    <div class="row">
                                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                                <h3 class="mb-0"><?php
                                            session_start();

                                            if (!isset($_SESSION['lastLogin'])) {
                                                $_SESSION['lastLogin'] = time();
                                            }
                                            
                                            echo date('d/m/Y H:i:s', $_SESSION['lastLogin']);
                                            ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right"> <i
                                                class="icon-lg mdi mdi-account text-success ms-auto"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order Status</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="form-check form-check-muted m-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input">
                                                            </label>
                                                        </div>
                                                    </th>
                                                    <th> Client Name </th>
                                                    <th> IP </th>
                                                    <th> Product </th>
                                                    <th> Date </th>
                                                    <th> Payment method </th>
                                                    <th> Payment Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-muted m-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td> <img src="../assets/img/usernull.png" alt="image" /> <span
                                                            class="ps-2"><?php echo $username; ?></span> </td>
                                                    <td>
                                                        <?php echo $ip; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $subscription; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo date('d/m/Y H:i:s', $createdate); ?>
                                                    </td>
                                                    <td> PayPal </td>
                                                    <td>
                                                        <div class="badge badge-outline-success">Approved</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="preview-list">
                                        <h4 class="card-title">Available 1 time every 14 days</h4>
                                        <hr>
                                    </div>
                                    <div class="content">
                                        <h5 class="title text-center"><strong>Reset your HWID?</strong></h5>
                                        <?php
							$un = $_SESSION['un'];
                            $url = "https://keyauth.win/api/seller/?sellerkey={$sellerkey}&type=userdata&user={$un}";

							$curl = curl_init($url);
							curl_setopt($curl, CURLOPT_URL, $url);
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
							
							$resp = curl_exec($curl);
							$json = json_decode($resp);
							$cooldown = $json->cooldown;
							$token = $json->token;

                            if(is_null($cooldown))

                            {



                            }


                            else

                            {

                                echo '<p class="text-center">Your reset will only be available in: <span class="badge badge-danger"><script>document.write(convertTimestamp('.$cooldown.'));</script></span>';

                            }


                        

                        ?>
                                        <hr>
                                        <div class="form-group">
                                            <input type="hidden" id="reset" name="reset" value="ok">
                                        </div>
                                        <p class="spacer text-center">Do you have a problem?<a href=""> Contact
                                                Support</a>.</p>
                                    </div>
                                    <?php
							$un = $_SESSION['un'];
                            $url = "https://keyauth.win/api/seller/?sellerkey={$sellerkey}&type=userdata&user={$un}";

							$curl = curl_init($url);
							curl_setopt($curl, CURLOPT_URL, $url);
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
							
							$resp = curl_exec($curl);
							$json = json_decode($resp);
							$cooldown = $json->cooldown;
							$token = $json->token;

                            if(is_null($cooldown))

                            {

                            echo'<form method="post">

<center><button name="resethwid" class="btn btn-block btn-success btn-rad btn-lg"><i class="fas fa-redo-alt fa-sm text-white-50"></i> Reset HWID</button></center></form>';   

                            }

                            else

                            {

                            if ($today > $cooldown)

                            {

                            echo'<form method="post">

<center><button name="resethwid" class="btn btn-block btn-success btn-rad btn-lg"><i class="fas fa-redo-alt fa-sm text-white-50"></i> Reset HWID</button></center></form>';

                            }

                            else

                            {

                                echo '<center><button disabled="disabled"  class="btn btn-block btn-danger btn-rad btn-lg"><i class="fas fa-redo-alt fa-sm text-white-50"></i> Reset HWID</button></center>';

                            }

                            }

                        

                        ?>
                                </div>
                                <!-- Show / hide columns dynamically -->
                                <!-- Column rendering -->
                                <!-- Row grouping -->
                                <!-- Multiple table control element -->
                                <!-- DOM / jQuery events -->
                                <!-- Complex headers with column visibility -->
                                <!-- language file -->
                                <!-- Setting defaults -->
                                <!-- Footer callback -->
                                <?php

        if (isset($_POST['resethwid']))
        {

        $today = time();

        $cooldown = $today + $appcooldown;
        $un = $_SESSION['un'];
        $url = "https://keyauth.win/api/seller/?sellerkey={$sellerkey}&type=resetuser&user={$un}";

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_exec($curl);
	
        $url = "https://keyauth.win/api/seller/?sellerkey={$sellerkey}&type=setcooldown&user={$un}&cooldown={$cooldown}";

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_exec($curl);

        echo '
                            <script type=\'text/javascript\'>
                            
                            const notyf = new Notyf();
                            notyf
                              .success({
                                message: \'Reset HWID!\',
                                duration: 3500,
                                dismissible: true
                              });                
                            
                            </script>
                            ';  
        echo "<meta http-equiv='Refresh' Content='2;'>";   

        }
        ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">UI_ZetroCode</h4>
                                    <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel"
                                        id="owl-carousel-basic">
                                        <div class="item"> <img src="../assets/img/270.png" alt=""> </div>
                                        <div class="item"> <img src="../assets/img/271.png" alt=""> </div>
                                        <div class="item"> <img src="../assets/img/272.png" alt=""> </div>
                                        <div class="item"> <img src="../assets/img/273.png" alt=""> </div>
                                    </div>
                                    <div class="d-flex py-4">
                                        <div class="preview-list w-100">
                                            <div class="preview-item p-0">
                                                <div class="preview-thumbnail"> <img src="../assets/img/logozetro.png"
                                                        class="rounded-circle" alt=""> </div>
                                                <div class="preview-item-content d-flex flex-grow">
                                                    <div class="flex-grow">
                                                        <div
                                                            class="d-flex d-md-block d-xl-flex justify-content-between">
                                                            <h6 class="preview-subject">ZetroCode</h6>
                                                            <p class="text-muted text-small">5 Hours Ago</p>
                                                        </div>
                                                        <p class="text-muted">The best panel is UI_ZetroCode.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                        .discord {
                            background-color: #0d1117;
                            border-color: #30363d !important;
                            border-style: solid;
                            border-width: 1px;
                            border-radius: 6px;
                            color: #fff;
                        }

                        .discord-widget {
                            width: 100%;
                            margin: 0;
                            background-color: transparent;
                        }

                        .discord-header {
                            position: relative;
                            /* height: 40px; */
                            height: 70px;
                            padding: 15px 10px;
                            background-color: #4b3183;
                            border-top-right-radius: 5px;
                            border-top-left-radius: 5px;
                        }

                        .discord-body {
                            padding-left: 20px;
                            padding-right: 20px;
                            height: 100%;
                            position: relative;
                        }

                        .discord-logo {
                            margin: auto;
                            background-image: url();
                            background-size: 100%;
                            width: 100%;
                            height: 77px;
                            background-repeat: no-repeat;
                            transform-origin: left;
                            filter: contrast(1.1);
                            margin-bottom: 0;
                        }

                        .discord-list {
                            position: relative;
                            width: 100%;
                            height: 65%;
                            max-height: 210px;
                            display: inline-block;
                            overflow: auto;
                            margin-top: 20px;
                            margin-bottom: 20px;
                            overflow: -moz-scrollbars-vertical;
                            overflow-y: scroll;
                        }

                        .discord-list::-webkit-scrollbar {
                            width: 3px;
                        }

                        /* Track */

                        .discord-list::-webkit-scrollbar-track {
                            background-color: transparent !important;
                            border-radius: 10px;
                        }

                        /* Handle */

                        .discord-list::-webkit-scrollbar-thumb {
                            background-color: #222222;
                            border-radius: 8px;
                        }

                        /* Handle on hover */

                        .discord-list::-webkit-scrollbar-thumb:hover {
                            background: #4b3183;
                        }

                        .discord-list-botshadow:hover+.discord-list,
                        .discord-list:hover {
                            overflow: -moz-scrollbars-vertical;
                            overflow-y: scroll;
                        }

                        .discord-list-botshadow {
                            width: 80%;
                            height: 65%;
                            max-height: 250px;
                            position: absolute;
                            top: 10px;
                            left: 0;
                            z-index: 1;
                            box-shadow: inset 0px -24px 40px -11px rgba(30, 33, 36, 1), inset 0px -21px 40px -11px rgba(30, 33, 36, 1);
                            pointer-events: none;
                        }

                        .discord-list-bot-shadow:after {
                            content: " ";
                            background-image: linear-gradient(to bottom, transparent 0%, #1d1f20 100%);
                            bottom: 118px;
                            display: block;
                            height: 50px;
                            left: 0;
                            position: absolute;
                            width: calc(100% - 13.5px);
                            z-index: 1;
                        }

                        .discord-list-status,
                        .discord-list-label {
                            display: inline-block;
                            margin-bottom: 5px;
                        }

                        .discord-list-label:before {
                            content: "Online Users";
                            font-size: 12px;
                            font-weight: bold;
                        }

                        #members-count {
                            font-size: 14px;
                            font-weight: 800;
                            display: inline-block;
                            position: absolute;
                            top: calc(50% - 10px);
                            right: 10px;
                        }

                        .member-label {
                            margin: 0px 10px 0px 0px;
                            font-weight: normal;
                            position: relative;
                            top: 50%;
                            transform: perspective(1px) translateY(-50%);
                        }

                        #members-list img {
                            width: 15px;
                            border-radius: 50%;
                        }

                        .member-avatar {
                            padding-right: 5px;
                        }

                        #members-list td.member-name {
                            font-size: 14px;
                            max-width: 180px;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        .discord table {
                            table-layout: fixed;
                        }

                        /* Workaround, if page has colliding rules */

                        .discord-widget *>tr {
                            background-color: transparent !important;
                        }

                        .discord-cta {
                            border-bottom: 3px solid #4b3183;
                            border-top: none;
                            border-left: none;
                            border-right: none;
                            background-color: #4b3183;
                            padding: 12px 25px;
                            color: #fff !important;
                            border-radius: 4px;
                            font-size: 16px;
                            text-transform: uppercase;
                            font-weight: bold;
                            text-align: center;
                            width: 100%;
                            max-height: 45px;
                            margin-bottom: 10px;
                            transition: 0.3s;
                        }

                        .discord-cta:hover {
                            background-color: #4b3183;
                            border-bottom: 3px solid #4b3183;
                            transition: 0.3s;
                            color: #fff !important;
                        }

                        .discord-learn-more {
                            float: right;
                            text-align: center;
                            opacity: 0.4;
                            margin: 5px 0;
                            font-size: 13px;
                            transition: 0.2s;
                        }

                        .discord-learn-more:after {
                            content: "Converse e faça amigos!";
                        }

                        .discord-learn-more:hover {
                            opacity: 0.8;
                            transition: 0.2s;
                        }

                        .discord-cta:after {
                            content: "Join";
                        }

                        @-webkit-keyframes pulse {
                            0% {
                                opacity: 0.3;
                            }

                            50% {
                                opacity: 1;
                            }

                            100% {
                                opacity: 0.3;
                            }
                        }

                        @-moz-keyframes pulse {
                            0% {
                                opacity: 0.3;
                            }

                            50% {
                                opacity: 1;
                            }

                            100% {
                                opacity: 0.3;
                            }
                        }

                        @-o-keyframes pulse {
                            0% {
                                opacity: 0.3;
                            }

                            50% {
                                opacity: 1;
                            }

                            100% {
                                opacity: 0.3;
                            }
                        }

                        @keyframes pulse {
                            0% {
                                opacity: 0.3;
                            }

                            50% {
                                opacity: 1;
                            }

                            100% {
                                opacity: 0.3;
                            }
                        }
                        </style>
                        <div class="col-md-12 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card discord">
                                        <div class="discord-widget">
                                            <div class="discord-header">
                                                <div class="discord-logo"></div>
                                                <div id="members-count"></div>
                                            </div>
                                            <div class="discord-body">
                                                <div class="discord-list">
                                                    <div class="discord-list-status">
                                                        <div class="discord-list-label"></div>
                                                    </div>
                                                    <table id="members-list"></table>
                                                </div>
                                                <a onclick="javascript:window.open('  ');">
                                                    <button class="discord-cta"></button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                    var xhReq = new XMLHttpRequest();
                                    xhReq.open("GET", "", false);
                                    xhReq.send(null);
                                    var discordjson = JSON.parse(xhReq.responseText);
                                    if (discordjson != null) {
                                        function showMembersCount() {
                                            var membersCount = discordjson.presence_count;
                                            var countElem = (document.getElementById("members-count").innerHTML =
                                                membersCount + "<span class='member-label'> Online Users<span>");
                                        }

                                        function showMembers() {
                                            discordjson.members.reverse().forEach(function(members) {
                                                var td = document.createElement("td");
                                                var label = document.createElement("label");
                                                label.innerHTML = members.username;
                                                var img = document.createElement("img");
                                                img.src = members.avatar_url;
                                                var table = document.getElementById("members-list");
                                                var row = table.insertRow(0);
                                                var td1 = row.insertCell(0);
                                                var td2 = row.insertCell(1);
                                                td1.className = "member-avatar";
                                                td2.className = "member-name";
                                                td1.appendChild(img);
                                                td2.appendChild(label);
                                            });
                                        }
                                    }
                                    setTimeout(function() {
                                        showMembersCount();
                                        showMembers();
                                    }, 500);
                                    setTimeout(function() {
                                        document.getElementById("members-list").style.display = "block";
                                    }, 2000);
                                    </script>
                                </div>
                            </div>
                        </div>
                        <!-- content-wrapper ends -->
                        <!-- partial:partials/_footer.html -->
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
                            <div class="d-sm-flex justify-content-center justify-content-sm-between"> <span
                                    class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                                    UI_ZetroCode | Created with ❤ by <a href=""
                                        target="_blank"><span>ZetroCode</span></a>
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
            <script src="assets/vendors/js/vendor.bundle.base.js"></script>
            <!-- endinject -->
            <!-- Plugin js for this page -->
            <script src="assets/vendors/chart.js/Chart.min.js"></script>
            <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
            <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
            <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
            <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
            <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
            <!-- End plugin js for this page -->
            <!-- inject:js -->
            <script src="assets/js/off-canvas.js"></script>
            <script src="assets/js/hoverable-collapse.js"></script>
            <script src="assets/js/misc.js"></script>
            <script src="assets/js/settings.js"></script>
            <script src="assets/js/todolist.js"></script>
            <!-- endinject -->
            <!-- Custom js for this page -->
            <script src="assets/js/dashboard.js"></script>
            <!-- End custom js for this page -->
            <script>
            var going = 1;

            function handshake() {
                setTimeout(function() {
                    var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open("GET",
                        "http://localhost:1337/handshake?user=<?php echo $_SESSION['un']; ?>&token=<?php echo $token; ?>"
                        );
                    xmlHttp.onload = function() {
                        going = 0;
                        switch (xmlHttp.status) {
                            case 420:
                                console.log("returned SHEESH :)");
                                $("#handshake").fadeOut(100);
                                $("#buttons").fadeIn(1900);
                                break;
                            default:
                                alert(xmlHttp.statusText);
                                break;
                        }
                    };
                    xmlHttp.send();
                    if (going == 1) {
                        handshake();
                    }
                }, 3000);
            }

            function doButton(value) {
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open("GET", "http://localhost:1337/" + value);
                xmlHttp.send();
            }
            </script>
            <!-- ============================================================== -->
            <!-- All Jquery -->
            <!-- ============================================================== -->
            <!-- Bootstrap tether Core JavaScript -->
            <script src="https://cdn.keyauth.uk/dashboard/assets/libs/popper-js/dist/umd/popper.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- apps -->
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/app.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/app.init.dark.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/app-style-switcher.js"></script>
            <!-- slimscrollbar scrollbar JavaScript -->
            <script
                src="https://cdn.keyauth.uk/dashboard/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js">
            </script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/extra-libs/sparkline/sparkline.js"></script>
            <!--Wave Effects -->
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/waves.js"></script>
            <!--Menu sidebar -->
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/sidebarmenu.js"></script>
            <!--Custom JavaScript -->
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/feather.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/custom.min.js"></script>
            <!--This page JavaScript -->
            <!--chartis chart-->
            <script src="https://cdn.keyauth.uk/dashboard/assets/libs/chartist/dist/chartist.min.js"></script>
            <script
                src="https://cdn.keyauth.uk/dashboard/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js">
            </script>
            <!--c3 charts -->
            <script src="https://cdn.keyauth.uk/dashboard/assets/extra-libs/c3/d3.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/extra-libs/c3/c3.min.js"></script>
            <!--chartjs -->
            <script src="https://cdn.keyauth.uk/dashboard/assets/libs/chart-js/dist/chart.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/pages/dashboards/dashboard1.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js">
            </script>
            <!-- start - This is for export functionality only -->
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/pages/datatable/datatable-advanced.init.js"></script>
</body>

</html>