<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta name="description" content="<?php echo get_bloginfo('description'); ?>" />
        <meta charset="<?php echo get_bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> >
    <?php wp_body_open(); ?>
		<header class="site-header" style="background: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>) center/cover;">
			<div class="site-header-inner">
                <div class="site-branding-container" >
					<?php get_template_part( 'template-parts/header/site', 'branding'); ?>
                </div>
				<div class="site-header-nav-container">
					<?php get_template_part( 'template-parts/header/site', 'nav'); ?>
				</div>
            <!-- <div class="featured-img"></div> -->
			<?php /* if ( is_singular() && capezzahill_can_show_post_thumbnail() ) : ?>
				<div class="site-featured-image">
					<?php
						capezzahill_post_thumbnail();
						the_post();
						$discussion = ! is_page() && capezzahill_can_show_post_thumbnail() ? twentynineteen_get_discussion_data() : null;
						$classes = 'entry-header';
						if ( ! empty( $discussion ) && absint( $discussion->responses ) > 0 ) {
							$classes = 'entry-header has-discussion';
						}
					?> 
					<div class="<?php echo $classes; ?>">
						<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
					</div><!-- .entry-header -->
					<?php rewind_posts(); ?>
				</div>
			<?php endif; */ ?> 
			</div>
        </header>