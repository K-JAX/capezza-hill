<?php
/**
 * Template Name: Sidebar Page
 */
 get_header();
 $sidebar_side = get_field('sidebar_side');
 ?>

    <div id="primary" class="content-area container with-sidebar <?php echo strtolower($sidebar_side); ?>">
        <main id="main" class="site-main"  >
            <div class="mx-3">
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


        </main><!-- #main -->
        <?php if ( is_page('Contact') && is_active_sidebar( 'contact' ) ) : ?>
        <aside class="sidebar-container" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">
            <?php get_sidebar( 'contact' ); ?>
        </aside>
            <?php endif; ?>
    </div><!-- #primary -->

    <?php
    get_footer();