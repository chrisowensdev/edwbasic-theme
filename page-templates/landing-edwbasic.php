<?php

/**
 * Template Name: Landing — EDWBasic
 */
defined('ABSPATH') || exit;

$payload = function_exists('edwbasic_get_payload')
  ? edwbasic_get_payload($defaults)
  : [];
get_header();
$phone = '(555) 555-5555';
$hero_t = 'Fast, Friendly Service';
$hero_s = 'Local & long-distance, fully insured.';
$cta_lbl = 'Get a Free Quote';
$cta_link = home_url('/contact/');
$hero_bg = '';
$badges = ['Licensed & Insured', 'Free Estimates', '5-Star Rated'];
$services = [['icon' => '📦', 'title' => 'Packing', 'desc' => 'Careful, efficient packing for home & office.'], ['icon' => '🚚', 'title' => 'Moving', 'desc' => 'Local and long-distance moves.'], ['icon' => '🧹', 'title' => 'Cleanout', 'desc' => 'Declutter and haul-away services.']];
$steps = [['n' => '1', 't' => 'Request a Quote', 'd' => 'Tell us what you need.'], ['n' => '2', 't' => 'We Plan', 'd' => 'Schedule, crew, and logistics.'], ['n' => '3', 't' => 'Move Day', 'd' => 'We handle the heavy lifting.']];
$testimonials = [['q' => '“Amazing crew—on time, on budget.”', 'n' => 'Alex R.'], ['q' => '“Smooth experience from start to finish.”', 'n' => 'Jamie L.']];
if (function_exists('edwbasic_get_payload')) {
  extract(edwbasic_get_payload(compact('phone', 'hero_t', 'hero_s', 'cta_lbl', 'cta_link', 'hero_bg', 'badges', 'services', 'steps', 'testimonials')), EXTR_OVERWRITE);
}
$hero_bg_url = '';
if (has_post_thumbnail(get_the_ID())) {
  $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
  if ($img) {
    $hero_bg_url = $img[0];
  }
}

$phone = get_theme_mod('edw_phone', '(555) 123-4567');

if (!$hero_bg_url && !empty($hero_bg)) $hero_bg_url = esc_url($hero_bg);
$hero_style = $hero_bg_url ? 'style="background-image:linear-gradient(180deg,rgba(2,6,23,.55),rgba(2,6,23,.30)),url(' . esc_url($hero_bg_url) . ');background-size:cover;background-position:center;"' : '';
?>
<main class="edw-landing" style="font-family:system-ui,-apple-system,Segoe UI,Roboto,sans-serif">
  <section class="edw-hero" <?php echo $hero_style; ?>>
    <div class="wrap" style="max-width:1100px;margin:0 auto;padding:6rem 1.25rem;text-align:center">
      <p style="opacity:.9;margin:0 0 .75rem"><?php echo esc_html($phone); ?></p>
      <h1 style="margin:.25rem 0 1rem;font-size:clamp(2rem,4vw,3rem)"><?php echo esc_html($hero_t); ?></h1>
      <p style="margin:0 0 1.5rem;font-size:1.1rem;opacity:.92"><?php echo esc_html($hero_s); ?></p>
      <a href="<?php echo esc_url($cta_link); ?>" class="btn" style="display:inline-block;background:#0ea5e9;color:#fff;padding:.9rem 1.25rem;border-radius:8px;text-decoration:none;"><?php echo esc_html($cta_lbl); ?></a>
      <?php if (!empty($badges)): ?>
        <div class="badges" style="display:flex;flex-wrap:wrap;gap:.75rem;justify-content:center;margin-top:1.25rem">
          <?php foreach ($badges as $b): ?>
            <span style="background:rgba(255,255,255,.15);backdrop-filter:blur(3px);padding:.4rem .7rem;border-radius:9999px">
              <?php echo esc_html($b); ?>
            </span>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>