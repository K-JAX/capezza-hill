<?php
/**
 * Functions which enhance the theme be hooking into WordPress
 */

/**
 * Adds custom classes to the array of body classes.
 */



function capezzahill_body_classes( $classes ) { 
    
    if ( is_singular() ) {
        // Adds `singular` to singular pages.
        $classes[] = 'singular';
    } else {
        // Adds `hfeed` to non singular pages.
        $classes[] = 'hfeed';
    }

    // Adds a class if image filters are enabled.
    if ( capezzahill_image_filters_enabled() ) {
        $classes[] = 'image-filters-enabled';
    }

	
    return $classes;
    
}

add_filter( 'body_class', 'capezzahill_body_classes' );

/**
 * Add custom class to the array of posts classes.
 */
function capezzahill_post_classes( $classes, $class, $post_id ) {
    $classes[] = 'entry';

    return $classes;
}
add_filter( 'post_class', 'capezzahill_post_classes', 10, 3);

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function capezzahill_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'capezzahill_pingback_header' );

/**
 * Changes comment form default fields.
 */
 function capezzahill_comment_form_defaults( $defaults ) {
    $comment_field = $defaults['comment_field'];

     // Adjust heigh of comment form
     $defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

     return $defaults;
 }
 add_filter( 'comment_form_defaults', 'capezzahill_comment_form_defaults' );

/**
 * Filters the default archive titles.
 */
