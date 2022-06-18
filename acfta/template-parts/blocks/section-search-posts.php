<?php
$id = 'search-posts-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-search-posts';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$pageSet = 8;
$post_type = 'investment';

$args = array (
    'post_type'     => $post_type,
    'posts_per_page'   => -1,
    'meta_key'      => 'closing_date',
    'orderby'       => 'meta_value',
    'order'         => 'ASC',
    'meta_query'    => array(
        'relation'  => 'AND',
        array(
            'relation'  => 'OR',
            array(
                'key'       => 'exclude_in_archive',
                'compare'   => '!=',
                'value'     => 1,
            ),
            array(
                'key'       => 'exclude_in_archive',
                'compare'   => 'NOT EXISTS',
            )
        ),
        array(
            'relation'  => 'OR',
            array(
                'key'       => 'closing_date',
                'compare'   => '>=',
                'value'     => date('Y-m-d'),            
                'type'      => 'DATE'
            ),
            array(
                'key'       => 'closing_date',
                'compare'   => '<',
                'value'     => date('Y-m-d'),            
                'type'      => 'DATE'
            ),
        ),
    ),
);

$term_args = array(
    'post_type'              => 'investment',
    'taxonomy'               => 'application_type',
    'hide_empty'             => false
);
$typeApp = new WP_Term_Query( $term_args );

$term_args2 = array(
    'post_type'              => 'investment',
    'taxonomy'               => 'funding_type',
    'hide_empty'             => false
);
$typeFun = new WP_Term_Query( $term_args2 );

$term_args3 = array(
    'post_type'              => 'investment',
    'taxonomy'               => 'artform',
    'hide_empty'             => false
);
$typeArt = new WP_Term_Query( $term_args3 );

$application_type = array();
$funding_type = array();
$artform = array();

$filter_by = get_field( 'filter_by' ); 

if( $filter_by ) {

    foreach( $filter_by as $term ) {
        $term = get_term( $term, 'funding_type' );
        $args['tax_query'][] = array(
            'taxonomy' => 'funding_type',
            'field' => 'name',
            'terms' => $term->name
        );

        $funding_type[] = $term->name;
    }
}

if(isset($_GET['application_type'])){
    $application_type = $_GET['application_type'];

    if( !is_array( $_GET['application_type'] ) ) {
        $application_type = explode(',', $_GET['application_type']);
    }

    $args['tax_query'][] = array(
        'taxonomy' => 'application_type',
        'field' => 'name',
        'terms' => $application_type
    );
}
if(isset($_GET['funding_type'])){
    $funding_type = $_GET['funding_type'];

    if( !is_array( $_GET['funding_type'] ) ) {
        $funding_type = explode(',', $_GET['funding_type']);
    }

    $args['tax_query'][] = array(
        'taxonomy' => 'funding_type',
        'field' => 'name',
        'terms' => $funding_type
    );
}
if(isset($_GET['artform'])){
    $artform = $_GET['artform'];

    if( !is_array( $_GET['artform'] ) ) {
        $artform = explode(',', $_GET['artform']);
    }

    $artform[] = 'Multi-art form';

    $args['tax_query'][] = array(
        'taxonomy' => 'artform',
        'field' => 'name',
        'terms' => $artform
    );
}
if(isset($args['tax_query'])){
    if( is_array( $args['tax_query'] ) ) {
        if( count($args['tax_query']) > 1){
            $args['tax_query']['relation'] = 'AND';
        }
    }
}


$search_text = "";
if( isset($_GET['title']) ){
    $args['s'] = $_GET['title'];
    $search_text = $_GET['title'];
}

$the_query = new WP_Query( $args ); 

$totalpost = $the_query->found_posts;

?>
<?php if ( get_field( 'enable_border_top' ) == 1 ) : ?>
    <hr class="hr mb-0">
