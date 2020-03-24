<?php
/**
 * Template part for displaying content on practices page.
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('flex'); ?>>



    <div class="entry-content">
        <header class="entry-header inline-block" data-aos="fade-right" data-aos-duration="1000">
            <?php echo the_title('<h1 class="entry-title inline-block after">', '</h1>'); ?>
        </header>
        <figure class="practice-image inline" style="float: right;" data-aos="fade-left" data-aos-duration="1000">
            <?php
                $alt = get_post_meta ( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
                $caption = get_the_post_thumbnail_caption() != '' ? get_the_post_thumbnail_caption() : $alt;
             ?>
            <img alt="<?php echo esc_html($alt); ?>" src="<?php the_post_thumbnail_url(); ?>" />
            <figcaption>
                <?php echo $caption; ?>
            </figcaption>
        </figure>
        <div data-aos="fade-up" data-aos-duration="1000"><?php the_content();?></div>
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
</article>