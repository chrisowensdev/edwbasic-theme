<?php

/**
 * Dynamic renderer for edw/nav-pages
 *
 * Attributes:
 * - depth (int)  0 = unlimited; 1 = top-level only
 * - exclude (csv of IDs)
 * - includeHome (bool)
 * - homeLabel (string)
 * - orderBy ('menu_order'|'title')
 */

$depth       = isset($attributes['depth']) ? (int) $attributes['depth'] : 1;
$exclude_csv = trim($attributes['exclude'] ?? '');
$includeHome = !empty($attributes['includeHome']);
$homeLabel   = $attributes['homeLabel'] ?? 'Home';
$orderBy     = $attributes['orderBy'] ?? 'menu_order';

$showLogo     = !empty($attributes['showLogo']);
$logoId       = (int)($attributes['logoId'] ?? 0);
$logoUrl      = $attributes['logoUrl'] ?? '';
$logoAlt      = $attributes['logoAlt'] ?? '';
$logoWidth    = (int)($attributes['logoWidth'] ?? 120);
$logoLinkHome = !empty($attributes['logoLinkHome']);
$brandPos     = in_array(($attributes['brandPosition'] ?? 'left'), ['left', 'right'], true) ? $attributes['brandPosition'] : 'left';

$exclude_ids = array_filter(array_map('intval', preg_split('/\s*,\s*/', $exclude_csv)));
$exclude_str = $exclude_ids ? implode(',', $exclude_ids) : '';

$sort_column = ($orderBy === 'title') ? 'post_title' : 'menu_order,post_title';

$list = wp_list_pages([
    'title_li'    => '',
    'echo'        => 0,
    'depth'       => $depth,
    'exclude'     => $exclude_str,
    'sort_column' => $sort_column,
]);

// Wrap in nav; keep WP’s classes (current_page_item, etc.)
// $classes = 'edw-pages-nav';
// $id_attr = isset($attributes['anchor']) ? ' id="' . esc_attr($attributes['anchor']) . '"' : '';

// echo '<nav class="' . esc_attr($classes) . '" aria-label="Primary"' . $id_attr . '>';
// echo '<ul class="edw-pages-nav__list">';

// if ($includeHome) {
//     echo '<li class="page_item page-item-home"><a href="' . esc_url(home_url('/')) . '">'
//         . esc_html($homeLabel) . '</a></li>';
// }

// echo $list ?: '';
// echo '</ul></nav>';

$brand_html = '';
if ($showLogo) {
    if ($logoId) {
        // Uses responsive srcset/sizes automatically
        $brand_img = wp_get_attachment_image($logoId, 'full', false, [
            'alt'   => $logoAlt ?: get_post_meta($logoId, '_wp_attachment_image_alt', true),
            'style' => 'height:auto;max-width:100%;width:' . $logoWidth . 'px'
        ]);
    } elseif ($logoUrl) {
        $brand_img = '<img src="' . esc_url($logoUrl) . '" alt="' . esc_attr($logoAlt) . '" style="height:auto;max-width:100%;width:' . $logoWidth . 'px" />';
    } else {
        // Fallback to Site Logo if theme supports it
        if (function_exists('get_custom_logo') && has_custom_logo()) {
            $brand_img = get_custom_logo(); // already linked to home
        } else {
            $brand_img = '<span class="edw-brand__text">' . esc_html(get_bloginfo('name')) . '</span>';
        }
    }

    if ($brand_img && $logoLinkHome && (!function_exists('has_custom_logo') || !has_custom_logo())) {
        $brand_img = '<a class="edw-brand__link" href="' . esc_url(home_url('/')) . '">' . $brand_img . '</a>';
    }
    $brand_html = '<div class="edw-pages-nav__brand">' . $brand_img . '</div>';
}

$classes = 'edw-pages-nav edw-brand-' . $brandPos;
$id_attr = isset($attributes['anchor']) ? ' id="' . esc_attr($attributes['anchor']) . '"' : '';

echo '<nav class="' . esc_attr($classes) . '" aria-label="Primary"' . $id_attr . '>';

if ($brandPos === 'left') echo $brand_html;

echo '<ul class="edw-pages-nav__list">';
if ($includeHome) {
    echo '<li class="page_item page-item-home"><a href="' . esc_url(home_url('/')) . '">' . esc_html($homeLabel) . '</a></li>';
}
echo $list ?: '';
echo '</ul>';

if ($brandPos === 'right') echo $brand_html;

echo '</nav>';
