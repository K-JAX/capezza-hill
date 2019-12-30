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
		<header class="site-header" style="background: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>) center/cover, linear-gradient(to bottom, rgba(255,255,255,0.75) 0%,rgba(162,162,162,0.32) 61%,rgba(0,0,0,0.75) 100%);">
			<div class="site-header-inner">
                <div class="site-branding-container" >
					<?php get_template_part( 'template-parts/header/site', 'branding'); ?>
                </div>
				<div class="site-header-nav-container">
					<?php get_template_part( 'template-parts/header/site', 'nav'); ?>
				</div>

			</div>
			<?php if ( is_front_page() || is_home() ) : ?>
			<div class="center">
      	      	<h1 class="site-title formal"><a href="<?php echo esc_url(home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?> <sub class="llp">LLP</sub></a></h1>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) :
					?>
						<hr class="short blue">
						<p class="site-description formal">
							<?php echo $description; ?>
						</p>
				<?php endif; ?>
				<a href="#primary" class="position-relative" ><?php echo capezzahill_get_icon_svg('chevron_down', 32); ?></a>
			</div>
			<?php endif; ?>
        </header>