<?php

class main_menu_Walker extends Walker_Nav_Menu
{
    private $curItem;

    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){

        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }    

    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        $this->curItem = $object;

        $menuClass = implode( " ", $object->classes );
        
        if ( $depth == 0 ) {
            if( $args->has_children ) {
                $output .='<li class="'.$menuClass.' megamenu-list-toggle"><a href="'.$object->url.'">'.$object->title.'</a><span class="icon-plus-light"></span>';
            } else {
                $output .='<li class="'.$menuClass.'"><a href="'.$object->url.'">'.$object->title.'</a><span class="icon-plus-light"></span>';
            }
        } else{           
            if( $args->has_children ) {
                $output .='<li class="'.$menuClass.'"><a href="'.$object->url.'">'.$object->title.'</a><span class="icon-plus-light submenu-icon"></span>';     
            } else {
                $output .='<li class="'.$menuClass.'"><a href="'.$object->url.'">'.$object->title.'</a>';    
            }
        }       
    }

    function end_el(&$output, $object, $depth = 0, $args = array()) {   
        
        $end = get_field( 'end', $object->ID );

        if( $end ) {
            $output .= '</li></ul></div></div>';
            $output .= '<div class="col col-megamenu-links">
                            <div class="col-inner-links">
                                <ul class="list-inline">';
        } else {
            $output .= '</li>';
        }
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {

        $isMegaMenu = get_field( 'has_mega_menu_content', $this->curItem->ID ); 
        $indent = str_repeat("\t", $depth);

        if( $depth == 0 ) {
            if( $isMegaMenu ) {
                $content = get_field( 'content', $this->curItem->ID );

                $output .= '<div class="megamenu-panel">
                                <div class="megamenu-pane">
                                    <div class="container megamenu-container">
                                        <div class="megamenu-row row">
                                            <div class="row-position"><span class="megamenu-caret"></span>';
                                    $output .= '<div class="col col-megamenu-content">
                                                    <div class="col-inner-content">'.
                                                    $content
                                                .'  </div>
                                                </div>';
                                    $output .= '<div class="col col-megamenu-links">
                                                    <div class="col-inner-links">
                                                        <ul class="list-inline">';
            } else {
                $output .= '<div class="megamenu-panel">
                                <div class="megamenu-pane">
                                    <div class="container megamenu-container">
                                        <div class="megamenu-row row">
                                            <div class="row-position"><span class="megamenu-caret"></span>';
                                    $output .= '<div class="col col-megamenu-links">
                                                    <div class="col-inner-links">
                                                        <ul class="list-inline">';
            }
        } else {
            $output .= '<ul class="list-inline menu-links sub-sub-menu">';
        }
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {

        $isMegaMenu = get_field( 'is_mega_menu', $this->curItem->ID ); 
        $indent = str_repeat("\t", $depth);

        if( $depth == 0 ) {
                    $output .=          '</ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        } else {
            $output .= '</ul>';
        }
    }
}

class mobile_menu_Walker extends Walker_Nav_Menu
{
    private $curItem;

    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){

        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }    

    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        $this->curItem = $object;

        $menuClass = implode( " ", $object->classes );
        
        if ( $depth == 0 ) {
            if( $args->has_children ) {
                $output .='<li class="'.$menuClass.' megamenu-list-toggle"><a href="'.$object->url.'">'.$object->title.'</a><span class="icon-plus-light submenu-icon"></span>';
            } else {
                $output .='<li class="'.$menuClass.'"><a href="'.$object->url.'">'.$object->title.'</a><span class="icon-plus-light submenu-icon"></span>';
            }
        } else{           
            if( $args->has_children ) {
                $output .='<li class="'.$menuClass.'"><a href="'.$object->url.'">'.$object->title.'</a><span class="icon-plus-light submenu-icon"></span>';     
            } else {
                $output .='<li class="'.$menuClass.'"><a href="'.$object->url.'">'.$object->title.'</a>';    
            }
        }       
    }
}