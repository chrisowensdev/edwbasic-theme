<?php
// Per-instance ACF fields (user edits these in the editor)
$eyebrow  = get_field('eyebrow') ?: '';
$headline = get_field('headline') ?: '';
$subcopy  = get_field('subcopy') ?: '';
$cta_text = get_field('cta_text') ?: '';
$cta_url  = get_field('cta_url') ?: '';
$bg_image = get_field('bg_image'); // image array or URL

$style = '';
if ($bg_image) {
    $url = is_array($bg_image) ? ($bg_image['url'] ?? '') : $bg_image;
    $style = $url ? ' style="background-image:url(' . esc_url($url) . ')"' : '';
}
?>
<section class="elevate-hero align<?php echo esc_attr($block['align'] ?? ''); ?>" <?php echo $style; ?> id="<?php echo esc_attr($block['anchor'] ?? ''); ?>">
    <div class="elevate-hero__inner">
        <?php if ($eyebrow): ?><p class="elevate-hero__eyebrow"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
        <?php if ($headline): ?><h1 class="elevate-hero__headline"><?php echo esc_html($headline); ?></h1><?php endif; ?>
        <?php if ($subcopy): ?><div class="elevate-hero__subcopy"><?php echo wp_kses_post($subcopy); ?></div><?php endif; ?>

        <?php if ($cta_text && $cta_url): ?>
            <p class="elevate-hero__cta">
                <a class="wp-block-button__link" href="<?php echo esc_url($cta_url); ?>"><?php echo esc_html($cta_text); ?></a>
            </p>
        <?php endif; ?>

        <!-- Optional freeform content: let users drop any blocks inside the hero -->
        <InnerBlocks
            allowedBlocks='["core/paragraph","core/buttons","core/list","core/image","core/heading","acf/hero"]'
            template='[["core/buttons",{}]]' />
    </div>
</section>