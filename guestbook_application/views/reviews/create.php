<p>
  <p>
      <a href="<?php echo site_url('reviews'); ?>" class="btn btn-outline-info">Go To Reviews</a>
  </p>
  <p>
      <h2><?php echo $title; ?></h2>
  </p>
  <?php echo validation_errors(); ?>

  <?php echo form_open('reviews/create'); ?>

      <div class="form-group">
        <label for="name">Name</label>
        <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            value="<?php echo set_value('name');?>"
            placeholder="Jokh Smith">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            value="<?php echo set_value('email');?>"
            placeholder="name@example.com">
      </div>
      <div class="form-group">
        <label for="title">Title</label>
        <input
            type="text"
            class="form-control"
            id="title"
            name="title"
            value="<?php echo set_value('title');?>"
            placeholder="Review Title">
      </div>
      <div class="form-group">
        <label for="text">Text</label>
        <textarea
            class="form-control"
            name="text"
            id="text"
            rows="3"><?php echo set_value('text');?></textarea>
      </div>
      <div class="form-group">
          <input type="submit" name="submit" class="btn btn-outline-success" value="Create Review" />
      </div>

  </form>
</p>
