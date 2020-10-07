<?php

// Capezza Hill functions

if ( ! function_exists( 'capezzahill_setup' ) ) :
    function capezzahill_setup(){

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Auto generate title tag without hard-coding
        add_theme_support( 'title-tag' );
        add_filter( 'wp_title', 'wpdocs_hack_wp_title_for_home' );

        // Post thumbnails 
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1568, 9999 );

        register_nav_menus(
            array(
                'top-right' => __( 'Header Area', 'capezzahill'),
                'footer'    => __( 'Footer Menu', 'capezzahill'),
                'social'    => __( 'Social Links Menu', 'capezzahill'),
            )
        );

        add_theme_support( 
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        add_theme_support(
            'custom-logo',
            array(
                'height'        =>  190,
                'width'         =>  190,
                'flex-width'    =>  false,
                'flex-height'   => false,
                'header-text' => array( 'site-title', 'site-description' ),
            )
        );
        
        // language
        load_theme_textdomain( 'capezzahill', get_template_directory() . '/languages' );
        
        // Allows for live refresh when updating widgets in customizer I think
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Allow user to decide full with options for editor
        add_theme_support( 'align-wide' );
        
        // Theme support for visual look of blocks on backend only
        add_theme_support( 'wp-block-styles' );

        add_theme_support( 'editor-styles' );
        add_editor_style( 'custom-editor-style.css' );

        // Add excerpts to page
        add_post_type_support( 'page', 'excerpt' );
        
        add_theme_support( 
            'editor-font-sizes',
            array(
                array(
                    'name'      =>  __( 'Small', 'themeLangDomain'),
                    'shortName' =>  __('S', 'capezzahill'),
                    'size'      =>  19.5,
                    'slug'      =>  'small'
                ),
                array(
                    'name'      =>  __('Normal', 'themeLangDomain'),
                    'shortName' =>  __('M', 'capezzahill'),
                    'size'      =>  22,
                    'slug'      =>  'normal'
                ),
                array(
                    'name'      =>  __('Large', 'themeLangDomain'),
                    'shortName' =>  __('L', 'capezzahill'),
                    'size'      =>  36.5,
                    'slug'      =>  'large'
                ),
                array(
                    'name'      =>  __('Huge', 'themeLangDomain'),
                    'shortName' =>  __('XL', 'capezzahill'),
                    'size'      =>  49.5,
                    'slug'      =>  'huge'
                )
            )
         );

         add_theme_support(
             'editor-color-palette',
             array(
                //  Come back to this when you add customizer support for colors ;)
				array(
					'name'  => 'default' === get_theme_mod( 'primarytop_colortop-right' ) ? __( 'Blue', 'capezzahill' ) : null,
					'slug'  => 'primary',
					'color' => capezzahill_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Dark Blue', 'capezzahill' ) : null,
					'slug'  => 'secondary',
                    'color' => capezzahill_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
                ),
                array(
                    'name'  =>  __( 'Ligh Blue', 'capezzahill'),
                    'slug'  =>  'light-blue',
                    'color' =>  '#0077B6'
                ),
                array(
                    'name'  =>  __( 'Navy', 'capezzahill'),
                    'slug'  =>  'navy',
                    'color' =>  '#10153F'
                ),
                array(
                    'name'  =>  __( 'Dark Gray', 'capezzahill'),
                    'slug'  =>  'dark-gray',
                    'color' =>  '#333333'
                ),
                array(
                    'name'  =>  __( 'Light Gray', 'capezzahill'),
                    'slug'  =>  'light-gray',
                    'color' =>  '#B0B7BB'
                ),
                array(
                    'name'  =>  __( 'White', 'capezzahill'),
                    'slug'  =>  'white',
                    'color' =>  '#fff'
                ),
                array(
                    'name'  =>  __( 'Black', 'capezzahill'),
                    'slug'  =>  'black',
                    'color' =>  '#000'
                ),
            )
        );
         
        add_theme_support('responsive-embeds');
    }

    add_action( 'after_setup_theme', 'capezzahill_setup' );
endif;


add_filter( 'wp_title', 'custom_titles', 10, 2 );
function custom_titles( $title, $sep ) {

    //Check if custom titles are enabled from your option framework
    if ( ot_get_option( 'enable_custom_titles' ) === 'on' ) {
        //Some silly example
        $title = "Some other title" . $title;
    }

    return $title;
}


function capezzahill_widgets_init() {

    register_sidebar(
        array(
            'name'          =>  __( 'contact', 'capezzahill' ),
            'id'            =>  'contact',
            'description'   =>  __( 'Add widgets here to appear in your footer.', 'capezzahill' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<h2 class="widget-title">',
            'after_title'   =>  '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          =>  __( 'Footer', 'capezzahill' ),
            'id'            =>  'sidebar-1',
            'description'   =>  __( 'Add widgets here to appear in your footer.', 'capezzahill' ),
            'before_widget' =>  '<section id="%1$s" class="widget %2s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<h2 class="widget-title">',
            'after_title'   =>  '</h2>',
        )
    );
    
}
add_action( 'widgets_init', 'capezzahill_widgets_init' );

function capezzahill_content_width(){
    $GLOBALS['content_width'] = apply_filters( 'capezzahill_content_width', 884 );
}
add_action( 'after_setup_theme', 'capezzahill_content_width', 0);


function capezzahill_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'capezzahill_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function capezzahill_editor_customizer_styles() {
	wp_enqueue_style( 'capezzahill-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );
	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'capezzahill-editor-customizer-styles', capezzahill_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'capezzahill_editor_customizer_styles' );


// Display custom color CSS in customizer and on frontend (from capezzahill)
function capezzahill_colors_css_wrap() {
	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}
	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo capezzahill_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'capezzahill_colors_css_wrap' );

require get_template_directory() . '/inc/wp-enqueue.php';

require get_template_directory() . '/inc/custom-post-types.php';

require get_template_directory() . '/inc/custom-widgets.php';

require get_template_directory() . '/classes/class-capezzahill-svg-icons.php';

require get_template_directory() . '/classes/class-capezzahill-walker-comment.php';

require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/icon-functions.php';

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/customizer.php';

// require get_template_directory() . '/inc/meta-boxes.php';

// require get_template_directory() . '/inc/block-register.php';


/**
 * Custom controller
 * See http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
 */
if ( class_exists('WP_Customize_Control') ) {
    class Example_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'checkbox';

        public function render_content() {
            ?>
            <label>
            <span class="customize-control-select"><?php echo esc_html( $this->label ); ?></span>
            <input <?php $this->link(); ?> type="checkbox" value="1" class="code" <?php checked( 1, $this->value() ); ?> />
            </label>
            <?php
        }
    }
}


