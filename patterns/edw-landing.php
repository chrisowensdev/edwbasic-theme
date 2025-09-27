<?php

/**
 * Title: EDW – Landing (per-page)
 * Slug: edwbasic-theme/edw-landing
 * Categories: edw
 * Inserter: yes
 * Description: Hero, badges, steps, services grid and testimonials for a one-page landing.
 */
?>
<?php
$edw_hero_title = get_field('edw_hero_title');
?>

<!-- wp:group {"tagName":"main","align":"full","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group alignfull">

    <!-- HERO -->
    <!-- wp:cover {"useFeaturedImage":false,"dimRatio":30,"overlayColor":"contrast","minHeight":480,"isDark":true,"align":"full","style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}}} -->
    <div class="wp-block-cover alignfull is-light" style="padding-top:80px;padding-bottom:80px;min-height:480px">
        <span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-30"></span>
        <div class="wp-block-cover__inner-container">
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"980px"}} -->
            <div class="wp-block-group">
                <!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xx-large"} -->
                <h1 class="wp-block-heading has-text-align-center has-xx-large-font-size">[acf_text field="edw_hero_title" options="true"]</h1>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center"></p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"primary"} -->
                    <div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="/contact">Get a Free Quote</a></div>
                    <!-- /wp:button -->
                    <!-- wp:button {"className":"is-style-outline"} -->
                    <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="tel:+15555551234">Call (555) 555-1234</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
    </div>
    <!-- /wp:cover -->

    <!-- BADGES -->
    <!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"24px"}}},"layout":{"type":"constrained","contentSize":"1100px"}} -->
    <div class="wp-block-group" style="padding-top:24px;padding-bottom:24px">
        <!-- wp:columns {"verticalAlignment":"center"} -->
        <div class="wp-block-columns are-vertically-aligned-center">
            <!-- wp:column {"verticalAlignment":"center"} -->
            <div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center">⭐ 4.9 on Google TEST</p><!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column {"verticalAlignment":"center"} -->
            <div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center">Licensed &amp; Insured</p><!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column {"verticalAlignment":"center"} -->
            <div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center">Transparent Pricing</p><!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->

    <!-- STEPS -->
    <!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px"}}},"layout":{"type":"constrained","contentSize":"980px"}} -->
    <div class="wp-block-group" style="padding-top:40px;padding-bottom:40px">
        <!-- wp:heading {"textAlign":"center","level":2} -->
        <h2 class="wp-block-heading has-text-align-center">How it works</h2>
        <!-- /wp:heading -->

        <!-- wp:columns {"align":"wide"} -->
        <div class="wp-block-columns alignwide">
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":4} -->
                <h4 class="wp-block-heading">1. Request a quote</h4><!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>Tell us your dates, addresses, and inventory.</p><!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":4} -->
                <h4 class="wp-block-heading">2. We move it</h4><!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>Professional packing, careful loading, on-time transport.</p><!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":4} -->
                <h4 class="wp-block-heading">3. You relax</h4><!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>Unpack stress-free with optional setup services.</p><!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->

    <!-- SERVICES GRID (CPT: services) -->
    <!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px"}}},"layout":{"type":"constrained","contentSize":"1100px"}} -->
    <div class="wp-block-group" style="padding-top:40px;padding-bottom:40px">
        <!-- wp:heading {"textAlign":"center","level":2} -->
        <h2 class="wp-block-heading has-text-align-center">Services</h2>
        <!-- /wp:heading -->

        <!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"services","order":"desc","orderBy":"date","inherit":false},"displayLayout":{"type":"grid","columns":3},"layout":{"type":"default"}} -->
        <div class="wp-block-query">
            <!-- wp:post-template -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"10px","padding":{"top":"16px","right":"16px","bottom":"16px","left":"16px"}},"border":{"radius":"8px","width":"1px"}},"borderColor":"contrast-3","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color has-contrast-3-border-color" style="border-width:1px;border-radius:8px;padding-top:16px;padding-right:16px;padding-bottom:16px;padding-left:16px">
                <!-- wp:post-featured-image {"isLink":true,"height":"180px","style":{"border":{"radius":"6px"}}} /-->
                <!-- wp:post-title {"isLink":true,"level":3} /-->
                <!-- wp:post-excerpt {"moreText":"Learn more →","showMoreOnNewLine":false} /-->
            </div>
            <!-- /wp:group -->
            <!-- /wp:post-template -->

            <!-- wp:query-no-results -->
            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">Add Services posts to populate this grid.</p><!-- /wp:paragraph -->
            <!-- /wp:query-no-results -->
        </div>
        <!-- /wp:query -->
    </div>
    <!-- /wp:group -->

    <!-- TESTIMONIALS (CPT: testimonials) -->
    <!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px"}}},"layout":{"type":"constrained","contentSize":"1100px"}} -->
    <div class="wp-block-group" style="padding-top:40px;padding-bottom:40px">
        <!-- wp:heading {"textAlign":"center","level":2} -->
        <h2 class="wp-block-heading has-text-align-center">What customers say</h2>
        <!-- /wp:heading -->

        <!-- wp:query {"queryId":2,"query":{"perPage":6,"pages":0,"offset":0,"postType":"testimonials","order":"desc","orderBy":"date","inherit":false},"displayLayout":{"type":"grid","columns":3},"layout":{"type":"default"}} -->
        <div class="wp-block-query">
            <!-- wp:post-template -->
            <!-- wp:group {"style":{"spacing":{"blockGap":"10px","padding":{"top":"16px","right":"16px","bottom":"16px","left":"16px"}},"border":{"radius":"8px","width":"1px"}},"borderColor":"contrast-3","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color has-contrast-3-border-color" style="border-width:1px;border-radius:8px;padding-top:16px;padding-right:16px;padding-bottom:16px;padding-left:16px">
                <!-- wp:paragraph -->
                <p>“<!-- wp:post-excerpt {"excerptLength":24,"moreText":"", "showMoreOnNewLine":false} /-->”</p><!-- /wp:paragraph -->
                <!-- wp:post-title {"level":4} /-->
            </div>
            <!-- /wp:group -->
            <!-- /wp:post-template -->

            <!-- wp:query-no-results -->
            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">Add Testimonials posts to populate this grid.</p><!-- /wp:paragraph -->
            <!-- /wp:query-no-results -->
        </div>
        <!-- /wp:query -->
    </div>
    <!-- /wp:group -->

    <!-- BOTTOM CTA -->
    <!-- wp:group {"style":{"spacing":{"padding":{"top":"28px","bottom":"28px"}}},"backgroundColor":"primary","textColor":"base","layout":{"type":"constrained"}} -->
    <div class="wp-block-group has-base-color has-primary-background-color has-text-color has-background" style="padding-top:28px;padding-bottom:28px">
        <!-- wp:columns {"verticalAlignment":"center"} -->
        <div class="wp-block-columns are-vertically-aligned-center">
            <!-- wp:column {"verticalAlignment":"center"} -->
            <div class="wp-block-column is-vertically-aligned-center">
                <!-- wp:heading {"level":3} -->
                <h3 class="wp-block-heading">Ready to move?</h3><!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>Get your free, no-obligation quote today.</p><!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column {"verticalAlignment":"center"} -->
            <div class="wp-block-column is-vertically-aligned-center">
                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"textColor":"primary","className":"is-style-outline"} -->
                    <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-primary-color has-text-color wp-element-button" href="/contact">Get a Free Quote</a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->

</main>
<!-- /wp:group -->