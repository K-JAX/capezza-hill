        <footer id="colophon" class="site-footer">
            <div class="site-footer text-center">

                <h2 class="formal light mb-1"><?php echo bloginfo( 'name' ) ?><sub class="llp"> LLP</sub></h2>

                <hr class="short blue mb-3" />
                <address class="mb-3">30 South Pearl Street, Suite P-110,  Albany, New York 12207</address>

                <small class="pb-3"><?php echo bloginfo( 'name' ) ?><sub class="llp"> LLC</sub> &copy; <?php print date("Y"); ?></small>

                <?php 
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link( '', '<span role="seperator" aria-hidden="true"></span>' );
                }
                ?>
                <?php if ( has_nav_menu( 'footer' ) ) : ?>
                    <nav class="footer-navigation" arial-label="<?php esc_attr_e( 'Footer Menu', 'capezzahill' ); ?>">
                        <?php
                        wp_nav_manu(
                            array(
                                'theme_location'    =>  'footer',
                                'menu_class'        =>  'footer-menu',
                                'depth'             =>  1,
                            )
                        );
                        ?>
                    </nav><!-- .footer-navigation -->
                <?php endif; ?>
            </div>
        </footer>

    <?php wp_footer(); ?>    
    
    </body>
</html>