<?php

if( ! defined( 'ABSPATH' ) ) exit;

class ACF_Location_Post_Parent extends ACF_Location {

    public function initialize() {
        $this->name = 'post_parent';
        $this->label = __( "Post Parent", 'acf' );
        $this->category = 'post';
        $this->object_type = 'post';
    }

    public function get_values( $rule ) {
		$choices = array();
		
		// Get post types.
		$post_types = acf_get_post_types(array(
			'show_ui'	=> 1,
			'exclude'	=> array('page', 'attachment')
		));
		
		// Get grouped posts.
		$groups = acf_get_grouped_posts(array(
			'post_type' => $post_types
		));
		
		// Append to choices.
		if( $groups ) {
			foreach( $groups as $label => $posts ) {
				$choices[ $label ] = array();
				foreach( $posts as $post ) {
					$choices[ $label ][ $post->ID ] = acf_get_post_title( $post );
				}
			}
		}
		return $choices;
	}

    public function match( $rule, $screen, $field_group ) {
        // Check screen args.
		if( isset($screen['post_id']) ) {
			$post_id = $screen['post_id'];
		} else {
			return false;
		}

        $ancestors = get_ancestors( $post_id, 'post' );
        $result = in_array( $rule['value'], $ancestors );

        if( $rule['operator'] == '!=' ) {
            return !$result;
        }
		
		return $result;
    }
}