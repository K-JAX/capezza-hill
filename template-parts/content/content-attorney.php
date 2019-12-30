<?php
/**
 * Content created from the attorney
 */
?>
<article id="post<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( ! capezzahill_can_show_post_thumbnail() ) : ?>

    <?php endif; ?>

    <div id="entry-content">
        <?php
        $meta = get_post_meta( get_the_ID(), '', true );
        capezzahill_attorney_title_meta( $meta );
        the_content(
            sprintf(
                wp_kses(
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'capezzahill'),
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
                'before'    =>  '<div class="page-links">' . __( 'Pages:', 'capezzahill'),
                'after'     =>  '</div>'
            )
        );
        ?>
    </div>
    <footer class="entry-footer">
        <?php capezzahill_entry_footer(); ?>
    </footer>

    <?php if ( ! is_singular( 'attachment' ) ) : ?>
    <?php get_template_part( 'template-parts/post/author', 'bio' ); ?>
    <?php endif; ?>
    
</article>