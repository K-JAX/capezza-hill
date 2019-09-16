<?php

function capezzahill_scripts() {
	wp_enqueue_style( 'capezzahill-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script('capezzahill-script', get_bloginfo('stylesheet_directory') . '/assets/js/script.min.js', array(), null, false);

    if ( has_nav_menu( 'top-right' ) ) {
        wp_enqueue_script( 'capezzahill-touch-navigation', get_theme_file_uri( '/assets/js/touch-keyboard-navigation.js' ), array() , '1.1', true );
    }
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script('comment-reply');
    }
}
add_action( 'wp_enqueue_scripts', 'capezzahill_scripts' );