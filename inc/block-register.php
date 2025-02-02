<?php
/**
 * Registers site blocks
 */

// Create a function for enqueuing your block
function ch_blocks(){
	// Register your script
	wp_register_script(
		'capezzahill-blocks',
		get_template_directory_uri() . '/assets/js/blocks.min.js',
		array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
	);

	// Register styling (optional - if separate css is necessary)

	// Now assign these registered script and style (above) as handles
	// associated with block using the WordPress register block function
	register_block_type('ch-block/all-blocks', array( 'editor_script' => 'capezzahill-blocks'));
}
add_action( 'init', 'ch_blocks' );

function ch_attorney_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'attorney-blocks',
				'title' => __( 'Attorney Blocks', 'attorney-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'ch_attorney_block_category', 10, 2);

function ch_testimonials_loop_block() {
	register_block_type( 'ch/testimonials-loop', array(
		'render_callback' => 'render_testimonials_loop_block'
	) );
}
add_action( 'init', 'ch_testimonials_loop_block' );

function render_testimonials_loop_block( $attributes, $content ) {
	ob_start();
	?><div><p>Test</p></div><?php
	// get_template_part('template-parts/post/testimonial-tag');
	return ob_get_clean();
}
