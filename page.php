<?php
/**
 * The template for displaying all single posts
 */

 get_header();
 ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main container">
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
    </div><!-- #primary -->

    <?php
    get_footer();