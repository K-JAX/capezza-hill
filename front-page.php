<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

    <?php

    // Start the loop
    while ( have_posts() ):
        the_post();

        get_template_part( 'template-parts/content/content', 'page');

    endwhile; // End of the loop
    ?>
    </main><!-- #main -->
</div>

<?php get_footer(); ?>