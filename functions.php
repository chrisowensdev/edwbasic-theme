<?php
if (!defined('ABSPATH')) exit;
$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload)) require $autoload;

Edw\Theme\Blocks\Loader::init();

require_once __DIR__ . '/inc/nav-custom.php';

add_action('wp_enqueue_scripts', function () {
  // Parent (GeneratePress) CSS
  wp_enqueue_style(
    'gp-parent',
    get_template_directory_uri() . '/style.css',
    [],
    wp_get_theme('generatepress')->get('Version')
  );

  // Child CSS
  wp_enqueue_style(
    'edwbasic-theme',
    get_stylesheet_uri(), // style.css in the child theme
    ['gp-parent'],
    wp_get_theme()->get('Version')
  );
}, 20);

add_action('wp_head', function () {
  $primary   = get_theme_mod('edw_primary_color', '#0f4c81');
  $accent    = get_theme_mod('edw_accent_color',  '#ff7a18');
  $nav_pad   = absint(get_theme_mod('edw_nav_link_pad', 10)); // px
  $logo_max  = absint(get_theme_mod('edw_logo_max_h', 36));   // px
  $hero_bg   = trim(get_theme_mod('edw_hero_bg', ''));        // URL string

  // Note: for background-image, store the *url(...)*
  $hero_var  = $hero_bg ? "url('" . esc_url($hero_bg) . "')" : 'none';
?>
  <style id="edw-dynamic-css">
    :root {
      --edw-primary: <?php echo esc_html($primary); ?>;
      --edw-accent: <?php echo esc_html($accent); ?>;
      --edw-nav-pad: <?php echo esc_html($nav_pad); ?>px;
      --edw-logo-max-h: <?php echo esc_html($logo_max); ?>px;
      --edw-hero-bg: <?php echo $hero_var; ?>;
    }
  </style>
<?php
}, 30);


add_action('customize_preview_init', function () {
  wp_enqueue_script(
    'edw-customizer-preview',
    get_stylesheet_directory_uri() . '/assets/js/customizer.js',
    ['customize-preview'],
    wp_get_theme()->get('Version'),
    true
  );
});

add_action('after_setup_theme', function () {
  $file = get_stylesheet_directory() . '/inc/customizer.php'; // adjust path if different
  if (file_exists($file)) {
    require_once $file;
  } else {
    error_log('EDW: customizer.php not found at ' . $file);
  }
});

add_action('after_setup_theme', function () {
  add_theme_support('core-block-patterns');
});

add_action('init', function () {
  if (function_exists('register_block_pattern_category')) {
    register_block_pattern_category(
      'edw',
      ['label' => __('EDW Patterns', 'edwbasic-theme')]
    );
  }
});

add_action('after_setup_theme', function () {
  add_theme_support('align-wide'); // enables Wide / Full width options in blocks
});
