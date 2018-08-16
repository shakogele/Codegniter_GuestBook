<h2><?php echo $title; ?></h2>

<?php foreach ($reviews as $review): ?>

    <h3><?php echo $review['title']; ?></h3>
    <div class="main">
        <?php echo $review['text']; ?>
    </div>
    <p><a href="<?php echo site_url('reviews/'.$review['slug']); ?>">View article</a></p>

<?php endforeach; ?>
