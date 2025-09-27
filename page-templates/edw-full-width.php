<?php

/**
 * Template Name: EDW – Full Width (No Padding)
 */
if (!defined('ABSPATH')) exit;

get_header();
?>

<main id="primary" class="edw-full">
    <?php edw_render_navbar(); ?>
    <div class="edw-full__inner">
        <?php
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        ?>
    </div>
</main>
<?php get_footer();
