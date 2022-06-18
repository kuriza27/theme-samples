<?php

class wpb_widget extends WP_Widget {
  
    function __construct() {
        parent::__construct('wpb_widget',__('Custom Social Media Icons', 'wpb_widget_domain'),array( 'description' => __( 'Custom Social Media Icons with Links', 'wpb_widget_domain' ), ));
    }
  
  
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );	
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];	
        // This is where you run the code and display the output
        echo __( 'Hello, World!', 'wpb_widget_domain' );
        echo $args['after_widget'];
    }
          

    public function form( $instance ) {
        
        if ( isset( $instance[ 'title' ] ) ) {

            $title = $instance[ 'title' ];

        }else {

            $title = __( 'New title', 'wpb_widget_domain' );

        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p> 
            
            <input type="checkbox" <?php echo $instance[ 'ck_instagram' ]? "checked='checked'" : "" ;?> class="checkbox" name="<?php echo $this->get_field_name( 'ck_instagram' ); ?>" id="<?php echo $this->get_field_id( 'ck_instagram' ); ?>" value="1" />
            <label for="ck_instagram">Instagram</label><br/>
            <input type="text" placeholder="Instagram Link" class="widefat" name="<?php echo $this->get_field_name( 'in_instagram' ); ?>" id="<?php echo $this->get_field_id( 'in_instagram' ); ?>" value="<?php echo $instance[ 'in_instagram' ]; ?>" style="margin:10px 0;"/>
        
            <input type="checkbox" <?php echo $instance[ 'ck_youtube' ]? "checked='checked'" : "" ;?> class="checkbox" name="<?php echo $this->get_field_name( 'ck_youtube' ); ?>" id="<?php echo $this->get_field_id( 'ck_youtube' ); ?>" value="1" />
            <label for="ck_youtube">Youtube</label><br/>
            <input type="text" placeholder="Youtube Link" class="widefat" name="<?php echo $this->get_field_name( 'in_youtube' ); ?>" id="<?php echo $this->get_field_id( 'in_youtube' ); ?>" value="<?php echo $instance[ 'in_youtube' ]; ?>" style="margin:10px 0;"/>
        
            <input type="checkbox" <?php echo $instance[ 'ck_fb' ]? "checked='checked'" : "" ;?> class="checkbox" name="<?php echo $this->get_field_name( 'ck_fb' ); ?>" id="<?php echo $this->get_field_id( 'ck_fb' ); ?>" value="1" />
            <label for="ck_fb">Facebook</label><br/> 
            <input type="text" placeholder="Facebook Link" class="widefat" name="<?php echo $this->get_field_name( 'in_fb' ); ?>" id="<?php echo $this->get_field_id( 'in_fb' ); ?>" value="<?php echo $instance[ 'in_fb' ]; ?>" style="margin:10px 0;"/>
        
            <input type="checkbox" <?php echo $instance[ 'ck_tw' ]? "checked='checked'" : "" ;?> class="checkbox" name="<?php echo $this->get_field_name( 'ck_tw' ); ?>" id="<?php echo $this->get_field_id( 'ck_tw' ); ?>" value="1" />
            <label for="ck_tw">Twitter</label><br/> 
            <input type="text" placeholder="Twitter Link" class="widefat" name="<?php echo $this->get_field_name( 'in_tw' ); ?>" id="<?php echo $this->get_field_id( 'in_tw' ); ?>" value="<?php echo $instance[ 'in_tw' ]; ?>" style="margin:10px 0;"/>       
           
            <input type="checkbox" <?php echo $instance[ 'ck_in' ]? "checked='checked'" : "" ;?> class="checkbox" name="ck_in" id="<?php echo $this->get_field_id( 'ck_instagram' ); ?>" value="1" />
            <label for="ck_in">LinkedIn</label><br/> 
            <input type="text" placeholder="LinkedIn Link" class="widefat" name="<?php echo $this->get_field_name( 'in_in' ); ?>" id="<?php echo $this->get_field_id( 'in_in' ); ?>" value="<?php echo $instance[ 'in_in' ]; ?>" style="margin:10px 0;"/>
        </p>

        <?php 
    }     

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

} 

if ( function_exists('register_sidebar') ){
	register_sidebar(array(
			'name' => 'News and Updates Sidebar',
			'id' => 'news_updates_jm',
			'before_widget' => '<aside class = "sidebar news-updates-sidebar">',
			'after_widget' => '</aside>',
			'before_title' => '',
			'after_title' => '',
		)
	);
}

