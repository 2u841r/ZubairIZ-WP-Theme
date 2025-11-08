<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
// Set theme immediately to prevent flash
(function() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
})();
</script>
<script src="https://cdn.tailwindcss.com"></script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="navbar bg-base-100 shadow-lg sticky top-0 z-50">
<div class="navbar-start">
<div class="dropdown">
<label tabindex="0" class="btn btn-ghost lg:hidden">
<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
</label>
<ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
<?php wp_nav_menu(array('theme_location'=> 'primary',
    'container'=> false,
    'items_wrap'=> '%3$s',
    'fallback_cb'=> false,
  ));
?></ul>
</div>
<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-ghost text-xl"><?php bloginfo('name'); ?></a>
</div>
<div class="navbar-center hidden lg:flex">
<ul class="menu menu-horizontal px-1">
<?php wp_nav_menu(array('theme_location'=> 'primary',
    'container'=> false,
    'items_wrap'=> '%3$s',
    'fallback_cb'=> false,
  ));
?></ul>
</div>
<div class="navbar-end gap-2">
<!-- Theme Controller -->
<div class="dropdown dropdown-end">
<label tabindex="0" class="btn btn-ghost btn-circle">
<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
</label>
<ul tabindex="0" class="dropdown-content z-[1] p-2 shadow-2xl bg-base-300 rounded-box w-52 mt-4">
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="light">Light</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="dark">Dark</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="synthwave">Synthwave</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="retro">Retro</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="cyberpunk">Cyberpunk</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="valentine">Valentine</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="halloween">Halloween</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="forest">Forest</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="aqua">Aqua</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="wireframe">Wireframe</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="black">Black</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="luxury">Luxury</button></li>
<li><button class="theme-controller btn btn-sm btn-block btn-ghost justify-start" data-set-theme="dracula">Dracula</button></li>
</ul>
</div>
<!-- View Toggle (only on archive pages) -->
<?php if (is_home() || is_archive() || is_search()) : ?>
<div class="join">
<button class="join-item btn btn-sm view-toggle active" data-view="grid">
<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
</button>
<button class="join-item btn btn-sm view-toggle" data-view="list">
<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
</button>
</div>
<?php endif; ?>
</div>
</div>

