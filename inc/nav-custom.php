<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register a dedicated menu location for the custom navbar.
 */
add_action('after_setup_theme', function () {
    register_nav_menus([
        'edw_landing_menu' => __('EDW Landing Menu', 'edwbasic-theme'),
    ]);
});

/**
 * Fallback when no menu assigned.
 */
function edw_nav_fallback()
{
    echo '<nav class="edw-nav" aria-label="Main">
            <ul class="edw-nav__list">
              <li class="edw-nav__item"><a class="edw-nav__link" href="' . esc_url(home_url('/')) . '">Home</a></li>
            </ul>
          </nav>';
}

/**
 * Renderer you can call from templates or shortcodes.
 */
function edw_render_navbar(array $args = [])
{
    $defaults = [
        'theme_location'  => 'edw_landing_menu',
        'container'       => 'nav',
        'container_class' => 'edw-nav',
        'container_id'    => '',
        'menu_class'      => 'edw-nav__list',
        'menu_id'         => '',
        'depth'           => 2,
        'fallback_cb'     => 'edw_nav_fallback',
    ];
    $args = wp_parse_args($args, $defaults);

    // Wrap wp_nav_menu in a buffer so we control output anywhere.
    ob_start();
    wp_nav_menu($args);
    $html = ob_get_clean();

    // Add ARIA role if needed.
    if (str_starts_with($args['container'], 'nav') && !str_contains($html, 'aria-label')) {
        $html = preg_replace('/^<nav\b/', '<nav aria-label="Main"', $html);
    }

    echo $html;
}

/**
 * Shortcode for block editor: [edw_nav]
 */
add_shortcode('edw_nav', function ($atts = []) {
    ob_start();
    edw_render_navbar();
    return ob_get_clean();
});

/**
 * Minimal CSS (override as you like).
 */
add_action('wp_enqueue_scripts', function () {
    $ver = wp_get_theme()->get('Version');
    wp_register_style('edw-nav', get_stylesheet_directory_uri() . '/assets/edw-nav.css', [], $ver);
    wp_enqueue_style('edw-nav');
});
