<?php
/**
 * Template Name: Practices Template
 */
get_header();
?>

<div id="primary" class="content-area container">
        <main id="main" class="site-main   ">
            <div class="mx-3 mb-5">
            <?php

            // Start the loop
            while ( have_posts() ):
                the_post();

                get_template_part( 'template-parts/content/content', 'practices');

            endwhile; // End of the loop
            ?>
            </div>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer();