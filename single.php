<?php
/**
 * The template for displaying all single posts
 */

 get_header();
 ?>


        <section id="primary" class="content-area container">
            <main id="main" class="site-main container">
                <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        get_template_part('template-parts/content/content', 'single');

                        // if ( is_singular( 'attachment' ) ) {
                        //     // Parent post navigation
                        //     the_post_navigation(
                        //         array(
                        //             /* translators: %s: parent post link */
                        //             'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'capezzahill' ), '%title' ),
                        //         )
                        //         );
                        // } elseif ( is_singular( 'post' ) ) {
                        //     // Previous/next post navigation.
                        //     the_post_navigation(
                        //         array(
                        //             'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next Post', 'capezzahill' ) . '</span> ' .
                        //                 '<span class="screen-reader-text">' . __( 'Next post:', 'capezzahill' ) . '</span> <br/>' .
                        //                 '<span class="post-title">%title</span>',
                        //             'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'capezzahill' ) . '</span>' .
                        //             '<span class="screen-reader-text">' . __( 'Previous post:', 'capezzahill') . '</span> <br />' .
                        //             '<span class="post-title">%title</span>',
                        //         )
                        //     );
                        // }

                        // If comment are open or we have at least one comment, load up the comment template.
                        // if ( comments_open() || get_comments_number() ) {
                        //     comments_template();
                        // }
                        
                    endwhile; // End of the loop.
                ?>
            
            </main><!-- #main -->
        </section><!-- #primary -->

<?php
get_footer();