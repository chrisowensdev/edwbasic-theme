<?php
if (!defined('ABSPATH')) exit;

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {
    // Panel
    if (!isset($wp_customize->panels()['edw_panel'])) {
        $wp_customize->add_panel('edw_panel', [
            'title'    => __('EDW Theme Settings', 'gp-child'),
            'priority' => 30,
        ]);
    }

    // Section: Branding
    $wp_customize->add_section('edw_branding', [
        'title' => __('Branding', 'gp-child'),
        'panel' => 'edw_panel',
    ]);

    // Primary color
    $wp_customize->add_setting('edw_primary_color', [
        'type'              => 'theme_mod',
        'default'           => '#0f4c81',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'edw_primary_color',
        [
            'label'   => __('Primary Color', 'gp-child'),
            'section' => 'edw_branding',
        ]
    ));

    // Accent color
    $wp_customize->add_setting('edw_accent_color', [
        'type'              => 'theme_mod',
        'default'           => '#ff7a18',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'edw_accent_color',
        [
            'label'   => __('Accent Color', 'gp-child'),
            'section' => 'edw_branding',
        ]
    ));

    // Section: Header & Navigation
    $wp_customize->add_section('edw_header_nav', [
        'title' => __('Header & Navigation', 'gp-child'),
        'panel' => 'edw_panel',
    ]);

    // Menu item vertical padding
    $wp_customize->add_setting('edw_nav_link_pad', [
        'type'              => 'theme_mod',
        'default'           => 10,
        'sanitize_callback' => fn($v) => max(0, min(30, intval($v))),
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('edw_nav_link_pad', [
        'label'       => __('Menu Item Vertical Padding (px)', 'gp-child'),
        'section'     => 'edw_header_nav',
        'type'        => 'range',
        'input_attrs' => ['min' => 0, 'max' => 30, 'step' => 1],
    ]);

    // Logo max height
    $wp_customize->add_setting('edw_logo_max_h', [
        'type'              => 'theme_mod',
        'default'           => 36,
        'sanitize_callback' => fn($v) => max(16, min(120, intval($v))),
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('edw_logo_max_h', [
        'label'       => __('Logo Max Height (px)', 'gp-child'),
        'section'     => 'edw_header_nav',
        'type'        => 'range',
        'input_attrs' => ['min' => 16, 'max' => 120, 'step' => 1],
    ]);

    // Section: Hero background
    $wp_customize->add_section('edw_hero', [
        'title' => __('Hero', 'gp-child'),
        'panel' => 'edw_panel',
    ]);
    $wp_customize->add_setting('edw_hero_bg', [
        'type'              => 'theme_mod',
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh', // refresh to repaint background
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'edw_hero_bg',
        [
            'label'   => __('Hero Background Image', 'gp-child'),
            'section' => 'edw_hero',
        ]
    ));

    // 👉 Add new fields later by repeating the pattern above in this file.
});
