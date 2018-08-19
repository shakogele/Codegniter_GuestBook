<html>
  <head>
    <title>GuestBook</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>" >
    <link rel="stylesheet" href="<?php echo base_url("assets/css/main.css"); ?>" >
    <script type="text/javascript" src="<?php echo base_url("assets/vendor/ckeditor/ckeditor.js"); ?>"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="/">GuestBook</a>
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php if ($title === 'Home') {
          echo 'active';
        }?>">
          <a class="nav-link" href="<?php echo site_url('home');?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php if ($title === 'All Reviews') {
          echo 'active';
        }?>">
          <a class="nav-link" href="<?php echo site_url('reviews');?>">Reviews</a>
        </li>
        <li class="nav-item <?php if ($title === 'Login') {
          echo 'active';
        }?>">
          <?php if(!array_key_exists('username', $this->session->userdata)) {?>
              <a class="nav-link" href="<?php echo site_url('login');?>">Log In</a>
          <?php } else {?>
              <a class="nav-link" href="<?php echo site_url('admin/dashboard');?>"><?php echo $this->session->userdata['username'];?></a>
          <?php }?>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <?php if($this->session->flashdata('msg')) { ?>
        <div class="alert alert-<?php echo $this->session->flashdata('msg_cat'); ?> alert-dismissible fade show" role="alert">
          <strong><?php echo $this->session->flashdata('msg_cat'); ?></strong> <?php echo $this->session->flashdata('msg'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <?php } ?>
