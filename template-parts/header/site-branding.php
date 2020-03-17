<?php
/**
 * Displays header site branding
 */

 ?>
<div class="site-branding-container" >
    <div class="site-branding">
        <?php if ( has_custom_logo() ) : ?>
            <div class="site-logo"><?php the_custom_logo(); ?></div>
        <?php endif; ?>
        <?php $blog_info = get_bloginfo( 'name' ); ?>
        <?php if ( ! empty( $blog_info ) ) : ?>
            <?php if ( !is_front_page() && !is_home() ) : ?>
                <p class="site-title formal"><a href="<?php echo esc_url(home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?><?php echo is_home(); ?> <sub class="llp">LLP</sub></a></p>
            <?php endif; ?>
        <?php endif; ?>
    </div><!-- .site-branding -->
</div>