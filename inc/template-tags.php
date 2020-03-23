<?php
/**
 * Custom template tags for this theme
 */

 if ( ! function_exists('capezzahill_posted_on') ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function capezzahill_posted_on() {
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time<time class="updated" datetime="$3%s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C )),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        printf(
            '<span class="posted-on">%1$s<a href="%2$s" class="informal navy-txt" rel="bookmark"> %3$s</a></span>',
            capezzahill_get_icon_svg( 'watch', 16 ),
            esc_url( get_permalink() ),
            $time_string
        );
    }
 endif;

 if ( ! function_exists( 'capezzahill_posted_by' ) ) :
    /**
     * Prints Html with meta information about theme author
     */
    function capezzahill_posted_by() {
        printf(
            // translators: 1: SVG icon. 2: post author, only visible to screen readers. 3: author link.
            '<span class="byline">%1$s<span class="screen-reader-text">%2$s</span><span class="author vcard"> <a class="url fn n informal navy-txt" href="%3$s">%4$s</a></span></span></span>',
            capezzahill_get_icon_svg('person', 16),
            __( 'Posted by', 'capezzahill' ),
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_html( get_the_author() )
        );
    }
 endif;

if ( ! function_exists( 'capezzahill_comment_count' ) ) :
    /**
     * Prints HTML with the comment count for the current post.
     */
    function capezzahill_comment_count() {
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link"></span>';
            echo capezzahill_get_icon_svg( 'comment', 16 );

            /* translators: %s: Name of current post. Only visible to screen readers. */
            comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'capezzahill' ), get_the_title() ) );

            echo '</span>';
        }
    }
