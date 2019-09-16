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
        <header class="site-header">

            <div class="site-branding-container">
                <?php get_template_part( 'template-parts/header/site', 'branding'); ?>
            </div>
            <div class="search-area">
            <?php get_search_form( ); ?>
            </div><!-- /.search-area -->
        </header>