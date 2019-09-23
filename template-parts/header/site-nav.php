<?php if ( has_nav_menu( 'top-right' ) ) : ?>
    <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'capezzahill' ); ?>">
        <?php
        wp_nav_menu(
            array(
                'theme_location'    =>  'top-right',
                'menu_class'        =>  'main-menu formal',
                'items_wrap'        =>  '<ul id="%1$s" class="%2$s" tabindex="0">%3$s</ul>',
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
            <?php get_search_form( ); ?><div><?php printf(capezzahill_get_icon_svg( 'search', 22 )); ?></div>
    </div><!-- /.search-area -->