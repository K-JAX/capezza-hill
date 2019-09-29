<?php
/**
 * Displays header site branding
 */

 ?>
<div class="site-branding">
    <?php if ( has_custom_logo() ) : ?>
        <div class="site-logo"><?php the_custom_logo(); ?></div>
    <?php endif; ?>
    <?php $blog_info = get_bloginfo( 'name' ); ?>
    <?php if ( ! empty( $blog_info ) ) : ?>
        <?php if ( is_front_page() || is_home() ) : ?>
            <h1 class="site-title formal"><a href="<?php echo esc_url(home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?> <span>LLC</span></a></h1>
        <?php else : ?>
            <p class="site-title formal"><a href="<?php echo esc_url(home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?><?php echo is_home(); ?> <span>LLC</span></a></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    $description = get_bloginfo( 'description', 'display' );
    if ( $description || is_customize_preview() ) :
        ?>
            <p class="site-description">
                <?php echo $description; ?>
            </p>
    <?php endif; ?>
    

</div><!-- .site-branding -->