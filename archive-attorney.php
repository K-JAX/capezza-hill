<?php
/**
 * The template for displaying archive pages
 */

 get_header();
 ?>

 <section id="primary" class="content-area">
     <main id="main" class="site-main">
     <p>gimme some good shit for the attorneys!</p>

     <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <?php
                the_archive_title( '<h1 class="page-title">', '</h1>');
            ?>
        </header><!-- .page-header -->
        <?php
        // Start the Loop.
        while( have_posts() ) :
            the_post();


        endwhile; 
        
        // Previous/next page navigation.
        capezzahill_the_posts_navigation();

        // If no content, include the "No posts found" template.
    else:
        get_template_part( 'template-parts/content/content', 'none' );
    
    endif; ?>
     
     </main>
 </section>