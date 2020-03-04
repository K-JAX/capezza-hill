<?php

get_header();
?>


<section id="primary" class="content-area">
    <main id="main" class="site-main container">
        <div class="mx-3">
        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php _e( 'Search results for:', 'capezzahill' ); ?>
                </h1>
                <div class="page-description"><?php echo get_search_query(); ?></div>
            </header><!-- .page-header -->
        
        <?php
        // Start the Loop.
        while (have_posts() ) :
            the_post();
            /**
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-__.php (where __ is the Post Format name) and that will be used instead.
             */
            get_template_part( 'template-parts/content/content', 'excerpt');
            
            // End the loop
        endwhile;

        // Previous/next page navigation.
        capezzahill_the_posts_navigation();
        else:
        // If no content, include the "No posts found" template.
            get_template_part( 'template-parts/content/content', 'none' );

        endif; 
        ?>
        </div>
    </main><!-- #main -->
</section><!-- #primary -->