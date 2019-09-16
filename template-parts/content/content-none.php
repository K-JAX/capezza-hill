<?php
/**
 * Template part for displaying a message that posts cannot be found
 */

 ?>

 <section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php _e( 'Nothing Found', 'capezzahill'); ?></h1><!-- /.page-title -->
    </header><!-- /.page-header -->

    <div class="page-content">
        <?php
        if ( is_home() && current_user_can( 'publish_posts' ) ) :

            printf(
                '<p>' . wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                    __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>', 'capezzahill' ),
                    array(
                        'a' =>  array(
                            'href'  =>  array(),
                        ),
                    )
                ) . '</p>',
                esc_url( admin_url( 'post-new.php' ) )
            );

            elseif ( is_search() ) :
                ?>

                <p><?php _e( 'Sorry, but nothing matched your search term. Please try again with some different keywords.', 'capezzahill' ); ?></p>
                <?php
                get_search_form();

            else :
                ?>
                
                <p><?php _e( 'It seems we can&rsqui;t find what you&rsquo;re looking for. Perhaps searching can help.', 'capezzahill' ); ?></p>
                <?php
                get_search_form();
            
        endif;
        ?>
    </div><!-- /.page-content -->
 </section><!-- /.no-results not-found -->