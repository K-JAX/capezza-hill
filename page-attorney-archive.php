<?php 
/**
 * Template Name: Attorney Archive
 */
get_header();
?>

<div id="primary" class="content-area" style="overflow: hidden;" data-aos="fade" data-aos-easing="linear" data-aos-duration="1000">
    <main id="main" class="site-main container">
        <div class="mx-3 mb-5" >
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
                <section class="card-gallery flex" style="overflow:hidden;">
                <?php while( $loop->have_posts() ) : $loop->the_post(); $count++ ?>
                    <?php
                        $color = get_field('feature_color');
                     ?>
                    <figure data-aos-duration="1500" <?php echo $count %2 == 1 ? 'data-aos="fade-right"' : 'data-aos="fade-left"' ?> class="card flex quadrant half team-member before <?php echo $count % 2 == 1 ? 'odd' : 'even'; ?>" style="background: <?php echo $color; ?>">
                        <a class="portrait flex" style="justify-content: center;" href="<?php echo get_permalink(); ?>"><img style="height: 100%; width: auto;" alt="Portrait image of <?php echo get_the_title(); ?>" src="<?php echo get_field('cropped_portrait')['url']; ?>" /></a>
                        <figcaption class="<?php echo $count % 2 == 1 ? 'odd' : 'even'; ?> relative">
                            <a class="relative no-underline notranslate" href="<?php echo get_permalink(); ?>"><h2 class="feature-attorney-title formal white-txt mb-1"><?php echo get_the_title(); ?></h2></a>
                            <hr class="short blue left mb-1" />
                            <h3 class="formal my-1 ">Partner</h3>
                            <a class="relative informal" style="color: <?php echo get_field('link_color'); ?>" href="<?php echo get_permalink(); ?>">Learn about <?php echo get_field('informal_name'); ?> <?php echo capezzahill_get_icon_svg('chevron_right', 26); ?></a>
                        </figcaption>
                    </figure>
                <?php endwhile; ?>
                </section>
            <?php endif;  ?>
        </div>
        <div class="text-center mb-5">
            <?php if ( have_posts() ) : while( have_posts() ): the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; endif; ?>
        </div>
    </main>
</div>

<?php get_footer();