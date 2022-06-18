
<?php
$id = 'search-posts-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-news-archive-filter-with-sidebar';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$number_of_posts = get_field( 'number_of_posts' );
$post_type = 'cpt_news';
$category = get_field( 'select_news_category' );

$args = array (
    'post_type'     => $post_type,
    'numberposts'   => $number_of_posts,
    'oderby'        => 'published_date',
    'order'         => 'DESC',
    'posts_per_page'=> $number_of_posts,
    'tax_query'     => array(
        array(
            'taxonomy'  => 'category',
            'field'     => 'slug',
            'terms'     => $category->slug
        )
    )
);

$term_args = array(
    'post_type'              => $post_type,
    'taxonomy'               => 'category',
    'hide_empty'             => true,
);
$categories = new WP_Term_Query( $term_args );

$search_title="";
if(isset($_GET['title'])){
    $args['s'] = $_GET['title'];
    $search_title = $_GET['title'];
}

$news_categories = array();
$term_arr = array( 'Biographies', 'Media Releases', 'Stories', 'Speeches and Opinions' );
foreach( $categories->terms as $term ) {
    if( in_array( $term->name, $term_arr ) ) {
        $news_categories[] = $term;
    }
}

$the_query = new WP_Query($args);   
$totalpost = $the_query->found_posts;

$marginTop = "md";
$sideBarMargin = get_field( 'sidebar_margin' );
if($sideBarMargin =='normal'){
    $marginTop = '';
}elseif($sideBarMargin =='large'){
    $marginTop = 'lg';
}
elseif($sideBarMargin =='x-large'){
    $marginTop = 'lg2';
}
else{
    $marginTop = 'md';
}

$columns = get_field( 'grid_view_columns' );
if( $columns == 4 ) {
    $column_classes = 'col-12 col-md-6 col-lg-4 col-xl-3';
} elseif( $columns == 3 ) {
    $column_classes = 'col-12 col-md-6 col-xl-4';
} elseif( $columns == 2 ) {
    $column_classes = 'col-12 col-md-6';
}

?>

