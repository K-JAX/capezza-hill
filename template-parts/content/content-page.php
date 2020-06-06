<?php
/**
 * Template part for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header" data-aos="fade-right" data-aos-duration="800">
        <?php get_template_part( 'template-parts/header/entry', 'header'); ?>
    </header>

    <div class="entry-content" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="150" >
        <?php
        the_content();
        wp_link_pages(
            array(
                'before'    => '<div class="page-links">' . __('Pages:', 'capezzahill' ),
                'after'     => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Post title. Only visible to screen readers. */
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'capezzahill'),
                        array(
                            'span'  =>  array(
                                'class' =>  array(),
                            ),
                        )
                    ),
                        get_the_title()
                ),
                '<span class="edit-link">' . capezzahill_get_icon_svg( 'edit', 16 ),
                '</span>'
            );
            ?>
        </footer>
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->