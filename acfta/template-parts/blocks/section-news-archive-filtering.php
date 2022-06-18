
<?php
$id = 'search-posts-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$classes = 'block-search-posts';
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

?>
<?php if ( get_field( 'enable_border_top' ) == 1 ) : ?>
    <hr class="hr mb-0">
<?php endif; ?>
<section id="<?php echo esc_attr( $id ); ?>" class="selects-section pb-5 <?php echo esc_attr( $classes ); ?>" data-form-filter="8">
    <div class="post-filter-view-grid">
        <div class="container">
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
        
        <div class="container list-main-container">
            <div class="posts-list alt no-gutters row pt-0" data-output="grid">
            <?php     
            if( $the_query->have_posts() ): ?>
                
                <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php
                    $published_date = get_the_date( 'j F, Y' );
                    $cat = get_the_category()[0];
                    ?>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 post d-flex <?php echo esc_attr($cat->slug); ?>">
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
        <hr class="hr m-0 d-none d-lg-block">
        
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
        <div class="container">
            <div class="mobile-space">
                <?php the_field( 'content' ); ?>
            </div>
        </div>
        <div class="page-content">
            <div class="post-type-section-list">
                <div class="container">
                    <div class="loader-area"></div>
                    <div class="row flex-lg-row-reverse">
                        <div class="col-xl-4 col-lg-5 col-12">
                            <div class="right-sidebar push-top">
                                <div class="placement-aside">
                                    <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="<?php echo $post_type; ?>" data-action="loadNews">
                                        <ul class="list-unstyled topics-search horizontal-search filter-research-dropdown">
                                            <li>
                                                <label class="d-block filter-research-dropdown">
                                                    <span class="label-text">Select News Category</span>
                                                    <select data-redirect="true" name="redirect">
                                                        <?php foreach($categories->terms as $term): ?>
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
                                            </li>                                            
                                            <li>
                                                <label class="d-block">
                                                    <span class="label-text">Search by title</span>
                                                    <span class="position-relative">
                                                        <input type="text" placeholder="Enter title" name="title" value="<?php echo $search_title;?>">
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
        </div>
    </div>
</section>