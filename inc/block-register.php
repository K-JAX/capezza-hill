<?php
/**
 * Registers site blocks
 */

//  create a function for enqueuing your blocak
// function ch_blocks(){
//     // register your script
//     wp_register_script(
//         'capezzahill-blocks',
//         get_template_directory_uri() . '/assets/js/blocks.min.js',
//         array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
//     );

//     // register styling (optional - if separate css is necessary )

//     // now assign these registered script and style (above) as handles
//     // associated with block using the wordpress register block function
//     register_block_type('ch-block/all-blocks', array( 'editor_script' => 'capezzahill-blocks'));

// };
// add the action to call your function
// add_action( 'init', 'ch_blocks' );

// function ch_attorney_block_category( $categories, $post ) {
// 	return array_merge(
// 		$categories,
// 		array(
// 			array(
// 				'slug' => 'attorney-blocks',
// 				'title' => __( 'Attorney Blocks', 'attorney-blocks' ),
// 			),
// 		)
// 	);
// }
// add_filter( 'block_categories', 'ch_attorney_block_category', 10, 2);