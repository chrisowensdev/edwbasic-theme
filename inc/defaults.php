<?php
if (!defined('ABSPATH')) exit;

add_action('after_switch_theme', function () {
    $defaults = [
        'edw_primary_color' => '#0f4c81',
        'edw_accent_color'  => '#ff7a18',
        'edw_nav_link_pad'  => 10,
        'edw_logo_max_h'    => 36,
        'edw_hero_bg'       => '', // can point at a theme asset later if you like
    ];
    foreach ($defaults as $k => $v) {
        if (get_theme_mod($k, null) === null) {
            set_theme_mod($k, $v);
        }
    }
});
