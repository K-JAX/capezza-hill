<?php
/**
 * Custom widgets
 */

//  Contact

class Contact_Widget extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'contact-details',  // Base ID
            'Contact Details'   // Name
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'Contact_Widget' );
        });
 
    }
 
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );
 
    public function widget( $args, $instance ) {
 
        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
 
        echo '<div class="textwidget">';
 
        echo esc_html__( $instance['text'], 'text_domain' );
 
        echo '</div>';
 
        echo $args['after_widget'];
 
    }
 
    public function form( $instance ) {
 
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( '', 'text_domain' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'Text' ) ); ?>"><?php echo esc_html__( 'Text:', 'text_domain' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" cols="30" rows="10"><?php echo esc_attr( $text ); ?></textarea>
        </p>
        <?php
 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
 
        return $instance;
    }
 
}
$contact_widget = new Contact_Widget();



// Let the acf work into the widget
add_filter('dynamic_sidebar_params', 'my_dynamic_sidebar_params');

function my_dynamic_sidebar_params( $params ) {
	
	// get widget vars
	$widget_name = $params[0]['widget_name'];
	$widget_id = $params[0]['widget_id'];
	
	
	// bail early if this widget is not a Text widget
	if( $widget_name != 'Contact Details' ) {
		
		return $params;
		
	}

    // Get all ACF fields
    $email_icon     = get_field('email_icon', 'widget_' . $widget_id);
    $email          = get_field('email', 'widget_' . $widget_id);
    $phone_icon     = get_field('phone_icon', 'widget_' . $widget_id);    
    $phone          = get_field('phone', 'widget_' . $widget_id);
    $fax_icon       = get_field('fax_icon', 'widget_' . $widget_id);
    $fax            = get_field('fax', 'widget_' . $widget_id);
    $mail_icon      = get_field('mail_icon', 'widget_' . $widget_id);
    $mail           = get_field('mail', 'widget_' . $widget_id);
    $mail_address   = get_field('mail_address', 'widget_' . $widget_id);
    $locationimg    = get_field('location_img', 'widget_' . $widget_id);
    $map            = get_field('display_map', 'widget_' . $widget_id);

    if ( $locationimg ){
        $params[0]['before_widget'] .= sprintf('<div class="location-img"><img src="%s"/>', $locationimg['url']);
        if ( $map ){
            $params[0]['before_widget'] .= sprintf('<div class="map">%s</div>', $map);
        }
        $params[0]['before_widget'] .= sprintf('</div>');

    }
    
    $params[0]['after_widget'] .= '<div class="widget-box">';
    
    $params[0]['after_widget'] .= '<ul class="custom-icon-list">';
    
	if( $email ) {
		$params[0]['after_widget'] .= '<li>';
        $params[0]['after_widget'] .= sprintf('
                                                <img class="inline-icon" src="%s" />
                                                <div>
                                                    <span>%s</span>
                                                </div>', 
                                                $email_icon['sizes']['medium'],
                                                $email
                                            );
		$params[0]['after_widget'] .= '</li>';
    }
    
    if( $phone ) {
		$params[0]['after_widget'] .= '<li>';
        $params[0]['after_widget'] .= sprintf('
                                                <img class="inline-icon" src="%s" />
                                                <div>
                                                    <span>%s</span>
                                                </div>', 
                                                $phone_icon['sizes']['medium'],
                                                $phone
                                            );
		$params[0]['after_widget'] .= '</li>';    
    }
   
    if( $fax ) {
		$params[0]['after_widget'] .= '<li>';
        $params[0]['after_widget'] .= sprintf('
                                                <img class="inline-icon" src="%s" />
                                                <div>
                                                    <span>%s</span>
                                                </div>', 
                                                $fax_icon['sizes']['medium'],
                                                $fax
                                            );
		$params[0]['after_widget'] .= '</li>';    
    }

    if( $mail ) {
		$params[0]['after_widget'] .= '<li>';
        $params[0]['after_widget'] .= sprintf('
                                                <img class="inline-icon" src="%s" />
                                                <div>
                                                    <span>%s</span>
                                                </div>
                                                <div class="line-drop">
                                                </div>
                                                    <address>%s</address>', 
                                                $mail_icon['sizes']['medium'],
                                                $mail,
                                                $mail_address
                                            );
		$params[0]['after_widget'] .= '</li>';
    }

    $params[0]['after_widget'] .= '</ul>';

    
    $params[0]['after_widget'] .= '</div>';
    
	// return
	return $params;

}