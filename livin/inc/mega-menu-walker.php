<?php

class MY_Menu_Walker_Ext extends Walker {

    var $tree_type = array('post_type', 'taxonomy', 'custom');
    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {

    $output .='<li><a href="'.$object->url.'">'.$object->title.'</a>';
    }

    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output.='</li>';
    }

}

class my_custom_menu {

public $menu;
public $menuItems;
public $parents;
public $walker;

public function __construct($menu_location) {
    $this->setMenu($menu_location);
    $this->getMenuItems();
    $this->getParents();

    $this->walker = new MY_Menu_Walker_Ext();
}

public function drawMenu() {

}

public function setMenu($menu_location) {

    $this->menu = $this->getMenuByLocation($menu_location);
}

protected function getMenuByLocation($menu_location) {
    $locations = get_nav_menu_locations();

    $menu = null;
    if ($locations && isset($locations[$menu_location])) {
        $menu = wp_get_nav_menu_object($locations[$menu_location]);
    }

    return $menu;
}

public function get() {

}

public function getMenuItems() {
    if ($this->menuItems)
        return $this->menuItems;
    $this->menuItems = wp_get_nav_menu_items($this->menu);

    return $this->menuItems;
}

public function getParents() {
    if ($this->parents)
        return $this->parents;
    $parents = array();

    foreach ($this->menuItems as $item) {
        if ($item->menu_item_parent == 0) {
            array_push($parents, $item);
        }
    }

    $this->parents = $parents;
    return $this->parents;
}

public function getChild($parent_id) {

    $childs = array();


    foreach ($this->menuItems as $item) {
        if ($parent_id == $item->menu_item_parent) {
            $item->menu_item_parent = 0;

            array_push($childs, $item);
            foreach ($this->menuItems as $item1) {
                if ($item->ID == $item1->menu_item_parent) {
                    array_push($childs, $item1);
                }
            }
        }
    }



    return $childs;
}

public function draw() {
    #echo "<div class='postit-surround'>";
    echo '<ul class="list-unstyled d-flex justify-content-lg-end mb-0">';
    foreach ($this->parents as $item) {	
        $hasChild = "";
        foreach($this->menuItems as $childLi){
            if($childLi->menu_item_parent == $item->ID){
                $hasChild = 1;
                break;
            }				
        }

        $this->displayParentHTML($item->title,$item,$hasChild);
        $this->drawChildren($this->getChild($item->ID), $item->ID);
    }
    echo "</ul>";
   # echo "</div>";
}
public function displayParentHTMLback($title) {
    ?>
    <li class="menu-item menu-item-has-children">
        <a href="#">
            <div class="postit">
                <div class="pin">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/drawing-pin.png">
                </div>
                <div class="postit-title">
                    <h1 class="nav-title-text"><?php echo $title ?></h1>
                </div>
                <div class="corner-peel">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/corner-flick-cyan.png">
                </div>
            </div>
        </a>
    </li>

    <?php
}
public function displayParentHTML($title,$data,$hasChild) {
    $isMegaMenu = get_field( 'has_mega_menu', $data->ID );
    $class = ($hasChild)? "menu-item-has-children header-nav-item" : "";
    $class = ($isMegaMenu)? "menu-item-has-megamenu current-mm-link js-mm-link" : $class;
    
    ?>
    <li class="<?php echo $class;?>">
        <a href="<?php echo $data->url;?>"><?php echo $title ?></a>
        <?php if($hasChild):?>
            <span class="icon-plus-light"></span>
        <?php endif;?>
    

    <?php
}
public function drawChildren($children, $item_id) { 
    $defaults = array('menu' => '', 'container' => 'div', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
        'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth' => 0, 'walker' => '', 'theme_location' => '');
    $args = array(
        'theme_location' => 'header-menu',
        'container' => 'div',
        'container_class' => 'navigation-dropdown',
        'items_wrap' => '<ul >%3$s</ul>',
        'depth' => 0,
    );
    $args = wp_parse_args($args, $defaults);

    $mainHtml = "";
    $has_head = "";

    $poster = get_field('mega_menu_poster', $item_id );
    $isMegaMenu = get_field('has_mega_menu', $item_id );

    echo $contactInfo;
    $colCount = count(array_filter($children, function($obj) {
        if( $obj->menu_item_parent == 0 ) {
            return true;
        }
    }));

    $colGrid = 'col-2';

    if ( $colCount == 1 ) $colGrid = 'col-12';
    if ( $colCount == 2 ) $colGrid = 'col-6';
    if ( $colCount == 3 ) $colGrid = 'col-4';
    if ( $colCount == 4 ) $colGrid = 'col-3';


    if(!empty($children)){
        $mainHtml = '<div class="mega-menu js-mega-menu">
                                        <div class="mm-shop-content">
                                            <div class="container">
                                                <div class="row">';
        $haslink = "";
        $custom_nav_head = "";
        $subHtml = "";


        // print "<pre>";
        // print_r($children);
        // print "</pre>";
        // exit;

        if($isMegaMenu && $poster){		
            if( have_rows( 'social_media', 'option' ) ) {
                $smLoop = '';
                while ( have_rows( 'social_media', 'option' ) ) { the_row();
                    $smLoop .= '<li><a href="'. get_sub_field( 'url' ) .'"><span class="icon-'. get_sub_field( 'icon' ) .'"></span></a></li>';
                }
                $socialMedia = '<div class="col-12">
                                    <div class="social-wrap p-0">
                                        <ul class="social list-unstyled d-flex justify-content-center">'.
                                         $smLoop   
                                        .'</ul>
                                    </div>
                                </div>';
            }
            else {
                $socialMedia = '';
            }

            $subHtml = '<div class="col-auto header-menu-col-left">
                        <div class="mm-shop-article d-flex">
                            <div class="mm-shop-img">'.
                                wp_get_attachment_image($poster['image'], 'ZC_238x298')
                            .'</div>
                            <div class="mm-article-content">
                                <div class="">
                                    <h2 class="mm-article-title"><a href="'. $poster['link'] .'">
                                        '. $poster['heading'] .'</a></h2>
                                    <h5 class="mb-0">'. $poster['text'] .'</h5>
                                </div>
                            </div>                            
                        </div>'.
                        $socialMedia
                    .'<h5 class="text-center purple-text">'.$poster['contact_info'].'</h5></div>';
                    
        }

        foreach($children as $rs){	
            $isColTitle = get_field('is_column_title', $rs->ID );

            if( $isColTitle && $isMegaMenu ){
                
                if($custom_nav_head){
                    $custom_nav_head .= '</ul></div><div class="'. $colGrid .'"><h5 class="h5">'.$rs->title.'</h5><ul class="nav flex-column">';
                }else{
                    $custom_nav_head .= '	<div class="'. $colGrid .'"><h5 class="h5">'.$rs->title.'</h5><ul class="nav flex-column">';
                }
                
                $haslink = 2;

            }elseif( $isColTitle & !$isMegaMenu ){

                $has_head = $rs->title;
                

            }elseif($haslink == 2){

                $custom_nav_head .= '<li><a href="'.$rs->url.'">'.$rs->title.'</a></li>';
                                    

            }else{
                if($haslink == 2){
                    $custom_nav_head .= '</ul></div>';
                    $haslink = "";
                }else{
                    $normalLink .= '<li><a href="'.$rs->url.'">'.$rs->title.'</a></li>';
                }

                

                $haslink = 1;
            }
        }	

        if($custom_nav_head){
            // echo '<div class="col"><ul class="list-inline">';
            // echo $this->walker->walk($children, 2, $args);
            // echo '</ul></div>';
            $mainHtml .= $subHtml.'<div class="col d-flex mm-shop-menus">
                        <div class="row w-100">
                            '.$custom_nav_head.'
                        </div>
                    </div>';

            $mainHtml .= "</div></div></div></div>";		

        }else{

                 $mainHtml = '<div class="nav-nested">
                                <h5 class="h5">'.$has_head.'</h5>
                                <ul class="nav flex-column">
                                    '.$normalLink.'
                                </ul>
                            </div>';

        }		
        
        echo $mainHtml;


        
    }
    echo "</li>";

   
}

}


