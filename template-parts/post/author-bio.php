<?php
/**
 * The template for displaying Author info
 */

 if ( (bool) get_the_author_meta( 'description' ) ) : ?>
<div id="author-bio">
    <h2 class="author-title">
        <span class="author-heading">
            <?php
            printf(
                /* translators: %s: post author */
                __( 'Published by %s', 'capezzahill' ),
                esc_html( get_the_author() )
            );
            ?>
        </span>
    </h2>
    <p class="author-description">
        <?php the_author_meta( 'description' ); ?>
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-link" rel="author"></a>
            <?php _e( 'View more posts', 'capezzahill' ); ?>
    </p><!-- .author-description -->
</div><!-- .author-bio -->

<?php endif; ?>