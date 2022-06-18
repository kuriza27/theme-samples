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
		echo '<ul class="list-unstyled d-flex align-items-end justify-content-end">';
        foreach ($this->parents as $item) {	
			$hasChild = "";
			foreach($this->menuItems as $childLi){
				if($childLi->menu_item_parent == $item->ID){
					$hasChild = 1;
					break;
				}				
			}
            

            $this->displayParentHTML($item->title,$item,$hasChild);
            $this->drawChildren($this->getChild($item->ID),$item);
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

            $class = "single-col";
            $class = "";
            if(!empty(get_field('menu__column',$data->ID)) && get_field('menu__column',$data->ID) == 2){
                $class = "double-col";
            }
        ?>
		<li class="menu-item menu-item-has-children <?php echo $class;?>">
			<a href="<?php echo $data->url;?>"><?php echo $title ?></a>
			<?php if($hasChild):?>
				<span class="icon-plus-light"></span>
			<?php endif;?>
		

        <?php
    }

    public function drawChildren($children,$item="") {
         global $wpdb;
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

        // print get_field('menu__column',$item->ID);
        // print "------";
        
        // print "<pre>";
        // print_r($children);
        // print "</pre>";
        // exit;

       
        
		if(count($children) > 0){
            
            if(!empty(get_field('menu__column',$item->ID)) && get_field('menu__column',$item->ID) == 2){
                echo '<div class="megamenu double-col-menu"><div class="megamenu-inner"><div class="sub-menu row">';
                $haslink = "";
                $left_content = get_field('left_content',$item->ID);

                echo	'<div class="col">
                            <h4>'.$left_content['title'].'</h4>
                            <p>'.$left_content['description'].'</p>
                        </div>';
                
                echo '<div class="col"><ul class="list-inline">';
                
               
                $ii = 0;

                foreach($children as $child){
                    
                    $query = $wpdb->prepare("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_key ='_menu_item_menu_item_parent' AND meta_value=%d", $child->ID);
                    $child_count = $wpdb->get_var($query);

                    if($child_count > 0){
                        if($ii > 0){
                            echo '</li></ul>';
                            $ii =0;
                        }         
                        echo '<li class="has_second_lc "><a href="'.$child->url.'">'.$child->title.'</a><ul>';
                    }elseif($child->menu_item_parent){                             
                            $ii++;
                            echo '<li><a href="'.$child->url.'">'.$child->title.'</a></li>';
                    }else{
                        if($ii > 0){
                            echo '</li></ul>';
                            $ii =0;
                        }         
                        echo '<li><a href="'.$child->url.'">'.$child->title.'</a></li>';                       
                    }
                    
                    
                }
                

                
               // echo $this->walker->walk($children, 2, $args);
                echo '</ul></div>';
                        
                
                echo "</div></div></div>";

            }else{        
                        
                
                echo '<div class="megamenu single-col-menu"><div class="megamenu-inner"><div class="sub-menu row">';
                echo '<div class="col">';                
                if(!empty(get_field('heading',$item->ID))){
                    echo '<h4>'.get_field('heading',$item->ID).'</h4>';
                }                
                echo '<ul class="list-inline">';
                $iii = 0;
                foreach($children as $child){
                        
                        $query = $wpdb->prepare("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_key ='_menu_item_menu_item_parent' AND meta_value=%d", $child->ID);
                        $child_count = $wpdb->get_var($query);

                        if($child_count > 0){
                            if($iii > 0){
                                echo '</li></ul>';
                                $iii =0;
                            }         
                            echo '<li class="has_second_lc sec_norm"><a href="'.$child->url.'">'.$child->title.'</a><ul>';
                        }elseif($child->menu_item_parent){                             
                                $iii++;
                                echo '<li><a href="'.$child->url.'">'.$child->title.'</a></li>';
                        }else{
                            if($iii > 0){
                                echo '</li></ul>';
                                $iii =0;
                            }         
                            echo '<li><a href="'.$child->url.'">'.$child->title.'</a></li>';                       
                        }
                        
                        
                }

                echo '</ul></div>';

            }
        }
		echo "</li>";

       
    }

}