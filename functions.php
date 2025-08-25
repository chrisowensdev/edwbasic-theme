<?php
if (!defined('ABSPATH')) exit;

define('EDW_CHILD_DIR', get_stylesheet_directory());
define('EDW_CHILD_URI', get_stylesheet_directory_uri());

// Load modules (add more as you grow)
foreach (['customizer.php', 'style-output.php', 'live-preview.php', 'defaults.php'] as $file) {
  $path = EDW_CHILD_DIR . '/inc/' . $file;
  if (file_exists($path)) require_once $path;
}

// Example: enqueue child stylesheet (if you ship your own CSS file)
add_action('wp_enqueue_scripts', function () {
  // Parent GP CSS handle is usually 'generatepress' in free or 'gp-parent' per your setup
  wp_enqueue_style('gp-parent'); // ensure parent first
  wp_enqueue_style('edw-theme', EDW_CHILD_URI . '/assets/edw.css', ['gp-parent'], wp_get_theme()->get('Version'));
}, 20);
