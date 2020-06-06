<?php

function capezzahill_scripts() {
    // wp_enqueue_script('vendor', get_bloginfo('stylesheet_directory') . '/assets/js/vendor.min.js', array(), null, false);
	wp_enqueue_style( 'capezzahill-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script('capezzahill-script', get_bloginfo('stylesheet_directory') . '/assets/js/script.min.js', array(), null, true);

    if ( has_nav_menu( 'top-right' ) ) {
        // wp_enqueue_script( 'capezzahill-priority-menu', get_theme_file_uri( '/assets/js/priority-menu.js' ), array() , '1.1', true );
        // wp_enqueue_script( 'capezzahill-touch-navigation', get_theme_file_uri( '/assets/js/touch-keyboard-navigation.js' ), array() , '1.1', true );
    }
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script('comment-reply');
    }
}
add_action( 'wp_enqueue_scripts', 'capezzahill_scripts' );


// lets make sure this is also loaded in the admin panel as well
function admin_style() {
	wp_enqueue_style( 'capezzahill-style', get_bloginfo('stylesheet_directory') . '/styleeditor.css', array(), wp_get_theme()->get( 'Version' ) );
  }
  add_action('admin_enqueue_scripts', 'admin_style');