endif;
 
 if ( ! function_exists( 'capezzahill_entry_footer' ) ) :
    /**
     * Prints html with meta information for the categories, tags and comments.
     */

     function capezzahill_entry_footer() {

        // Hide author, post date, category and text for pages.
        if ( 'post' === get_post_type() ){

            // Posted by
            // capezzahill_posted_by();

            // Posted on
            capezzahill_posted_on();
            
            /* translators: used between list items, there is a space after the comma. */
            $categories_list = get_the_category_list( __( ', ', 'capezzahill' ) );
            if ( $categories_list ) {
                printf(
                    /* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of categories. */
                    '<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
                    capezzahill_get_icon_svg( 'archive', 16 ),
                    __( 'Posted in', 'capezzahill'),
                    $categories_list
                ); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma. */
            $tags_list = get_the_tag_list( '', __( ', ', 'capezzahill' ) );
            if ( $tags_list ) {
                printf(
                    /* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of tags. */
                    '<span class="tags-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
                    capezzahill_get_icon_svg( 'tag', 16 ),
                    __( 'Tags:', 'capezzahill' ),
                    $tags_list
                ); // WPCS: XSS OK.
            }
        }
        //  Comment count.
        // if ( ! is_singular() ) {
        //     capezzahill_comment_count();
        // }

        // Edit post link.
        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'capezzahill' ),
                    array(
                        'span'  => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link">' . capezzahill_get_icon_svg( 'edit', 16 ),
            '</span>'
        );
     }
 endif;

 if ( ! function_exists('capezzahill_post_thumbnail') ) :
    /**
     * Displays an optional post thumbnail
     */
    function capezzahill_post_thumbnail() {
        if ( ! capezzahill_can_show_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>
            <figure class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </figure><!-- .post-thumbnail -->
            <?php 
        else:
            ?>

            <figure class="post-thumbnail">
                <a href="<?php the_permalink(); ?>" class="post-thumbnail-inner" aria-hidden="true" tabindex="-1" >
                <?php the_post_thumbnail( 'post-thumbnail' ); ?>
            </a>
            </figure>
            <?php
        endif; // End is_singular().
    }
 endif;
 
 if ( ! function_exists( 'capezzahill_comment_avatar' ) ) :
    /**
     * Returns the HTML markup to generate a user avatar
     */
    function capezzahill_get_user_avatar_markup( $id_or_email = null ) {

        if ( ! isset( $id_or_email ) ) {
            $id_or_email = $get_current_user_id();
        }

        return sprintf('<div class="comment-user-avatar comment-author vcard"%s></div>', get_avatar( $id_or_email, capezzahill_get_avatar_size() ) );
    }
endif;

 if ( ! function_exists( 'capezzahill_discussion_avatars_list' ) ) :
    /**
     * Displays a list of avatars involved in a discussion for a given post.
     */
    function capezzahill_discussion_avatars_list( $comment_authors ) {
        if ( empty( $comment_authors ) ) {
            return;
        }
        echo '<ol class="discussion-avatar-list">', "\n";
        foreach ( $comment_authors as $id_or_email ) {
            printf(
                "<li>%s</li>\n",
                capezzahill_get_user_avatar_markup( $id_or_email )
            );
        }
        echo '</ol><!-- .discussion-avatar-list -->', "\n";
    }
 endif;

if ( ! function_exists( 'capezzahill_comment_form' ) ) :
    /**
     * Documentation for function
     */
    function capezzahill_comment_form( $order ) {
		if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {
			comment_form(
				array(
					'logged_in_as' => null,
					'title_reply'  => null,
				)
			);
		}
	}
endif;

 if( ! function_exists( 'capezzahill_the_posts_navigation' ) ) :
    /**
     * Documentation for function.
     */
    function capezzahill_the_posts_navigation() {
        the_posts_pagination(
            array(
                'mid_size'  =>  2,
                'prev_text' =>  sprintf(
                    '%s <span class="nav-prev-text">%s</span>',
                    capezzahill_get_icon_svg( 'chevron_left', 22 ),
                    __( 'Newer posts', 'capezzahill' )
                ),
                'next_text' =>  sprintf(
                    '<span class="nav-next-text>%s</span> %s',
                    __( 'Older posts', 'capezzahill' ),
                    capezzahill_get_icon_svg( 'chevron_right', 22 )
                ),
            )
        );
    }
 endif;

 function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 
 
 function endsWith($string, $endString) 
 { 
     $len = strlen($endString); 
     if ($len == 0) { 
         return true; 
     } 
     return (substr($string, -$len) === $endString); 
 } 
   
//  // Driver code 
//  if(endsWith("abcde","de")) 
//      echo "True"; 
//  else
//      echo "False"; 

// Code for looping through all of the meta for a post type template
// if ( ! function_exists( 'capezzahill_attorney_title_meta')){
//     function capezzahill_attorney_title_meta( $meta ) {
//         $cleanedMeta = array_slice($meta, 1);
//         $output = '';
//         foreach ($cleanedMeta as $key=>$val){
//             $title = endsWith($key, 'fields_title')  && !startsWith($key, '_');
//             $fields = endsWith($key, '_fields');
//             if($fields){
                
//             if( $title && $val[0] != '' ){ 
//                 $count++;
//                 $defaultActive = $count == 1 ? 'active' : '';
//                 $output .= '<li class="after ' . $defaultActive . '"><h2 class="h3"><a class="bio-button rst block" href="javascript:void(0)" data-target="'. $key .'">' . $val[0] . '</a></h2></li>';

//             }
//             }
//         }
//         echo $output;
//     }
// }

// Code for looping through all of the meta for a post type template
// if ( ! function_exists( 'capezzahill_all_the_meta')){
//     function capezzahill_all_the_meta( $meta ) {
//         $cleanedMeta = array_slice($meta, 1);
//         $output = '';
//         foreach ($cleanedMeta as $key=>$val){
//             $notMetaIDField = !startsWith($key, '_');
//             // $notConact = !endsWith($key, 'email') && !endsWith($key, 'number');
//             $notConact = !endsWith($key, 'email') && !endsWith($key, 'number');
//             $fields = endsWith($key, '_fields');

//             if ( $fields ) {
//                 // $output .= 'test passed';
//                 $count++;
//                 $defaultActive = $count == 1 ? 'active' : '';
//                 $output .= _('<div id="'. $key .'_content" class="bio-description-section absolute ' . $defaultActive . '">test passed' );
//                 // $title = endsWith($key, 'section_title') || endsWith($key, 'fields_title');
//                 // $description = endsWith($key, '_description');

//                 if( $title && $val[0] != '' ){
//                     $output .= '<h2 class="h3"><a class="bio-button rst block" href="javascript:void(0)">' . $val[0] . '</a></h2><hr class="shorter blue left" />';
//                 }
            
//                 // if( $description && $val[0] != '' ){
//                 //     $output .= '<div>' . $val[0] . '</div>';
//                 // }
                
//                 $output .= _('</div>');

//             }

//         }
//         echo $output;
//     }
// }