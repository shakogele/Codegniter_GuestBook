<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GuestBook - Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/vendor/bootstrap3/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("assets/vendor/metisMenu/metisMenu.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/sb-admin/css/sb-admin-2.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/vendor/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/css/main.css"); ?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo base_url("assets/vendor/ckeditor/ckeditor.js"); ?>"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('admin/dashboard'); ?>">GuestBook Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="<?php echo site_url('admin/profile'); ?>">
                                <i class="fa fa-user fa-fw"></i>
                                My Profile
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo site_url('logout'); ?>">
                                <i class="fa fa-sign-out fa-fw"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo site_url('admin/dashboard'); ?>">
                              <i class="fa fa-dashboard fa-fw"></i>
                              Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('home'); ?>">
                              <i class="fa fa-home fa-fw"></i>
                              Home
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('admin/reviews'); ?>">
                                <i class="fa fa-table fa-fw"></i>
                                Reviews
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('admin/reviews'); ?>">All Reviews</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('admin/reviews/approved'); ?>">Approved Reviews</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('admin/reviews/unapproved'); ?>">Unapproved Reviews</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper" style="min-height: 360px;">
        <?php if($this->session->flashdata('msg')) { ?>
            <div class="alert alert-<?php echo $this->session->flashdata('msg_cat'); ?> alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?php echo $this->session->flashdata('msg_cat'); ?>!</strong> <?php echo $this->session->flashdata('msg'); ?>
            </div>
        <?php } ?>
