<?php
/**
 * Displays content of a single post
 */
?>
 <article id="post<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( ! capezzahill_can_show_post_thumbnail() ) : ?>
    <header class="entry-header">
        <?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
    </header>
    <?php endif; ?>

    <div id="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators %s: Name: of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'capezzahill' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                    ),
                    get_the_title()
            )
        );

        wp_link_pages(
            array(
                'before'    => '<div class="pages-links">' . __( 'Pages:', 'capezzahill'),
                'after'     => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php capezzahill_entry_footer(); ?>
    </footer> <!-- .entry-footer -->

    <?php if ( ! is_singular( 'attachment' ) ) : ?>
    <?php get_template_part( 'template-parts/post/author', 'bio' ); ?>
    <?php endif; ?>
    
 </article><!-- #post-${ID} -->