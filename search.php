<?php
/**
 * Search page template
 */
    get_header();
?>


<section class="content-area container">
    <header class="page-header container">
        <h1 class="page-title mb-1">
            <?php _e( 'Search results for:', 'capezzahill' ); ?> "<i class="lightgray-txt"><?php echo get_search_query(); ?></i> "
        </h1>
    </header><!-- .page-header -->
    <section id="primary" class="content-area container with-sidebar right">
        <main id="main" class="site-main container">
            <div>
            <?php if ( have_posts() ) : ?>
            
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
            wp_reset_query();
            ?>
            </div>
        </main><!-- #main -->
        <aside class="sidebar-container">
            <?php get_sidebar( ); ?>
        </aside>
    </section><!-- #primary -->
</section>

<?php get_footer(); ?>