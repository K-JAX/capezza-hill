<?php
/**
 * Custom Meta Boxes
 */

    add_action( 'add_meta_boxes', 'capezzahill_add_meta_box' );
if ( ! function_exists( 'capezzahill_add_meta_box' ) ) {
    /**
     * Add meta box to page screen
     * 
     */
    function capezzahill_add_meta_box() {
        add_meta_box( 'additional-page-metabox-options', esc_html__( 'Feature', 'capezzahill' ), 'capezzahill_metabox_controls', 'page', 'side', 'low' );
        add_meta_box( 
            'capezzahill_custom_attachment', 
            esc_html__( 'Custom Attachment', 'capezzahill' ), 
            'capezzahill_custom_attachment', 
            'attorney', 
            'side', 
            'low' 
        );
    }
}

add_action( 'save_post', 'capezzahill_save_metaboxes' );
if ( ! function_exists( 'capezzahill_metabox_controls' ) ) {
    /**
     * Meta box render function
     */
    function capezzahill_metabox_controls( $post ) {
        $meta = get_post_meta( $post->ID );
        $capezzahill_featured_page = ( isset( $meta['capezzahill_featured_page'][0] ) && '1' === $meta['capezzahill_featured_page'][0] ) ? 1 : 0;
        $capezzahill_feature_link_text = ( isset( $meta['capezzahill_feature_link_text'][0] ) && '' !== $meta['capezzahill_feature_link_text'][0] ) ? $meta['capezzahill_feature_link_text'][0] : '';

        wp_nonce_field( 'capezzahill_control_meta_box', 'capezzahill_control_meta_box_nonce' ); // Always add nonce to your meta boxes!
        ?>
        <style type="text/css">
            .post_meta_extras p{margin: 20px;}
			.post_meta_extras label{display:block; margin-bottom: 10px;}
        </style>
		<div class="post_meta_extras">
            <p>
                <label><input type="checkbox" name="capezzahill_featured_page" value="1" <?php checked( $capezzahill_featured_page, 1 ); ?> /><?php esc_attr_e( 'Featured on homepage', 'capezzahill' ); ?></label>
			</p>
            <p>
                <label for="capezzahill_feature_link_text">Feature Link Text</label>
                <input id="capezzahill_feature_link_text" name="capezzahill_feature_link_text" type="text" value="<?php echo esc_attr($capezzahill_feature_link_text); ?>">
            </p>
        </div>
            <?php
    }
}


if ( ! function_exists( 'capezzahill_custom_attachment' ) ) {

    function capezzahill_custom_attachment() {
        
        wp_nonce_field('capezzahill_custom_attachment_meta_box', 'capezzahill_custom_attachment_meta_box_nonce');
        
        $html = '<p class="description">';
            $html .= 'Upload your PDF here.';
        $html .= '</p>';
        $html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25" />';
        
        echo $html;
    } // end wp_custom_attachment
}

if ( ! function_exists( 'capezzahill_save_metaboxes' ) ) {
    /**
     * Save controls from the meta boxes
     * 
     * @param in $post_id Current post id
     * @since 1.0.0
     */
    function capezzahill_save_metaboxes( $post_id ) {
        /**
         * We need to verify this came from our screen and with proper authorization
         * Add as many nonces as you have metaboxes
         */
        if ( !isset( $_POST['capezzahill_control_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['capezzahill_control_meta_box_nonce'] ), 'capezzahill_control_meta_box' ) ) { //Input var oka.
            return $post_id;
        }

        // Check the user's permissions
        if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) { // Input var okay.
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
        /**
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        /* Ok to save */

        $capezzahill_featured_page = ( isset( $_POST['capezzahill_featured_page'] ) && '1' === $_POST['capezzahill_featured_page'] ) ? 1 : 0;
        update_post_meta( $post_id, 'capezzahill_featured_page', esc_attr( $capezzahill_featured_page ) );

        if ( isset( $_POST['capezzahill_feature_link_text'] ) ) {
            update_post_meta( $post_id, 'capezzahill_feature_link_text', sanitize_text_field( wp_unslash( $_POST['capezzahill_feature_link_text'] ) ) );
        }

    }
}

add_action('save_post', 'capezzahill_custom_attachment_meta_save');
if ( ! function_exists( 'capezzahill_custom_attachment_meta_save' ) ) {

    function capezzahill_custom_attachment_meta_save($id) {

        /* security validation */
        if(!wp_verify_nonce($_POST['capezzahill_custom_attachment_nonce'], plugin_basename(__FILE__))) {
            return $id;
        } // end if
    }

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $id;
    }

    if('attorney' == $_POST['post_type']) {
        if(!current_user_can('edit_page', $id)) {
            return $id;
        }
    } else {
        if(!current_user_can('edit_page', $id)){
            return $id;
        }
    }

    // Make sure the file array isn't empty
    if(!empty($_FILES['capezzahill_custom_attachment']['name'])){

        // Use the WordPress API to upload the file
        $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['capezzahill_custom_attachment']['tmp_name']));
        
        if(isset($upload['error']) && $upload['error'] != 0) {
            wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
        }
    } else{
        wp_die("The file type that you've uploaded is not a vCard.");
    }

}