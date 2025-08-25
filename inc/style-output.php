<?php
if (!defined('ABSPATH')) exit;

add_action('wp_enqueue_scripts', function () {
    // Ensure parent CSS is enqueued; change handle if yours differs
    $handle = 'gp-parent';
    wp_enqueue_style($handle);

    $primary = get_theme_mod('edw_primary_color', '#0f4c81');
    $accent  = get_theme_mod('edw_accent_color',  '#ff7a18');
    $pad     = intval(get_theme_mod('edw_nav_link_pad', 10));
    $logoH   = intval(get_theme_mod('edw_logo_max_h',   36));
    $hero    = esc_url(get_theme_mod('edw_hero_bg', ''));

    $css  = ":root{--edw-primary:{$primary};--edw-accent:{$accent}}\n";
    $css .= "@media (min-width:769px){.main-navigation .main-nav>ul>li>a{padding-top:{$pad}px;padding-bottom:{$pad}px;line-height:1.2}.site-logo img{max-height:{$logoH}px;height:auto}}\n";
    if ($hero) {
        $css .= ".edw-hero{background-image:url('{$hero}');background-size:cover;background-position:center}\n";
    }

    wp_add_inline_style($handle, $css);
}, 20);
