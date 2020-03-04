<?php 
/**
 * Template Name: Attorney Archive
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main container">
        <div class="mx-3">
            <?php the_title('<h1 class="all-caps">', '</h1>'); ?>

            <?php if ( have_posts() ) : while( have_posts() ): the_post(); ?>

            <header class="page-header">

                <?php the_content(); ?>
            </header><!-- .page-header -->
            <?php endwhile; endif; ?>
            <?php 
            // Start the Loop.
            $loop = new WP_Query( array(
                'post_type'  =>  'attorney'
            ));
            if ( $loop->have_posts() ) :
                while( $loop->have_posts() ) : $loop->the_post(); ?>
                    <div>
                        <h2><?php echo get_the_title(); ?></h2>
                    </div>
                <?php endwhile; 
            endif;  ?>
        </div>
    </main>
</div>

<?php get_footer();