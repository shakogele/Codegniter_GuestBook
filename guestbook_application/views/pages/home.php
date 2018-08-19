<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 text-center">Welcome To GUEST BOOK</h1>
    <br />
    <p class="text-center">
      <a href="<?php echo site_url('reviews/create'); ?>" class="btn btn-lg btn-outline-success">Create a Review</a>
      <a href="<?php echo site_url('reviews'); ?>" class="btn btn-lg btn-outline-info">Browse Reviews</a>
      <?php if(!$this->session->userdata['validated']) {?>
          <a href="<?php echo site_url('login'); ?>" class="btn btn-lg btn-outline-secondary">Log In</a>
      <?php } else {?>
          <a href="<?php echo site_url('admin/dashboard');?>" class="btn btn-lg btn-outline-secondary">Go to Profile</a>
      <?php }?>

    </p>
  </div>
</div>
