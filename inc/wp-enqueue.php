<?php

function capezzahill_scripts() {
	wp_enqueue_style( 'capezzahill-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script('capezzahill-script', get_bloginfo('stylesheet_directory') . '/assets/js/script.min.js', array(), null, false);
}
add_action( 'wp_enqueue_scripts', 'capezzahill_scripts' );