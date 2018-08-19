<p>
  <h2><?php echo $title; ?></h2>
  <a href="<?php echo site_url('reviews/create'); ?>" class="btn btn-outline-info">Create A Review</a>
</p>

<div class="card-columns">
    <?php foreach ($reviews as $review): ?>
      <div class="card border-success mb-3">
        <div class="card-header bg-transparent border-success"><?php echo $review['title']; ?></div>
        <div class="card-body text-success">
          <span><small class="text-muted">Created By: <?php echo $review['name']?></small></span><br />
          <span><small class="text-muted">Created At: <?php echo $review['created_at']?></small></span>
          <br />
          <p class="card-text"><?php echo (strlen($review['text']) > 150) ? substr($review['text'], 0,150).'...' : $review['text']; ?></p>
        </div>
        <div class="card-footer bg-transparent border-success">
            <a href="<?php echo site_url('reviews/'.$review['slug']); ?>" class="btn btn-info">Read more</a>
        </div>
      </div>
    <?php endforeach; ?>
</div>

<p>
  <nav>
      <ul class="pagination">
        <?php echo $this->pagination->create_links();?>
      </ul>
  </nav>
</p>