class mobile_main_menu_Walker extends Walker_Nav_Menu
{
    private $curItem;

    var $tree_type = array('post_type', 'taxonomy', 'custom');
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

        $isTitle = get_field('is_column_title', $object->ID);
        $heading = ($isTitle) ? '<h4 class="mt-3">'. $object->title .'</h4>':''; 
        
        if ( $depth == 0 ) {
            if( $args->has_children ) {
                $output .='<li class="border-bottom"><a href="'.$object->url.'" class="mm-link">'.$object->title.'<span class="mm-toggle-submenu"></span></a>';
            }
            else {
                $output .='<li class="border-bottom"><a href="'.$object->url.'" class="mm-link">'.$object->title.'</a>';
            }
        }
        elseif ( $isTitle ) {
            $isNotEmptyTitle = ($object->title != '<p></p>');

            if( $isNotEmptyTitle ) {
                $output .= '<h4 class="mt-3 font-weight-bold">'. $this->curItem->title .'</h4>';
            }
        }
        else{           
            $output .='<li><a href="'.$object->url.'">'.$object->title.'</a>';            
        }       
    }

    function end_el(&$output, $object, $depth = 0, $args = array()) {   
        $isTitle = get_field('is_column_title', $object->ID);

        if( !$isTitle ) {
            $output.='</li>';      
        }
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {

        $isTitle = get_field('is_column_title', $this->curItem->ID);    
        $indent = str_repeat("\t", $depth);

        if( $depth == 0 ) {
            $output .= "\n$indent<div class='mm-content'>\n";
        }
        else {
            $output .= "\n$indent<ul class='mm-submenu'>\n";
        }
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        if( $depth == 0 ) {
            $output .= "$indent</div>\n";
        }
        else {
            $output .= "$indent</ul>\n";
        }
    }
}

?>