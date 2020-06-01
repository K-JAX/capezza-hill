<div class="site-header-nav-container">
    <?php if ( has_nav_menu( 'top-right' ) ) : ?>
    <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'capezzahill' ); ?>">
        <?php
        wp_nav_menu(
            array(
                'theme_location'    =>  'top-right',
                'container'         =>  'ul',
                'menu_class'        =>  'main-menu',
            )
        );
        ?>
    </nav><!-- #site-navigation -->
    <?php endif; ?>
    <?php if ( has_nav_menu( 'social' ) ) : ?>
        <nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'capezzahill' ); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'    =>  'social',
                        'menu_class'        =>  'social-links-menu',
                        'link_before'       =>  '<span class="screen-reader-text">',
                        'link_after'        =>  '</span>' . capezzahill_get_icon_svg('link'),
                        'depth'             =>  1,
                    )
                );
                ?>
        </nav><!-- .social-navigation -->
    <?php endif; ?>
    <div class="search-area formal">
            <?php get_search_form( ); ?>
    </div><!-- /.search-area -->
    <!-- Holds position so that the search active can turn absolute on mobile without changing the layout flow of the other elements -->
    <div class="search-placeholder"></div>
</div>