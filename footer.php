        <div class="site-footer-whitespace-offset"></div>
        <footer id="colophon" class="site-footer">
            <div class="site-footer text-center">

            <a class="rst white-txt" href="<?php echo esc_url(home_url('/') ); ?>" rel="home"><h2 class="formal light mb-1"><?php echo bloginfo( 'name' ) ?>,<sub class="llp"> LLP</sub></h2></a>

                <hr class="short blue mb-3" />
                <address class="mb-3">30 South Pearl Street, Suite P-110,  Albany, New York 12207</address>
                <ul class="list-none px-0">
                    <li class="inline-block mx-1"><a href="mailto:info@capezzahill.com" alt="Send an email to info@capezzahill.com" class="rst white-txt">info@capezzahill.com</a></li>
                    <li class="inline-block mx-1"><a href="tel:5184786065" alt="Make a call to our office phone" class="rst white-txt"><i>o.</i> 518 478 6065</a></li>
                    <li class="inline-block mx-1"><a href="javascript:void(0)" class="rst white-txt"><i>f.</i> 518 407 5661</a></li>
                </ul>

                <small class="pb-3"><?php echo bloginfo( 'name' ) ?>,<sub class="llp"> LLP</sub> &copy; <?php print date("Y"); ?></small>

                <?php 
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link( '', '<span role="seperator" aria-hidden="true"></span>' );
                }
                ?>
                <?php if ( has_nav_menu( 'footer' ) ) : ?>
                    <nav class="footer-navigation" arial-label="<?php esc_attr_e( 'Footer Menu', 'capezzahill' ); ?>">
                        <?php
                        wp_nav_menu(
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