<section id="<?php echo esc_attr( $id ); ?>" class="peer-access-section filtering-with-sidebar <?php echo $classes; ?> pb-5" data-form-filter="8">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7 pt-5">
                <div class="post-filter-view-grid">
                    <div class="mobile-space">
                        <?php the_field( 'content' ); ?>
                        
                        <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="<?php echo $post_type; ?>" data-action="loadNews" class="filter-form pt-3 pt-md-5" data-columns="<?php echo $columns; ?>">
                            <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse"
                                data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                                Search <span class="icon-chevron-thin-down ml-auto"></span>
                            </a>
                            <div class="collapse" id="filterFields">
                                <div class="row pt-md-0 pt-3">
                                    <div class="col-lg">
                                        <label class="d-block filter-research-dropdown">
                                            <span class="label-text">Select News Category</span>
                                            <select data-redirect="true" name="redirect">
                                                <?php foreach($news_categories as $term): ?>
                                                <?php 
                                                    $selected = '';
                                                    $term_name = $term->slug;
                                                    if( $term_name == $category->slug ) {
                                                        $selected = 'selected';
                                                    }
                                                ?>
                                                <option value="<?php echo get_term_link($term);?>" <?php echo $selected; ?> ><?php echo $term->name;?></option>                            
                                                <?php endforeach;?>                           
                                            </select>
                                            <input type="hidden" name="category" value="<?php echo $category->term_id; ?>">
                                        </label>
                                    </div>
                                    <div class="col-lg">
                                        <label class="d-block">
                                            <span class="label-text">Search by title</span>
                                            <span class="position-relative">
                                                <input type="text" placeholder="Enter title" name="title" value="<?php echo $search_title;?>">
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

                    <hr class="hr mb-0">
                    
                    <div class="list-main-container">
                        <div class="posts-list alt no-gutters row pt-0" data-output="grid">
                        <?php     
                        if( $the_query->have_posts() ): ?>
                            
                            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                <?php
                                $published_date = get_the_date( 'j F, Y' );
                                $cat = get_the_category()[0];
                                ?>
                                <div class="<?php echo $column_classes; ?> post d-flex <?php echo esc_attr($cat->slug); ?>">
                                    <div class="d-flex flex-column w-100">
                                        <div class="flex-shrink-0">
                                            <?php $size='350x350';?>
                                            <a href="<?php echo get_permalink();?>">
                                                <?php if( has_post_thumbnail() ): ?>
                                                <?php  the_post_thumbnail($size, ['class' => 'post-img w-100']);  ?>
                                                <?php else: ?> 
                                                    <div class="default-grid-card--no-image p-4 d-flex align-items-center justify-content-center">
                                                        <div class="img-holder">
                                                            <?php echo wp_get_attachment_image( '979', 'full' ); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1 d-flex flex-column post-data">
                                            <h4><a href="<?php echo get_permalink();?>"><?php the_title(); ?></a></h4>
                                            <div class="post-meta"><?php echo $published_date; ?></div>
                                            <?php 
                                            $excerpt = get_the_excerpt();
                                            $excerpt = substr($excerpt, 0, 200);
                                            echo $excerpt; 
                                            ?> 
                                            <br/> <br/>                                                       
                                            <a href="<?php echo get_permalink();?>" class="more-link mt-auto">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?> 
                        </div>
                        <div class="loading-icon"></div>
                    </div>
                    
                    <div class="loading-pagination mt-4 px-3 text-center">
                        <div class="col">      
                            <div class="text-center">
                                <a class="next btn btn-black" <?php if( $totalpost <= $number_of_posts ){ echo 'style="display: none;"'; } ?>>Load more results</a>
                            </div>
                        </div>
                    </div>
                    <?php if( !$the_query->have_posts() ): ?>
                        <div class="no-entry"><strong>No Entry Found.</strong></div>
                    <?php endif; ?>    
                </div>
                <div class="post-filter-view-list d-none">
                    <div class="page-content">
                        <div class="post-type-section-list">
                            <div class="loader-area"></div>
                            <div class="mobile-space">
                                <?php the_field( 'content' ); ?>
                                
                                <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="<?php echo $post_type; ?>" data-action="loadNews" class="filter-form pt-3 pt-md-5">
                                    <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse"
                                        data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                                        Search <span class="icon-chevron-thin-down ml-auto"></span>
                                    </a>
                                    <div class="collapse" id="filterFields">
                                        <div class="row pt-md-0 pt-3">
                                            <div class="col-lg">
                                                <label class="d-block filter-research-dropdown">
                                                    <span class="label-text">Select News Category</span>
                                                    <select data-redirect="true" name="redirect">
                                                        <?php foreach($news_categories as $term): ?>
                                                        <?php 
                                                            $selected = '';
                                                            $term_name = $term->slug;
                                                            if( $term_name == $category->slug ) {
                                                                $selected = 'selected';
                                                            }
                                                        ?>
                                                        <option value="<?php echo get_term_link($term);?>" <?php echo $selected; ?> ><?php echo $term->name;?></option>                            
                                                        <?php endforeach;?>                           
                                                    </select>
                                                    <input type="hidden" name="category" value="<?php echo $category->term_id; ?>">
                                                </label>
                                            </div>
                                            <div class="col-lg">
                                                <label class="d-block">
                                                    <span class="label-text">Search by title</span>
                                                    <span class="position-relative">
                                                        <input type="text" placeholder="Enter title" name="title" value="<?php echo $search_title;?>">
                                                        <button class="search-input-btn search-input-btn-grid">
                                                            <span class="icon-search"></span>
                                                        </button>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="col-lg-auto">
                                                <span class="label-text mb-2 d-inline-block">View </span>
                                                <label class="d-flex align-items-center">
                                                    <span class="position-relative">
                                                        <div class="list-view icon-list-view"><span class="icon-list"></span></div>
                                                        <a href="javascript:void(0);"  class="list-view icon-grid-view" data-view="grid"><span class="icon-grid1"></span></a>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="post-type-results-info" style="display: none;"></div>
                                    </div>
                                </form>
                            </div>

                            <hr class="hr mb-0">
                            <div class="post-type-left list-main-container">                          
                                <div class="posts-list"  data-output="list">                     
                                <?php if( $the_query->have_posts() ): ?>           
                                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                    <?php
                                    $published_date = get_the_date( 'j F, Y' );
                                    $cat = get_the_category()[0];
                                    ?>
                                    <div class="post opportunity-item pt-0 pb-5 <?php echo esc_attr($cat->slug); ?>">
                                        <div class="row">
                                            <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
                                                <?php $size='350x350';?>
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
                                                <?php 
                                                $title =  get_the_title();
                                                $strlowerTitle = strtolower($title);
                                                ?>
                                                <h4><a href="<?php echo get_permalink();?>"><?php echo $title; ?></a></h4>
                                                    <div class="post-meta"><?php echo $published_date; ?></div>
                                                    <?php 
                                                        $excerpt = get_the_excerpt();
                                                        $excerpt = substr($excerpt, 0, 200);
                                                        echo $excerpt; 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile; ?>      
                                <?php endif; ?>                               
                                </div>  
                                <div class="loading-icon"></div>                             
                            </div>                           
                            <div class="loading-pagination mt-4 px-3 text-center">
                                <div class="col">      
                                    <div class="text-center">
                                        <a class="next btn btn-black" <?php if( $totalpost <= $number_of_posts ){ echo 'style="display: none;"'; } ?>>Load more results</a>
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
            <div class="col-xl-4 col-lg-4">
            <?php if ( have_rows( 'sidebar_blocks' ) ): ?>
                <div class="right-sidebar push-top-<?php echo $marginTop;?>">
                <?php while ( have_rows( 'sidebar_blocks' ) ) : the_row(); ?>
                    <?php if ( get_row_layout() == 'content' ) : ?>
                        <div class="placement-aside mt-4 page-content-area">
                            <div class="sidebar-block--content pb-4">
                                <div class="content-list-squared">
                                    <?php the_sub_field( 'content' ); ?>
                                </div>
                            <?php if ( have_rows( 'buttons' ) ) : ?>
                                <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                                    <?php $button = get_sub_field( 'button' ); ?>
                                    <?php if ( $button ) : ?>
                                        <a class="text-20 mb-4 btn btn--dark col" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            </div>
                            <?php $note = get_sub_field( 'info_note' ); ?>
                            <?php if ( $note ) : ?>
                                <?php if ( get_sub_field( 'show_note_icon_!' ) == 1 ) : ?>
                                    <div class="closed-data mb-4">
                                        <?php the_sub_field( 'info_note' ); ?>
                                        </div>
                                <?php else : ?>
                                    <div class="placement-aside-footer">
                                        <div class="bg-dark">
                                            <?php the_sub_field( 'info_note' ); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>                                       
                            <?php endif; ?>
                        </div>
                    <?php elseif ( get_row_layout() == 'recent_post' ) : ?>
                        <?php $recent = get_sub_field( 'recent' ); ?>
                        <?php if ( $recent ) : ?>
                            <div class="placement-aside sidebar-simple-text mt-lg-4 recent-speeches-post-list">
                                <h3><?php the_sub_field( 'heading' ); ?></h3>
                                <ul class="list-unstyled sidebar-list text-18">
                                    <?php foreach ( $recent as $post_ids ) : ?>
                                        <li class="newsBox">
                                            <a href="<?php echo get_permalink( $post_ids ); ?>">
                                                <h6><?php echo get_the_date( 'd M, Y' );?></h6>
                                                <h4> <?php echo get_the_title( $post_ids ); ?></h4>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    <li class="button-container">
                                    <a href="#" id="loadNews" class="btn w-100 btn--dark btn-block d-flex justify-content-between align-items-center">
                                        <span>Load More</span>
                                        <span class="icon-plus-light"></span>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'social_media_info' ) : ?>
                        <div class="placement-aside sidebar-simple-text mt-lg-4">
                        <h3><?php the_sub_field( 'title' ); ?></h3>
                            <?php if ( have_rows( 'social_media' ) ) : ?>
                                    <ul class="list-unstyled sidebar-list">
                                    <?php while ( have_rows( 'social_media' ) ) : the_row(); ?>
                                            <li>
                                            <a href="<?php the_sub_field( 'link' ); ?>" class="fa fa-<?php the_sub_field( 'icon' ); ?>"></a><a href="<?php the_sub_field( 'link' ); ?>"> <?php the_sub_field( 'icon_text' ); ?></a>
                                            </li>
                                    <?php endwhile; ?>
                                    </ul>
                            <?php endif; ?>
                        </div>
                    <?php elseif ( get_row_layout() == 'event_details' ) : ?>
                        <div class="placement-aside sidebar-simple-text mt-lg-4">
                            <h3><?php the_sub_field( 'heading' ); ?></h3>
                            <div class="placement-news border-top-0">
                                <h6><small class="mb-1">Date</small></h6>
                                <?php the_sub_field( 'event_date' ); ?>
                            </div>
                            <div class="placement-news border-bottom-0">
                                <h6><small class="mb-1">Location</small></h6>
                                <?php the_sub_field( 'event_location' ); ?>
                            </div>
                            <div class="placement-aside-footer ">
                                <div class="bg-dark note-box">
                                    <span class="icon-exclamation-solid"></span>
                                    <?php the_sub_field( 'event_info_note' ); ?>
                                </div>
                            </div>
                        </div>
                    <?php elseif ( get_row_layout() == 'navigation_menu' ) : ?>
                        <div class="placement-aside mt-4 page-content-area mb-4">
                            <div class="block--nav-menu">
                                <?php $menuID = get_sub_field( 'menu' ); ?>
                            
                                <h3><?php the_sub_field( 'title' ); ?></h3>
                                <?php wp_nav_menu(  $args = array(
                                            'menu'              => $menuID, // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
                                            'menu_class'        => "list-unstyled sidebar-list"
                                        ) );
                                ?>
                            </div>
                        </div>
                    <?php elseif ( get_row_layout() == 'navigation_link' ) : ?>
                        <div class="placement-aside mt-4 page-content-area mb-4">
                            <h3><?php the_sub_field( 'title' ); ?></h3>
                            <?php if ( have_rows( 'add_link' ) ) : ?>
                                <ul class="list-unstyled sidebar-list text-20">
                                    <?php while ( have_rows( 'add_link' ) ) : the_row(); ?>
                                        <?php $menu_link = get_sub_field( 'menu_link' ); ?>
                                        <?php if ( $menu_link ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $menu_link['url'] ); ?>" target="<?php echo esc_attr( $menu_link['target'] ); ?>"><?php echo esc_html( $menu_link['title'] ); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>    
                        </div>
                    <?php elseif ( get_row_layout() == 'application_information' ) : ?>
                        <?php 
                            $taginfo = wp_get_post_terms($post->ID,'funding_type', array( 'fields' => 'names'));
                            
                            foreach($taginfo as $value){
                                $tagname =  $value;
                            }
                        ?>
                        <div class="placement-aside mt-4 page-content-area">
                            <?php if ( get_sub_field( 'show_tag_info' ) == 1 ) : 
                                if($tagname):
                            ?>
                                    <a href="<?php echo get_home_url()."/investment-and-development/?funding_type=$value"; ?>" class="btn btn-black btn-sm mb-4"><?php echo $value;?></a>
                                <?php endif; ?>
                            <?php else : ?><?php endif; ?>
                            <?php the_sub_field( 'content_details' ); ?>
                            <br>
                            <?php if ( have_rows( 'buttons' ) ) : ?>
                                <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                                    <?php $button = get_sub_field( 'button' ); ?>
                                    <?php if ( $button ) : ?>
                                        <a href="<?php echo esc_url( $button['url'] ); ?>" class="text-20 mb-4 btn btn--dark col" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if ( get_sub_field( 'has_info_note' ) == 1 ) : ?>
                                <?php if ( get_sub_field( 'show_info_note_icon__!_' ) == 1 ) : ?>
                                        <div class="closed-data mb-4">
                                                <?php the_sub_field( 'info_note' ); ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="placement-aside-footer">
                                                <div class="bg-dark">
                                                    <?php the_sub_field( 'info_note' ); ?>
                                                </div>
                                        </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php elseif ( get_row_layout() == 'post_list_with_image' ) : ?>
                        <div class="placement-aside mt-4 page-content-area">
                            <h3><?php the_sub_field( 'heading_title' ); ?></h3>

                            <?php $select_post = get_sub_field( 'select_post' ); ?>
                            <?php if ( $select_post ) : ?>
                                <ul class="list-unstyled sidebar-list">
                                <?php foreach ( $select_post as $post_ids ) : ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <a href="<?php echo get_permalink( $post_ids ); ?>" class="post-podcast-img">
                                                    <?php $size="full"?>
                                                    <?php the_post_thumbnail($post_ids, $size);  ?>
                                                </a>
                                            </div>
                                            <div class="col-sm-7">
                                                <a href="<?php echo get_permalink( $post_ids ); ?>">
                                                    <?php echo get_the_title( $post_ids ); ?>
                                                </a>
                                            </div>
                                        </div>
                                        </li>
                                <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php elseif ( get_row_layout() == 'transcript_toggle' ) : ?>
                        <div class="mt-4 page-content-area col-xl transcript-area">
                            <button class="btn btn--dark transcript-btn col" type="button" data-toggle="collapse" data-target="#collapsePodcast" aria-expanded="false" aria-controls="collapseExample">
                                <?php the_sub_field( 'heading_title' ); ?>
                            </button>
                            <div class="collapse" id="collapsePodcast">
                                <div class="card card-body">
                                <?php the_sub_field( 'content' ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?><!--/endif--->
                <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>