<p>
    <p>
        <a href="<?php echo site_url('reviews'); ?>" class="btn btn-outline-info">Go Back</a>
    </p>

    <div class="card border-info mb-12">
      <div class="card-header">Review</div>
      <div class="card-body text-info">
        <h5 class="card-title"><?php echo $review_item['title']; ?></h5>
        <p>
            <small>Created By: <?php echo $review_item['name']; ?></small>
        </p>
        <p>
            <small>Created At: <?php echo $review_item['created_at']; ?></small>
        </p>
        <p class="card-text"><?php echo $review_item['text']; ?></p>
      </div>
    </div>
</p>
