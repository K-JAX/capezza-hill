<?php
/**
 * Capezza Hill: Customizer
 */

 function capezzahill_customize_register( $wp_customize ){
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'capezzahill_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'capezzahill_customize_partial_blogdescription',
			)
		);
	}
	/**
	 * Primary color.
	 */
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => 'default',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'capezzahill_sanitize_color_option',
		)
	);
	$wp_customize->add_control(
		'primary_color',
		array(
			'type'     => 'radio',
			'label'    => __( 'Primary Color', 'capezzahill' ),
			'choices'  => array(
				'default'  => _x( 'Default', 'primary color', 'capezzahill' ),
				'custom' => _x( 'Custom', 'primary color', 'capezzahill' ),
			),
			'section'  => 'colors',
			'priority' => 5,
		)
	);
	// Add primary color hue setting and control.
	$wp_customize->add_setting(
		'primary_color_hue',
		array(
			'default'           => 199,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color_hue',
			array(
				'description' => __( 'Apply a custom color for buttons, links, featured images, etc.', 'capezzahill' ),
				'section'     => 'colors',
				'mode'        => 'hue',
			)
		)
	);
	// Add image filter setting and control.
	$wp_customize->add_setting(
		'image_filter',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'image_filter',
		array(
			'label'   => __( 'Apply a filter to featured images using the primary color', 'capezzahill' ),
			'section' => 'colors',
			'type'    => 'checkbox',
		)
	);
}

 add_action( 'customize_register', 'capezzahill_customize_register' );

//  Render the site title for the selective refresh partial.
function capezzahill_customize_partial_blogname() {
	bloginfo( 'name' );
}

//  Render the site tagline for the selective refresh partial.
 function capezzahill_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

// Bind JS handlers to instantly live-preview changes.
function capezzahill_customize_preview_js() {
    wp_enqueue_script( 'capezzahill-customize-preview', get_theme_file_uri('assets/js/customize-preview.js'), array('customize-preview'), '20181231', true );
}
add_action( 'customize_preview_init', 'capezzahill_customize_preview_js' );

function capezzahill_panels_js(){
    wp_enqueue_script( 'capezzahill-customize-controls', get_theme_file_uri('/assets/js/customize-controls.js'), array(), '20181231', true );
}
add_action( 'customize_controls_enqueue_scripts', 'capezzahill_panels_js' );


function capezzahill_sanitize_color_option( $choice ) {
	$valid = array(
		'default',
		'custom',
	);
	if ( in_array( $choice, $valid, true ) ) {
		return $choice;
	}
	return 'default';
}