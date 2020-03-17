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
		<header class="site-header before" style="background: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>) center/cover, linear-gradient(to bottom, rgba(255,255,255,0.75) 0%,rgba(162,162,162,0.32) 61%,rgba(0,0,0,0.75) 100%);">
			<div class="mx-3">
				<div class="site-header-inner container">
					<?php 
						get_template_part( 'template-parts/header/site', 'branding');
						get_template_part( 'template-parts/header/site', 'nav'); 
					?>
				</div>
			</div>
			<?php 
			if ( is_front_page() || is_home() ) :
				get_template_part( 'template-parts/header/cover', 'hero-branding');
			endif; 
			?>
        </header>