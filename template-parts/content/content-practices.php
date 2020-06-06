<?php
/**
 * Template part for displaying content on practices page.
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('grid'); ?> data-aos="fade" data-aos-easing="linear" data-aos-duration="1000">
    <header class="entry-header text-center">
        <?php get_template_part( 'template-parts/header/entry', 'header'); ?>
    </header>

    <div class="entry-content text-center">
        <?php
        the_content();

        $args = array(
            'post_type'     => 'page',
            'posts-per-page'=> -1,
            'post_parent'   => $post->ID,
            'order'         => 'ASC',
            'orderby'       => 'menu_order'
        );

        $parent = new WP_Query( $args );

        if ( $parent->have_posts() ) : ?>
            <ul id="parent-<?php the_ID(); ?>" class="grid invisi-hover-list list-none" data-aos="fade-up" data-aos-duration="1000">

            <?php while ( $parent->have_posts() ) : $parent->the_post(); $count++; ?>
            <li class="invisi-box">
                <a class="rst white-txt" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
                    <div class="fg flex before"  style="background-color: <?php echo get_field('box_color'); ?>">
                        <h2 class="h6 text-center"><?php the_title(); ?></h2>
                    </div>
                    <div class="bg absolute" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div>
                </a>
            </li>


            <?php endwhile; ?>
        
            </ul>
        <?php endif; wp_reset_postdata(); ?>
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