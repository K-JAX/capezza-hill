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
    <?php 
        $attorney_page = get_page_by_title('attorneys')->ID;
        $attorney_img = get_the_post_thumbnail_url( $attorney_page, 'full' );
        $meta = get_post_meta( get_the_ID(), '', true );
    ?>
		<header class="site-header before flex" style="flex-flow: column; overflow: hidden; background: url(<?php echo $attorney_img; ?>) center/cover, linear-gradient(to bottom, rgba(255,255,255,0.75) 0%,rgba(162,162,162,0.32) 61%,rgba(0,0,0,0.75) 100%);">
			<div class="mx-3">
				<div class="site-header-inner container">
					<?php 
						get_template_part( 'template-parts/header/site', 'branding');
						get_template_part( 'template-parts/header/site', 'nav'); 
					?>
				</div>
			</div>
            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<div class="container w100"><div class="mx-3 my-3 relative"><p id="breadcrumbs">','</p></div></div>' );
                }
            ?>
            <figure class="container w100 attorney-hero">
                <figcaption class="title-contact-box"  data-aos="fade-left" data-aos-duration="1000" >
                    <header>
                        <h1 class="feature-attorney-title formal notranslate" ><?php echo get_the_title(); ?></h1>
                    </header>
                    <div class="title-banner py-5 h4" ><?php echo $meta['attorney_title_block_field'][0]; ?></div>
                    <ul class="contact-details grid custom-icon-list">
                        <?php 
                            $contact = get_field('attorney_title_section');
                         ?>
                        <li class="email">
                            <img class="inline-icon" alt="Email <?php echo $contact['email']; ?>" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/mail-icon.png'; ?>" />
                            <a class="informal" alt="Link to open email with <?php echo $contact['email']; ?>" href="mailto:<?php echo $contact['email']; ?>"><?php echo $contact['email']; ?></a>
                        </li>
                        <li class="phone">
                            <img class="inline-icon" alt="Call number <?php echo $contact['phone_number']; ?>" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/phone-icon.png'; ?>" />
                            <a class="informal" alt="Telephone link to call <?php echo $contact['phone_number']; ?>" href="tel:<?php echo $contact['phone_number']; ?>"><?php echo $contact['phone_number']; ?></a>
                        </li>
                        <?php if ( isset($contact['vcard']['url']) ): ?>
                        <li class="vcard">
                            <img class="inline-icon" alt="vCard Download" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/card-icon.png'; ?>" />
                            <a class="informal" alt="Download <?php echo get_the_title(); ?>'s vCard." href="<?php echo $contact['vcard']['url']; ?>" download>vCard</a>
                        </li>
                        <?php endif; ?>
                        <li class="print no-print">
                            <img class="inline-icon" alt="View this attorney's gallery." src="<?php echo get_stylesheet_directory_uri() . '/assets/images/printer-icon.png'; ?>" />
                            <a class="informal underline" alt="Print this Attorney's page" href="javascript:void(0)" onclick="window.print();return false;" >Print this Biography</a>
                        </li>
                        <hr class="wide no-print">
                        <li class="no-print">
                            <div class="gallery-container no-print"><?php echo do_shortcode( '[ngg src="tags" ids="'. get_field('informal_name') .'" display="basic_thumbnail" thumbnail_crop="0"]' ); ?></div>
                        </li>
                    </ul>
                </figcaption>
                <img data-aos="fade" data-aos-duration="500" alt="Full of image of <?php echo get_the_title(); ?>"  class="attorney-full-hero" src="<?php echo get_the_post_thumbnail_url( $post, 'full' ); ?>" />
            </figure>
            <h2 class="w100 title-banner text-center relative"><a href="#primary" class="relative jump-scroll informal">Read Bio <span style="margin-left: 10px;"><?php echo capezzahill_get_icon_svg('triple_chevron_down', 36); ?></span></a></h2>
        </header>