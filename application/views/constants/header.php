<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="YMG">
	<link rel="icon" sizes = "32x32" href="<?= base_url($this->site_options->get_site_data('favicon')) ?>"/>
	<link rel="shortcut icon" sizes = "32x32" href="<?= base_url($this->site_options->get_site_data('favicon')) ?>"/>
    
    <!-- <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"> -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> -->
    <!-- <link rel="manifest" href="/site.webmanifest"> -->
    <title><?= $this->site_options->get_site_data('site_name') ?></title>

    <!-- Google font-->
    <!-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/font-awesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/flag-icon.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/admin.css">
	
	<!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/themify.css">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/slick-theme.css">
	
	<!-- Dropzone css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/dropzone.css">

    <!-- jsgrid css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/jsgrid.css">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/icofont.css">

    <!-- Prism css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/prism.css">

    <!-- Chartist css -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/chartist.css"> -->

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vector-map.css">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/custom-css.css">

    <!-- Datatable css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/DataTables/datatables.css">

    <!-- Date Picker -->
    <link href="<?= base_url() ?>assets/datepicker/the-datepicker.css" rel="stylesheet" />

    <link href="<?= base_url() ?>assets/js/jquery-ui.css" rel="Stylesheet" type="text/css" />


    <!-- Slim select -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slimselect/slimselect.min.css">

    <!-- Jquery css -->
    <link rel = "stylesheet" href="<?= base_url() ?>assets/css/jquery/jquery-ui.css">

    <style>
    .ui-datepicker-today  {
     background: green !important;
     border:  cornsilk !important; 
    }  
    .ui-datepicker-today  a {
        border:  #fff !important;
        color:  #fff !important;
        font-weight: bold !important;
        background: #f00 !important; 
    }
    .ui-widget-header {
        background : blue
    }
    
    </style>
</head>
<body>

<!-- page-wrapper Start-->
<div class="page-wrapper">

    <!-- Page Header Start-->
    <div class="page-main-header">
        <div class="main-header-left">
            <div class="logo-wrapper"><a href="index.html">
                <img class="blur-up lazyloaded" src="<?= base_url($this->site_options->get_site_data('logo')) ?>" alt=""></a></div>
        </div>
        <div class="main-header-right row">
            <div class="mobile-sidebar">
                <div class="media-body text-right switch-sm">
                    <label class="switch">
                        <input id="sidebar-toggle" type="checkbox" checked="checked"><span class="switch-state"></span>
                    </label>
                </div>
            </div>
            <div class="nav-right col">
                <ul class="nav-menus align-items-end">
                    <li style="text-align: center"><a href="<?= base_url() ?>" class="homepage-btn"><span>OMG STUDENT SYSTEM</span></a></li>
                    <li hidden class="onhover-dropdown"><a class="txt-dark" href="#">
                        <h6>EN</h6></a>
                        <ul class="language-dropdown onhover-show-div p-20">
                            <li><a href="#" data-lng="pt"><i class="flag-icon flag-icon-uy"></i> Portuguese</a></li>
                            <li><a href="#" data-lng="es"><i class="flag-icon flag-icon-um"></i> Spanish</a></li>
                            <li><a href="#" data-lng="en"><i class="flag-icon flag-icon-is"></i> English</a></li>
                            <li><a href="#" data-lng="fr"><i class="flag-icon flag-icon-nz"></i> French</a></li>
                        </ul>
                    </li>
                    <li hidden><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                    <li hidden class="onhover-dropdown"><i data-feather="bell"></i><span class="badge badge-pill badge-primary pull-right notification-badge">3</span><span class="dot"></span>
                        <ul class="notification-dropdown onhover-show-div p-0">
                            <li>
                                <div class="media">
                                    <div class="notification-icons bg-success mr-3"><i data-feather="thumbs-up"></i></div>
                                    <div class="media-body">
                                        <h6 class="font-success">Someone Likes Your Posts</h6>
                                        <p class="mb-0"> 2 Hours Ago</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <div class="notification-icons bg-info mr-3"><i data-feather="message-circle"></i></div>
                                    <div class="media-body">
                                        <h6 class="font-info">3 New Comments</h6>
                                        <p class="mb-0"> 1 Hours Ago</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <div class="notification-icons bg-secondary mr-3"><i data-feather="download"></i></div>
                                    <div class="media-body">
                                        <h6 class="font-secondary">Download Complete</h6>
                                        <p class="mb-0"> 3 Days Ago</p>
                                    </div>
                                </div>
                            </li>
                            <li class="bg-light txt-dark"><a href="#" data-original-title="" title="">All </a> notification</li>
                        </ul>
                    </li>
                    <li hidden><a href="<?= base_url() ?>" class="homepage-btn"><span>HOMEPAGE</span></a></li>

                    <li class="onhover-dropdown">
                        <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="<?= base_url() ?>assets/images/dashboard/man.png" alt="header-user">
                            <!--<div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>-->
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            <li><a href="<?= base_url('app/users/view/'.$_SESSION['id']) ?>">Profile<span class="pull-right"><i data-feather="user"></i></span></a></li>
                            <li><a href="<?= base_url('login/logout') ?>">Logout<span class="pull-right"><i data-feather="log-out"></i></span></a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
    </div>
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
	
		<?php $this->load->view('constants/sidebar'); ?>
		
		<div class="page-body">

                