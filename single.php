<?php get_header(); ?>
<main class="container mx-auto px-4 py-8">
<div class="max-w-4xl mx-auto">
<article>
<?php while (have_posts()) : the_post(); ?>
<div class="card bg-base-100 shadow-xl">
<?php if (has_post_thumbnail()) : ?>
<figure>
<?php the_post_thumbnail('large', array('class'=> 'w-full')); ?>
</figure>
<?php endif; ?>
<div class="card-body">
<h1 class="text-4xl font-bold mb-4"><?php the_title(); ?></h1>
<div class="flex gap-4 text-sm opacity-70 mb-6">
<time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
<span>by <?php the_author(); ?></span>
</div>
<div class="prose prose-lg max-w-none">
<?php the_content(); ?>
</div>
<?php $tags = get_the_tags();
if ($tags) : ?>
<div class="flex gap-2 mt-6">
<?php foreach ($tags as $tag) : ?>
<a href="<?php echo get_tag_link($tag->term_id); ?>" class="badge badge-outline"><?php echo esc_html($tag->name); ?></a>
<?php endforeach; ?>
</div>
<?php endif; ?>
</div>
</div>
<?php 
// Only show comments if there are existing comments
if (get_comments_number() > 0) : 
  comments_template();
endif;
?>
<?php endwhile; ?>
</article>
</div>
</main>
<?php get_footer(); ?>

