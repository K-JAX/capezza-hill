<?php
/**
 * The template for displaying attorney content
 */

 get_header('attorney');
 ?>
    <section id="primary" class="content-area container with-sidebar left pt-0">
        <main id="main" class="site-main py-3">
            <div class="mx-3">
            <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    get_template_part('template-parts/content/content', 'attorney');

                endwhile; // End of the loop.
            ?>
            </div>

        </main><!-- #main -->
        <aside class="sidebar-container">
            <ul class="bio-list">
                <?php capezzahill_attorney_title_meta( get_post_meta( get_the_ID(), '', true ) ); ?>
            </ul>
        </aside>
    </section><!-- #primary -->

<?php
get_footer();