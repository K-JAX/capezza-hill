<?php
flush_rewrite_rules();
// Attorney
add_action( 'init', 'register_attorney_cpt', 0 );

if (! function_exists('register_attorney_cpt') ){
    function register_attorney_cpt () {
        // labels
        $labels = array(
            'name'              =>  _x('Attorneys', 'Name of the post type', 'capezzahill'),
            'singular_name'     =>  _x('Attorney', 'Singular name', 'capezzahill'),
            'menu_name'         =>  _x('Attorneys', 'Display in menu bar', 'capezzahill'),
            'name_admin_bar'    =>  _x('Attorney', 'Add new on toolbar', 'capezzahill'),
            'add_new'           =>  __('Add new'),
            'add_new_item'           =>  __('Add new Attorney'),
            'new_item'           =>  __('New Attorney'),
            'edit_item'           =>  __('Edit Attorney'),
            'view_item'           =>  __('View Attorney'),
            'all_items'           =>  __('All Attorneys'),
            'search_items'           =>  __('Search Attorneys'),
            'parent_item_colon'           =>  __('Parent Attorney'),
            'not_found'           =>  __('No Attorney found'),
            'not_found_in_trash'           =>  __('No Attorney found in trash'),
            'featured_image'           =>  _x('Full scale attorney image', ''),
            'set_featured_image'           =>  _x('Set Attorney full screen image', ''),
            'remove_featured_image'           =>  _x('Remove Attorney image', ''),
            'use_featured_image'           =>  _x('Use as Attorney image', ''),
            'archives'           =>  _x('All Attorneys', ''),
            'insert_into_item'           =>  _x('Insert into Attorney bio', ''),
            'uploaded_to_this_item'           =>  _x('Uploaded to this Attorney bio', ''),
            'filter_items_list'           =>  _x('Filter Attorneys list', ''),
            'items_list_navigation'           =>  _x('Attorney list navigation', ''),
            'items_list'           =>  _x('Attorney list', ''),
        );
        // args
        $args = array(
            'label'     => 'Attorney',
            'labels'    =>  $labels,
            'description'           => 'Attorney member bios',
            'public'    =>  true,
            'capability_type'   => 'post',
            'publicly_queryable'    =>  true,
            'show_ui'  => true,
            'show_in_menu'  => true,
            'show_in_rest'  => true,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'query_var'  => true,
            'rewrite' =>  array( 'slug' => 'attorneys' ),
            'has_archive' =>  'attorneys-archive',
            'can_export'    => true,
            'exclude_from_search'   => false,
            'menu_position' =>  4,
            'menu_icon' =>  'dashicons-id',
            'supports'      => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields')
        );

        // action!
        register_post_type( 'attorney', $args );
    }
}



// Change the title placeholder for new attorney's
add_filter( 'enter_title_here', 'attorney_name_place_holder', 20, 2 );
function attorney_name_place_holder($title, $post) {
    if( $post->post_type == 'attorney' ) {
        $my_title = 'Add attorney\'s name';
        return $my_title;
    }
    return $title;
}

function attorney_post_block_template() {

    $post_type_object = get_post_type_object( 'attorney' );
    $post_type_object->template = array(
        array( 'ch-block/attorney-title' ),
        array( 'ch-block/attorney-contact' ),
        array( 'ch-block/attorney-about'),
        array( 'ch-block/attorney-services'),
        array( 'ch-block/attorney-industries'),
        array( 'ch-block/attorney-education'),
    );
  }
  add_action( 'init', 'attorney_post_block_template' );


add_action('init', 'attorney_register_post_meta');
function attorney_register_post_meta() {
    $cpt = 'attorney';
    register_post_meta( $cpt, 'attorney_title_block_field', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_contact_email', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_contact_phone_number', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_about_title', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_about', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_services_title', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_services', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_industries_title', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_industries', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_education_title', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));
    register_post_meta( $cpt, 'attorney_education', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string'
    ));

}

function attorney_create_vCard( $post_id ) {

	/*
     * In production code, $slug should be set only once in the plugin,
     * preferably as a class property, rather than in each function that needs it.
     */
    $post_type = get_post_type($post_id);

    // only update the attorneys custom post type on save
    if ( "attorney" != $post_type ) return;

    $vpost = get_post($post->ID);
    $filename = $vpost->post_name.".vcf";
    header('Content-type: text/x-vcard; charset=utf-8');
    // header("Content-Disposition: attachment; filename=".$filename);
    $data=null;
    $data.="BEGIN:VCARD\n";
    $data.="VERSION:3.0\n";
    $data.="FN:".$vpost->post_title."\n"; // get post title
    $data.="ORG:Client Company Name\n";
    // $data.="EMAIL;TYPE=work:" . get_post_meta( $vpost->ID, 'attorney_contact_email', true )."\n";  // get acf field value
    // $data.="TEL;WORK;VOICE:" .get_post_meta( $vpost->ID, 'attorney_contact_phone_number', true )."\n";  // get acf field value
    $data.="ADR;WORK;PREF:123 Fake Street;Fake City;MN;55106\n";  // get acf field value
    $data.="END:VCARD";
    $filePath = get_template_directory()."/vcard/".$filename; // you can specify path here where you want to store file.
    $file = fopen($filePath,"w");
    fwrite($file,$data);
    fclose($file);
}
add_action( 'save_post', 'attorney_create_vCard' );