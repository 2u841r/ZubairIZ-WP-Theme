<article id="post-<?php the_ID(); ?>" <?php post_class('card bg-base-100 shadow-xl post-item'); ?> data-post-url="<?php echo esc_url(get_permalink()); ?>">
<?php if (has_post_thumbnail()) : ?>
<figure>
<a href="<?php the_permalink(); ?>">
<?php the_post_thumbnail('medium', array('class'=> 'w-full h-48 object-cover post-thumbnail')); ?>
</a>
</figure>
<?php endif; ?>
<div class="card-body">
<h2 class="card-title post-title">
<a href="<?php the_permalink(); ?>" class="hover:text-primary"><?php the_title(); ?></a>
</h2>
<div class="text-sm opacity-70 mb-2 post-date">
<time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
<span class="mx-2">•</span>
<span><?php the_author(); ?></span>
</div>
<p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
<div class="card-actions justify-between items-center mt-4">
<div class="flex gap-2">
<?php $categories = get_the_category();

if ($categories) {
  foreach (array_slice($categories, 0, 2) as $category) {
    echo '<span class="badge badge-primary">' . esc_html($category->name) . '</span>';
  }
}

?>
</div>
<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm read-more-btn"><?php _e('Read More', 'tailwind-theme'); ?></a>
</div>
</div>
</article>

