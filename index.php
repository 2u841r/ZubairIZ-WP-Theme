<?php get_header(); ?>
<main class="container mx-auto px-4 py-8">
<div class="max-w-4xl mx-auto">
<?php if (have_posts()) : ?>
<div id="posts-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('template-parts/content', get_post_format()); ?>
<?php endwhile; ?>
</div>
<div class="mt-8 flex justify-center">
<?php echo paginate_links(array('prev_text'=> '«',
    'next_text'=> '»',
    'type'=> 'list',
    'before_page_number'=> '<span class="btn btn-sm">',
    'after_page_number'=> '</span>',
  ));
?>
<style>
.page-numbers {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;
  list-style: none;
  padding: 0;
  margin: 0;
}
.page-numbers li {
  display: inline-flex;
}
</style>
</div>
<?php else : ?>
<div class="alert alert-info">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
<span><?php _e('No posts found.', 'tailwind-theme'); ?></span>
</div>
<?php endif; ?>
</div>
</main>
<?php get_footer(); ?>

