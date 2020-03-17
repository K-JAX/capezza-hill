<div class="center">
    <h1 class="site-title formal"><a href="<?php echo esc_url(home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?> <sub class="llp">LLP</sub></a></h1>
    <?php
    $description = get_bloginfo( 'description', 'display' );
    if ( $description || is_customize_preview() ) :
        ?>
            <hr class="short blue">
            <p class="site-description formal mb-3">
                <?php echo $description; ?>
            </p>
    <?php endif; ?>
    <a href="#primary" class="block relative jump-scroll" style="transform: translateX(-16px);"><?php echo capezzahill_get_icon_svg('chevron_down', 32); ?></a>
</div>