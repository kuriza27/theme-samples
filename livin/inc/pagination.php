<?php

function ea_archive_navigation($v="",$qr ="") {

	// print "<pre>";
	// print_r($_SERVER);
	// print "</pre>";
	// exit;

	$settings = array(
		'count' => 7,
		'prev_text' => "prev",
		'next_text' => "next",
	);

	if(!empty($qr)){
		$wp_query = $qr;
		$pagedj = !empty($_GET['pg'])? $_GET['pg'] : 1;
		$current = max( 1, $pagedj );
	}else{
		global $wp_query;
		$current = max( 1, get_query_var( 'paged' ) );
	}

	
	$postsCnt = $wp_query->found_posts;
	
	
	
	$total = $wp_query->max_num_pages;
	$links = array();

	// Offset for next link
	if( $current < $total )
		$settings['count']--;

	if( $current + 3 < $total ) {
		$settings['count'] = $settings['count'] - 2;
	}
	$prev = $next = "";
	// Previous
	if( $current > 1 ) {
		$settings['count']--;
		$prev = ea_archive_navigation_link($v, $current - 1, 'pagination-previous', $settings['prev_text'] );

		$settings['count']--;
		
		if(2 <$current){
			$links[] = ea_archive_navigation_link($v, 1,'page-item' );
			$links[] = '<li class="page-item">&hellip;</li>';
		}
		
		$links[] = ea_archive_navigation_link($v, $current - 1,'page-item' );
	}

	// Current
	$links[] = ea_archive_navigation_link($v, $current, 'page-item active' );

	// Next Pages
	for( $i = 1; $i < $settings['count']; $i++ ) {
		$page = $current + $i;
		if( $page <= $total ) {
			$links[] = ea_archive_navigation_link($v, $page , 'page-item' );
		}
	}

	// Next
	if( $current < $total ) {

		if( $current + 3 < $total ) {
			$links[] = '<li class="page-item">&hellip;</li>';
			$links[] = ea_archive_navigation_link($v, $total,'page-item' );
		}
		$next = ea_archive_navigation_link($v, $current + 1, 'pagination-next', $settings['next_text'] );
	}

	if($v==2 || $v==3){
		$classUL = 'pagination justify-content-center flex-grow-1 mb-0';
	}else{
		$classUL = 'pagination mb-0 p-0';
	}
		
		if($postsCnt > 6){
			echo "<div aria-label=\"Page navigation example\" class=\"page-jm-nav pl-half-container d-flex justify-content-center justify-content-sm-between align-items-center\">	
				".$prev."				
				<ul class='".$classUL."'>" . join( '', $links ) . "</ul>
				".$next."					
			</div>";
		}	
	
}

function ea_archive_navigation_link( $v="", $page = false, $class = '', $label = '' ) {

	if( ! $page )
		return;

	$label = $label ? $label : $page;

	if($v==2){
		$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REDIRECT_URL]?pg=".$page;
	}elseif($v==3){
		$linkV = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$linka = explode("&",$linkV);
		$link  = $linka[0]."&pg=".$page;
	}else{
		$link = esc_url_raw( get_pagenum_link( $page ) );
	}
	

	$output = '';
	if ( ! empty( $class ) ) {
		$output .= '<li class="' . esc_attr( $class ) . '">';
	} else {
		$output .= '<li>';
	}
	$output .= '<a href="' . $link . '" class="page-link">' . $label . '</a></li>';

	if($class == 'pagination-next' || $class=="pagination-previous"){
		$output = '<a class="page-link d-none d-sm-inline-block" href="' . $link . '">'.$label.'</a>';
	}

	return $output;
}