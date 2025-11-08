<?php function tailwind_theme_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('automatic-feed-links');
  add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

  register_nav_menus(array('primary'=> __('Primary Menu', 'tailwind-theme'),
    ));
}

add_action('after_setup_theme', 'tailwind_theme_setup');

function tailwind_theme_scripts() {
  // Tailwind CSS with DaisyUI from CDN
  wp_enqueue_style('tailwind-daisyui', 'https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css');

  // Custom theme JavaScript
  wp_enqueue_script('theme-js', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0', true);
}

add_action('wp_enqueue_scripts', 'tailwind_theme_scripts');

function tailwind_theme_widgets_init() {
  register_sidebar(array('name'=> __('Sidebar', 'tailwind-theme'),
      'id'=> 'sidebar-1',
      'before_widget'=> '<div class="card bg-base-200 shadow-xl mb-6">',
      'after_widget'=> '</div>',
      'before_title'=> '<h2 class="card-title p-4 pb-2">',
      'after_title'=> '</h2>',
    ));
}

add_action('widgets_init', 'tailwind_theme_widgets_init');