<?php endif; ?>
<div id="anchor-investment-filter-results"></div>
<section id="<?php echo esc_attr( $id ); ?>" class="selects-section pb-5 <?php echo $classes; ?>" data-form-filter="8">
    <div class="post-filter-view-grid">
        <div class="container">
            <div class="mobile-space">
                <?php the_field( 'content' ); ?>
                
                <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="<?php echo $post_type; ?>" data-action="loadPage" data-urlfilter="<?php the_field('enable_url_filtering'); ?>" class="filter-form pt-3 pt-md-5">
                    <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse"
                        data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                        Search <span class="icon-chevron-thin-down ml-auto"></span>
                    </a>
                    <div class="collapse" id="filterFields">
                        <div class="row pt-md-0 pt-3">
                            <div class="col-lg">
                                <label class="d-block filter-research-dropdown max-width-4">
                                    <span class="label-text">Filter by Application type</span>
                                    <select name="application_type[]" multiple>
                                        <?php foreach($typeApp->terms as $rsA): ?>
                                        <?php 
                                            $selected = '';
                                            $term_name = strtolower($rsA->name);
                                            $application_type = array_map( 'strtolower', $application_type );
                                            if( in_array( $term_name, $application_type ) ) {
                                                $selected = 'selected';
                                            }
                                        ?>
                                        <option value="<?php echo $rsA->term_id;?>" <?php echo $selected; ?> ><?php echo $rsA->name;?></option>                            
                                        <?php endforeach;?>                           
                                    </select>
                                </label>
                            </div>
                            <div class="col-lg">
                                <label class="d-block filter-research-dropdown max-width-4">
                                    <span class="label-text">Filter by Funding Type</span>
                                    <select name="funding_type[]" multiple>
                                        <?php foreach($typeFun->terms as $rsF): ?>
                                        <?php 
                                            $selected = '';
                                            $term_name = strtolower($rsF->name);
                                            $funding_type = array_map( 'strtolower', $funding_type );
                                            if( in_array( $term_name, $funding_type ) ) {
                                                $selected = 'selected';
                                            }
                                        ?>
                                        <option value="<?php echo $rsF->term_id;?>" <?php echo $selected; ?> ><?php echo $rsF->name;?></option>                            
                                        <?php endforeach;?> 
                                    </select>
                                </label>
                            </div>
                            <div class="col-lg">
                                <label class="d-block filter-research-dropdown max-width-4">
                                    <span class="label-text">Filter by artform</span>
                                    <select name="artform[]" data-autoselect="21" data-select="" multiple>
                                        <?php foreach($typeArt->terms as $rsArt): ?>
                                        <?php 
                                            $selected = '';
                                            $term_name = strtolower($rsArt->name);
                                            $artform = array_map( 'strtolower', $artform );
                                            if( in_array( $term_name, $artform ) ) {
                                                $selected = 'selected';
                                            }
                                        ?>
                                        <option value="<?php echo $rsArt->term_id;?>" <?php echo $selected; ?> ><?php echo $rsArt->name;?></option>                            
                                        <?php endforeach;?> 
                                    </select>
                                </label>
                            </div>
                            <div class="col-lg">
                                <label class="d-block">
                                    <span class="label-text">Search by title</span>
                                    <span class="position-relative">
                                        <input type="text" placeholder="Enter title" name="title" value="<?php echo $search_text;?>">
                                        <button class="search-input-btn search-input-btn-grid">
                                            <span class="icon-search"></span>
                                        </button>
                                    </span>
                                </label>
                            </div>

                            <div class="col-lg-auto">
                                <label class="d-none d-lg-block">
                                    <span class="label-text">View </span>
                                    <span class="position-relative">
                                        <a href="javascript:void(0);" class="list-view icon-list-view" data-view="list"><span class="icon-list"></span></a>
                                        <div class="list-view icon-grid-view"><span class="icon-grid1"></span></div>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="post-type-results-info" style="display: none;"></div>
                    </div>
                </form>
            </div>
        </div>

        <hr class="hr mb-0">
        
        <div class="container open-closed-list list-main-container">
            <div class="row no-gutters" data-output="grid">
            <?php     
            if( $the_query->have_posts() ): ?>
                <?php 
                    $html_open = array();
                    $html_closed = array();
                    $html_opening = array();
                    $html_closing = array();

                    $html_openL = array();
                    $html_closedL = array();
                    $html_openingL = array();
                    $html_closingL = array();
                ?>
                <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php
                    $post_id = get_the_ID();
                    $opening = strtotime( get_field( 'opening_date', $post_id ) ); 
                    $closing = strtotime( get_field( 'closing_date', $post_id ) );
                    $closing_date = get_field( 'closing_date', $post_id );

                    if( !$opening ) {
                        $opening = strtotime( "-1 month" );
                    }
                    if( !$closing ) {
                        $closing = strtotime( "-1 month" );
                    }

                    $dt = new DateTime("now", new DateTimeZone('Australia/Sydney'));
                    $str_dt = $dt->format('Y-m-d H:i:s');

                    $today = strtotime($str_dt);
                    $nextDate = strtotime( '+2 weeks' );
                    
                    if( $opening > $today ) {
                        $status = 'Opening soon';
                        $status_class = 'open-soon-style';
                    } else if( $today >= $opening && $today <= $closing && $nextDate >= $closing ) {
                        $status = 'Closing soon';
                        $status_class = 'close-soon-style';
                    } else if( $closing < $today ) {
                        $status = 'Closed';
                        $status_class = 'closed-style btn-black';
                    } else {
                        $status = 'Open';
                        $status_class = 'open-style';
                    }
                    ?>
                    
                    <?php ob_start(); ?>
                    <?php 
                        $timezoneSelected = get_field( 'select_time_zone', $post_id);
                        if(empty($timezoneSelected)){
                            $timezoneSelected = "AEST";
                        }
                    ?>
                    <div class="col col-lg-3 col-md-6 col-12 d-flex">
                        <div class="opportunity-item d-flex flex-column" >
                            <span class="<?php echo $status_class ?> align-self-start"><?php echo $status; ?></span>
                            <h3 class="h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php if( $status=='Open' || $status=='Closing soon'):?>
                                <div class="closing-text">
                                <strong>Closing Date:</strong><p><?php echo $closing_date; ?> (<?php echo $timezoneSelected ;?>)</p>
                                </div>
                            <?php endif;?>
                            <div class="opportunity-item-body flex-grow-1">
                                <?php 
                                    $postid = get_the_ID();
                                    $price =  get_field( 'price_range',  $postid );
                                ?>
                                <p class="font-weight-medium"><?php echo $price; ?></p>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="text-underline">View opportunity</a>
                        </div>
                    </div>
                    <?php if( $status == 'Open' ): ?>
                        <?php $html_open[] = ob_get_clean(); ?>
                    <?php elseif( $status == 'Closed' ): ?>
                        <?php $html_closed[] = ob_get_clean(); ?>
                    <?php elseif( $status == 'Closing soon' ): ?>
                        <?php $html_closing[] = ob_get_clean(); ?>
                    <?php elseif( $status == 'Opening soon' ): ?>
                        <?php $html_opening[] = ob_get_clean(); ?>
                    <?php endif; ?>

                    <?php ob_start(); ?>
                    <div class="post opportunity-item pt-0 pb-5">
                        <div class="row">
                            <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
                                <?php $size='365x200';?>
                                <a href="<?php echo get_permalink();?>">
                                    <?php if( has_post_thumbnail() ): ?>
                                    <?php the_post_thumbnail($size,['class' => 'post-img w-100']);  ?>
                                    <?php else: ?> 
                                        <div class="default-horizontal-card--no-image p-4 d-flex align-items-center justify-content-center">
                                            <div class="img-holder">
                                                <?php echo wp_get_attachment_image( '979', 'full' ); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="col">
                                <div class="mobile-space">
                                    <span class="<?php echo $status_class ?> d-inline-block"><?php echo $status; ?></span>
                                    <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                                    <p class="font-weight-medium"><?php echo $price; ?></p>
                                    <?php 
                                        $excerpt = get_the_excerpt();
                                        echo $excerpt; 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if( $status == 'Open' ): ?>
                        <?php $html_openL[] = ob_get_clean(); ?>
                    <?php elseif( $status == 'Closed' ): ?>
                        <?php $html_closedL[] = ob_get_clean(); ?>
                    <?php elseif( $status == 'Closing soon' ): ?>
                        <?php $html_closingL[] = ob_get_clean(); ?>
                    <?php elseif( $status == 'Opening soon' ): ?>
                        <?php $html_openingL[] = ob_get_clean(); ?>
                    <?php endif; ?>
                <?php endwhile; ?>
                <?php $html_closed = array_reverse( $html_closed ); ?>
                <?php $html_closedL = array_reverse( $html_closedL ); ?>
                <?php $html = array_merge($html_closing, $html_open, $html_opening, $html_closed ); ?>
                <?php $html_list = array_merge($html_closingL, $html_openL, $html_openingL, $html_closedL ); ?>
                <?php foreach( array_slice($html, 0, 8) as $item ): ?>
                    <?php echo $item; ?>
                <?php endforeach; ?>
            <?php endif; ?> 
            </div>
            <div class="loading-icon"></div>
        </div>
        <hr class="hr m-0 d-none d-lg-block">
        
        <div class="loading-pagination mt-4 px-3 text-center">
            <div class="col">      
                <div class="text-center">
                    <a class="next btn btn-black" <?php if( $totalpost <= 8 ){ echo 'style="display: none;"'; } ?>>Load more results</a>
                </div>
            </div>
        </div>
        <?php if( !$the_query->have_posts() ): ?>
            <div class="no-entry"><strong>No Entry Found.</strong></div>
        <?php endif; ?>    
    </div>
    <div class="post-filter-view-list d-none">
        <div class="container">
            <div class="mobile-space">
                <h2><?php the_field( 'heading' ); ?></h2>
                <p class="lead"><?php the_field( 'text' ); ?></p>
            </div>
        </div>
        <div class="page-content">
            <div class="post-type-section-list">
                <div class="container">
                    <div class="loader-area"></div>
                    <div class="row flex-lg-row-reverse">
                        <div class="col-xl-4 col-lg-5 col-12">
                            <div class="right-sidebar push-top">
                                <div class="placement-aside placement-aside-lg">
                                    <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-urlfilter="<?php the_field('enable_url_filtering'); ?>" data-cpt="<?php echo $post_type; ?>" data-action="loadPage">
                                        <ul class="list-unstyled topics-search horizontal-search filter-research-dropdown">
                                            <li>
                                                <label class="d-block filter-research-dropdown">
                                                    <span class="label-text">Filter by Application type</span>
                                                    <select name="application_type[]" multiple>
                                                        <?php foreach($typeApp->terms as $rsA): ?>
                                                        <?php 
                                                            $selected = '';
                                                            $term_name = strtolower($rsA->name);
                                                            $application_type = array_map( 'strtolower', $application_type );
                                                            if( in_array( $term_name, $application_type ) ) {
                                                                $selected = 'selected';
                                                            }
                                                        ?>
                                                        <option value="<?php echo $rsA->term_id;?>" <?php echo $selected; ?> ><?php echo $rsA->name;?></option>                            
                                                        <?php endforeach;?>                           
                                                    </select>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block filter-research-dropdown">
                                                    <span class="label-text">Filter by Funding Type</span>
                                                    <select name="funding_type[]" multiple>
                                                        <?php foreach($typeFun->terms as $rsF): ?>
                                                        <?php 
                                                            $selected = '';
                                                            $term_name = strtolower($rsF->name);
                                                            $funding_type = array_map( 'strtolower', $funding_type );
                                                            if( in_array( $term_name, $funding_type ) ) {
                                                                $selected = 'selected';
                                                            }
                                                        ?>
                                                        <option value="<?php echo $rsF->term_id;?>" <?php echo $selected; ?> ><?php echo $rsF->name;?></option>                            
                                                        <?php endforeach;?> 
                                                    </select>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block filter-research-dropdown">
                                                    <span class="label-text">Filter by artform</span>
                                                    <select name="artform[]" multiple>
                                                        <?php foreach($typeArt->terms as $rsArt): ?>
                                                        <?php 
                                                            $selected = '';
                                                            $term_name = strtolower($rsArt->name);
                                                            $artform = array_map( 'strtolower', $artform );
                                                            if( in_array( $term_name, $artform ) ) {
                                                                $selected = 'selected';
                                                            }
                                                        ?>
                                                        <option value="<?php echo $rsArt->term_id;?>" <?php echo $selected; ?> ><?php echo $rsArt->name;?></option>                            
                                                        <?php endforeach;?> 
                                                    </select>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block search-mobile-space">
                                                    <span class="label-text">Search by title</span>
                                                    <span class="position-relative">
                                                        <input type="text" placeholder="Enter title" name="title" value="<?php echo $search_text;?>">
                                                        <button class="search-input-btn search-input-btn-list btn btn-black btn-block">
                                                            Search
                                                        </button>
                                                    </span>
                                                </label>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                                <div class="view-widget d-none d-lg-block">
                                    <span class="label-text mb-2 d-inline-block">View </span>
                                    <label class="d-flex align-items-center">
                                        <span class="position-relative">
                                            <div class="list-view icon-list-view"><span class="icon-list"></span></div>
                                            <a href="javascript:void(0);"  class="list-view icon-grid-view" data-view="grid"><span class="icon-grid1"></span></a>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-12">                            
                            <div class="post-type-left list-main-container">
                                <div class="post-type-results-info" style="display: none;"></div>                                
                                <div class="posts-list"  data-output="list">                     
                                    <?php foreach( array_slice($html_list, 0, 8) as $list ): ?>
                                        <?php echo $list; ?>
                                    <?php endforeach; ?>
                                </div>  
                                <div class="loading-icon"></div>                             
                            </div>                           
                            <div class="loading-pagination mt-4 px-3 text-center">
                                <div class="col">      
                                    <div class="text-center">
                                        <a class="next btn btn-black" <?php if( $totalpost <= 8 ){ echo 'style="display: none;"'; } ?>>Load more results</a>
                                    </div>
                                </div>
                            </div> 
                            <?php if( !$the_query->have_posts() ): ?> 
                                <div class="no-entry"><strong>No Entry Found.</strong></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>