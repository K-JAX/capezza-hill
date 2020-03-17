<?php 
/**
 * Template Name: Attorney Archive
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main container">
        <div class="mx-3">
            <header class="page-header">
                <?php the_title('<h1 class="entry-title all-caps after">', '</h1>'); ?>
            </header><!-- .page-header -->

            <?php 
            // Start the Loop.
            $loop = new WP_Query( array(
                'post_type'     =>  'attorney',
                'orderby'       => 'menu_order',
                'order'         => 'ASC'
            ));
            if ( $loop->have_posts() ) :?>
                <section class="card-gallery flex">
                <?php while( $loop->have_posts() ) : $loop->the_post(); $count++ ?>
                    <?php
                        $color = get_field('feature_color');
                     ?>
                    <figure class="card quadrant half team-member before <?php echo $count % 2 == 1 ? 'odd' : 'even'; ?>" style="background: <?php echo $color; ?>">
                        <div class="portrait" style="background-image: url(<?php echo get_field('cropped_portrait')['url']; ?>);"></div>
                        <figcaption class="<?php echo $count % 2 == 1 ? 'odd' : 'even'; ?>">
                            <h2 class="feature-attorney-title formal mb-1"><?php echo get_the_title(); ?></h2>
                            <hr class="short blue left mb-1" />
                            <h3 class="formal my-1 ">Partner</h3>
                            <a class="relative informal" style="color: <?php echo get_field('link_color'); ?>" href="<?php echo get_permalink(); ?>">Learn about <?php echo get_field('informal_name'); ?> <?php echo capezzahill_get_icon_svg('chevron_right', 26); ?></a>
                        </figcaption>
                    </figure>
                <?php endwhile; ?>
                </section>
            <?php endif;  ?>
        </div>
        <div class="text-center">
            <?php if ( have_posts() ) : while( have_posts() ): the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; endif; ?>
        </div>
    </main>
</div>

<?php get_footer();