function capezzahill_get_the_archive_title() {
    if ( is_category() ) {
        $title = __( 'Category Archives: ', 'capezzahill' ) . '<span class="page-description">' . single_term_title( '', false ) . '</span>';
    } elseif ( is_tag() ) {
        $title = __( 'Tag Archives: ', 'capezzahill' ) . '<span class="page-description">' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = __( 'Author Archives: ', 'capezzahill' ) . '<span class="page-description">' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'Yearly Archives: ', 'capezzahill' ) . '<span class="page-description">' . get_the_date( _x( 'Y', 'yearly archives date format', 'capezzahill' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = __( 'Monthly Archives: ', 'capezzahill' ) . '<span class="page-description">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'capezzahill' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = __( 'Daily Archives: ', 'capezzahill' ) . '<span class="page-description">' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = __( 'Post Type Archives: ', 'capezzahill' ) . '<span class="page-description">' . post_type_archive_title( '', false ) . '</span>';
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: %s: Taxonomy singular name */
		$title = sprintf( esc_html__( '%s Archives:', 'capezzahill' ), $tax->labels->singular_name );
	} else {
		$title = __( 'Archives:', 'capezzahill' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'capezzahill_get_the_archive_title' );

/**
 * Determines if post thumbnail can be displayed.
 */
function capezzahill_can_show_post_thumbnail() {
    return apply_filters( 'capezzahill_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
* Returns true if image filters are enabled on the theme options.
*/
function capezzahill_image_filters_enabled() {
   return 0 !== get_theme_mod( 'image_filter', 1 );
}

/**
 * Add custom sizes attribute to responsive image functionality for post thumbnails.
 */
function capezzahill_post_thumbnail_sizes_attr( $attr ) {

    if ( is_admin() ) {
        return $attr;
    }

    if ( ! is_singular() ) {
        $attr['sizes'] = '(max-width: 34.9rem) calc(100vw - 2rem), (max-width: 53rem) calc(8 * (100vw / 12)), (min-width: 53rem) calc(6 * (100vw / 12)), 100vw';
    }
    
    return $attr;
    
}
add_filter( 'wp_get_attachment_image_attributes', 'capezzahill_post_thumbnail_sizes_attr', 10, 1 );
 
/**
 * Returns the size for avatars used in the theme.
 */
function capezzahill_get_avatar_size() {
    return 60;
}

function capezzahill_is_comment_by_post_author( $comment = null ) {
    if ( is_object( $comment ) && $comment->user_id > 0 ) {
        $user = get_userdata( $comment->user_id );
        $post = get_post( $comment->comment_post_ID );
        if ( ! empty( $user ) && ! empty( $post ) ) {
            return $comment->user_id === $post->post_author;
        }
    }
    return false;
}

function capezzahill_get_discussion_data() {
     static $discussion, $post_id;

     $cutten_post_id = get_the_ID();
     if ( $current_post_id === $post_id ){
         return $disucssion; /* If we have discussion information for post ID, return cached object */
     } else {
        $post_id = $current_post_id;
     }
        $comments= get_comments(
            array(
                'post_id'   =>  $current_post_id,
                'orderby'   =>  'comeent_date_gmt',
                'order'     =>  get_option( 'coment_order', 'asc'), /* Respect comment order from Settings >> Discussion. */
                'status'    =>  'approve',
                'number'    =>  20,
            )
        );
    $authors = array();
    foreach ( $comments as $comment ){
        $authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment-> user_id : $comment->comment_author_email;
    }

    $authors = array();
    foreach ( $comments as $comment ) {
        $authors[] = ( (int) $comment-> $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
    }
    
    $authors    = array_unique( $authors );
    $discussion = (object) array(
        'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
        'responses' => get_comments_number( $current_post_id ), /* Number of responses */
    );
    
    return $discussion;
 }

 /**
  * Add an extra menu to our nav for our priority+ navigation to use
  */
  function capezzahill_add_ellipses_to_nav( $nav_menu, $args ) {
	if ( 'top-right' === $args->theme_location ) :
		$nav_menu .= '<button class="burger main-menu-more-toggle reset-btn" tabindex="-1" aria-label="More" aria-haspopup="true" aria-expanded="false">';
		$nav_menu .= '<span class="screen-reader-text">' . esc_html__( 'More', 'capezzahill' ) . '</span>';
		$nav_menu .= capezzahill_get_icon_svg( 'burger', 36 );
		$nav_menu .= '</button>';
	endif;
	return $nav_menu;
}
add_filter( 'wp_nav_menu', 'capezzahill_add_ellipses_to_nav', 10, 2 );


  /**
   * Adjustments to menu attributes to support WCAG 2.0 recommendations
   * for flyout and dropdown menus.
   */
function capezzahill_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

    // Add [aria-haspopup] and [aria-expanded] to menu items that have children
    $item_has_children = in_array( 'menu-item-has-children', $item->classes );
    if ( $item_has_children ) {
        $atts['aria-haspopup'] = 'true';
        $atts['aria-expanded'] = 'false';
    }
    
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'capezzahill_nav_menu_link_attributes', 10, 4 );

/**
 * Add a dropdown icon to top-level menu items
 */

function capezzahill_add_dropdown_icons( $output, $item, $depth, $args ) {
	// Only add class to 'top level' items on the 'primary' menu.
	if ( ! isset( $args->theme_location ) || 'top-right' !== $args->theme_location ) {
		return $output;
	}
	if ( in_array( 'mobile-parent-nav-menu-item', $item->classes, true ) && isset( $item->original_id ) ) {
		// Inject the keyboard_arrow_left SVG inside the parent nav menu item, and let the item link to the parent item.
		// @todo Only do this for nested submenus? If on a first-level submenu, then really the link could be "#" since the desire is to remove the target entirely.
		// $link = sprintf(
		// 	'<button class="menu-item-link-return" tabindex="-1">%s',
		// 	capezzahill_get_icon_svg( 'chevron_left', 24 )
		// );
		// replace opening <a> with <button>
		$output = preg_replace(
			'/<a\s.*?>/',
			$link,
			$output,
			1 // Limit.
		);
		// replace closing </a> with </button>
		$output = preg_replace(
			'#</a>#i',
			'</button>',
			$output,
			1 // Limit.
		);
	} elseif ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
		// Add SVG icon to parent items.
		$icon = '<sup>&#9662;</sup>';
		$output .= sprintf(
			'<button class="sub-menu-expand link-dropdown reset-btn" aria-haspopup="true" aria-expanded="false">%s</button>',
			$icon
		);
	}
	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'capezzahill_add_dropdown_icons', 10, 4 );

 /**
  * Create a nav menu item to be displayed on mobile to navigate from submenu back to the parent
  * This duplicates each parent nav menu item and makes it the first child of itself.
  */

  function capezzahill_add_mobile_parent_nav_menu_items( $sorted_menu_items, $args ) {
	static $pseudo_id = 0;
	if ( ! isset( $args->theme_location ) || 'top-right' !== $args->theme_location ) {
		return $sorted_menu_items;
	}
	$amended_menu_items = array();
	foreach ( $sorted_menu_items as $nav_menu_item ) {
		$amended_menu_items[] = $nav_menu_item;
		if ( in_array( 'menu-item-has-children', $nav_menu_item->classes, true ) ) {
			$parent_menu_item                   = clone $nav_menu_item;
			$parent_menu_item->original_id      = $nav_menu_item->ID;
			$parent_menu_item->ID               = --$pseudo_id;
			$parent_menu_item->db_id            = $parent_menu_item->ID;
			$parent_menu_item->object_id        = $parent_menu_item->ID;
			$parent_menu_item->classes          = array( 'mobile-parent-nav-menu-item' );
			$parent_menu_item->menu_item_parent = $nav_menu_item->ID;
			$amended_menu_items[] = $parent_menu_item;
		}
	}
	return $amended_menu_items;
}
// add_filter( 'wp_nav_menu_objects', 'capezzahill_add_mobile_parent_nav_menu_items', 10, 2 );

/**
 * Convert HSL to HEX colors
 */
function capezzahill_hsl_hex( $h, $s, $l, $to_hex = true) {

    $h /= 360;
    $s /= 100;
    $l /= 100;

    $r = $l;
    $g = $l;
    $b = $l;
    $v = ( $l <= 0.5 ) ? ( $l * ( 1.0 + $s ) ) : ( $l + $s - $l * $s );
	if ( $v > 0 ) {
		$m;
		$sv;
		$sextant;
		$fract;
		$vsf;
		$mid1;
		$mid2;
		$m = $l + $l - $v;
		$sv = ( $v - $m ) / $v;
		$h *= 6.0;
		$sextant = floor( $h );
		$fract = $h - $sextant;
		$vsf = $v * $sv * $fract;
		$mid1 = $m + $vsf;
		$mid2 = $v - $vsf;
		switch ( $sextant ) {
			case 0:
				$r = $v;
				$g = $mid1;
				$b = $m;
				break;
			case 1:
				$r = $mid2;
				$g = $v;
				$b = $m;
				break;
			case 2:
				$r = $m;
				$g = $v;
				$b = $mid1;
				break;
			case 3:
				$r = $m;
				$g = $mid2;
				$b = $v;
				break;
			case 4:
				$r = $mid1;
				$g = $m;
				$b = $v;
				break;
			case 5:
				$r = $v;
				$g = $m;
				$b = $mid2;
				break;
		}
    }
	$r = round( $r * 255, 0 );
	$g = round( $g * 255, 0 );
	$b = round( $b * 255, 0 );
	if ( $to_hex ) {
		$r = ( $r < 15 ) ? '0' . dechex( $r ) : dechex( $r );
		$g = ( $g < 15 ) ? '0' . dechex( $g ) : dechex( $g );
		$b = ( $b < 15 ) ? '0' . dechex( $b ) : dechex( $b );
		return "#$r$g$b";
	}
	return "rgb($r, $g, $b)";
}