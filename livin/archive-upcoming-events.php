<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Livin
 */

get_header('', array('bodyClass' => 'blog-page blog-category'));
$category = get_queried_object();
$paged = !empty($_GET['pg'])? $_GET['pg'] : 1;


$catnamejm = $category->label;
$ym ="";

$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
$args = [   
    'post_type' => ['upcoming-events'],
    'post_status' => 'publish',
    'orderby' => 'date',
	'order'   => 'DESC',	
    'paged'   => $paged,
	'posts_per_page' => 6        
];




$catParent = get_terms('category');

$parentCat = [];
$childrenCat = [];
foreach($catParent as $rs){
    if($rs->parent > 0){
        $childrenCat[] = [
            'term_id' => $rs->term_id,
            'name' => $rs->name
        ];
    }else{
        $parentCat[] = [
            'term_id' => $rs->term_id,
            'name' => $rs->name
        ];
    }
}
$dateArchive = "Blog";


    $template =dirname(__FILE__) .'/template-parts/content-post-types.php';

	ob_start();		
	include($template);
	$var = ob_get_contents();
	ob_end_clean();  

	echo $var;


//get_sidebar();
get_footer();
