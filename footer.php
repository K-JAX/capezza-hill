        <footer id="colophon" class="site-footer">
            <div class="site-footer">
                <small>&copy; <?php print date("Y"); ?></small>

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