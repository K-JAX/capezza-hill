<?php
/**
 * The template for displaying all single posts
 */

 get_header();
 $is_sidebar = get_field('is_sidebar') ? 'with-sidebar right-sidebar' : '';
 ?>

    <div id="primary" class="content-area" data-aos="fade" data-aos-easing="linear" data-aos-duration="1000">
        <main id="main" class="site-main container <?php echo $is_sidebar; ?>">
            <div class="mx-3" >
            <?php

            // Start the loop
            while ( have_posts() ):
                the_post();

                get_template_part( 'template-parts/content/content', 'page');

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            endwhile; // End of the loop
            ?>
            </div>

            <?php if ( is_page('Contact') && is_active_sidebar( 'contact' ) ) : ?>
                <div>
                <?php get_sidebar( 'contact' ); ?>
            <?php else : ?>
                <!-- Time to add some widgets! -->
                </div>
            <?php endif; ?>
        </main><!-- #main -->
    </div><!-- #primary -->

    <?php
    get_footer();