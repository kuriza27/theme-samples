
<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-search-post-with-card.php
 *
 * Search Posts Cards Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'search-posts-cards-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-search-posts-cards';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$id = 'search-posts-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$num_posts = get_field( 'num_posts' );
$post_type = 'research';

$term_topic = array(
    'post_type'              => $post_type,
    'taxonomy'               => 'topic',
    'hide_empty'             => false
);
$tax_topic = new WP_Term_Query( $term_topic );

$term_artform = array(
    'post_type'              => $post_type,
    'taxonomy'               => 'art_form',
    'hide_empty'             => false
);
$tax_artform = new WP_Term_Query( $term_artform );

$args = array (
    'post_type'      => $post_type,
    'post_status'    => 'publish',
    'orderby'        => 'publish_date',
    'order'          => 'DESC',
    'posts_per_page' => $num_posts,
    'post_parent'    => 0,
    'meta_query'     => array(
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
    )
);

$topic = array();
$artform = array();

$filter_by_topic = get_field( 'filter_by_topic' );
$filter_by_artform = get_field( 'filter_by_artform' );

if( $filter_by_topic ) {

    foreach( $filter_by_topic as $term ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'topic',
            'field' => 'name',
            'terms' => $term->name
        );

        $topic[] = $term->name;
    }
}

if( $filter_by_artform ) {

    foreach( $filter_by_artform as $term ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'art_form',
            'field' => 'name',
            'terms' => $term->name
        );

        $artform[] = $term->name;
    }
}

if( isset($_GET['topic'])){
    $topic = explode(',', $_GET['topic']);

    $args['tax_query'][] = array(
        'taxonomy' => 'topic',
        'field' => 'name',
        'terms' => $topic
    );
}

if( isset($_GET['artform'])){
    $artform = explode(',', $_GET['artform']);

    $args['tax_query'][] = array(
        'taxonomy' => 'art_form',
        'field' => 'name',
        'terms' => $artform
    );
}

if( isset($_GET['art_form']) ){
    $artform = explode(',', $_GET['art_form']);

    $args['tax_query'][] = array(
        'taxonomy' => 'art_form',
        'field' => 'name',
        'terms' => $artform
    );

    $args2 = $args;

    $args2['tax_query'][] = array(
        'taxonomy' => 'art_form',
        'field' => 'slug',
        'operator' => 'NOT IN',
        'terms' => array('all-artforms-multi-artform')
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
if( isset($_GET['title'])){
    $args['s'] = $_GET['title'];
    $search_text = $_GET['title'];
}

$view = get_field( 'default_view' );

if(isset($args2)) {
    $first_args = $args2;
    $first_args['fields'] = 'ids';
    $first_args['posts_per_page'] = -1;
    $first_ids = get_posts( $first_args );

    $next_args = $args;
    $next_args['fields'] = 'ids';
    $next_args['post__not_in'] = $first_ids;
    $next_args['posts_per_page'] = -1;
    $next_ids = get_posts( $next_args );

    $post_ids = array_merge( $first_ids, $next_ids );
    $args['post__in'] = $post_ids;
    $args['orderby'] = 'post__in';
}

$the_query = new WP_Query( $args );   
$totalpost = $the_query->found_posts;   
?>

<?php if ( get_field( 'enable_border_top' ) == 1 ) : ?>
    <hr class="hr mb-0">
<?php endif; ?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> selects-section mobile-space" data-form-filter="<?php echo $num_posts; ?>">
    <div class="post-filter-view-grid <?php if( $view == 'horizontal' ){ echo 'd-none'; } ?>">
        <div class="container">      
            <?php if ( get_field( 'enable_content_center' ) == 1 ) : ?>
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <?php the_field( 'content' ); ?>
                </div>
            </div>
            <?php else : ?>
            <div class="row">
                <div class="col-12">
                    <?php the_field( 'content' ); ?>
                </div>
            </div>
            <?php endif; ?>
            <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="<?php echo $post_type; ?>" data-action="loadNewResearch" data-urlfilter="<?php the_field('url_filtering'); ?>" class="filter-form pt-3 pt-md-5">
                <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse"
                    data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                    Search <span class="icon-chevron-thin-down ml-auto"></span>
                </a>
                <div class="collapse" id="filterFields">
                    <div class="row pt-md-0 pt-3">
                        <div class="col-lg max-width-3">
                            <label class="d-block filter-research-dropdown">
                                <span class="label-text">Filter by Topic</span>
                                <select name="topic[]" multiple>
                                    <?php foreach($tax_topic->terms as $term): ?>
                                    <?php 
                                        $selected = '';
                                        $term_name = strtolower($term->name);
                                        $topic = array_map( 'strtolower', $topic );
                                        if( in_array( $term_name, $topic ) ) {
                                            $selected = 'selected';
                                        }
                                    ?>
                                    <option value="<?php echo $term->term_id;?>" <?php echo $selected; ?> ><?php echo $term->name;?></option>                            
                                    <?php endforeach;?>                           
                                </select>
                            </label>
                        </div>
                        <div class="col-lg max-width-3">
                            <label class="d-block filter-research-dropdown">
                                <span class="label-text">Filter by Artform</span>
                                <select name="art_form[]" multiple>
                                    <?php foreach($tax_artform->terms as $term): ?>
                                    <?php 
                                        $selected = '';
                                        $term_name = strtolower($term->name);
                                        $artform = array_map( 'strtolower', $artform );
                                        if( in_array( $term_name, $artform ) ) {
                                            $selected = 'selected';
                                        }
                                    ?>
                                    <option value="<?php echo $term->term_id;?>" <?php echo $selected; ?> ><?php echo $term->name;?></option>                            
                                    <?php endforeach;?>                           
                                </select>
                            </label>
                        </div>
                        <div class="col-lg max-width-3">
                            <label class="d-block">
                                <span class="label-text">Search by title</span>
                                <span class="position-relative">
                                    <input type="text" placeholder="Enter title" name="title" value="<?php echo $search_text; ?>">
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
        
        <div class="highlights-section low-caps">
            <div class="container-fluid list-main-container">
                <div class="row gutter-22" data-output="grid">
                <?php if( $the_query->have_posts() ): ?>
                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php 
                    $post_id = get_the_ID();
                    $term_names = wp_get_post_terms($post_id, 'topic', array('fields' => 'names'));
                    $post_date = get_the_date( 'j F, Y' );
                    ?>
                    <div class="col-lg-4 col-sm-6 col-12 mb-2 mb-sm-3 mb-lg-0">
                        <a href="<?php echo get_permalink(); ?>" class="highlight-box d-flex">
                            <?php the_post_thumbnail('732x650', array('class' => 'w732xh650')); ?>
                            <div class="box-bottom">
                                <?php foreach( $term_names as $name ): ?>
                                <span class="advocacy-tag mr-2"><?php echo $name;?></span>
                                <?php endforeach; ?>
                                <h3><?php the_title(); ?></h3>
                                <span class="box-date">Publication date: <?php echo $post_date;?></span>
                            </div>
                        </a>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                </div>                
                <div class="loading-icon"></div>
            </div>                
            <div class="loading-pagination mt-4 px-3 text-center">
                <div class="col">      
                    <div class="text-center">
                        <a class="next btn btn-black" <?php if( $totalpost <= $num_posts ){ echo 'style="display: none;"'; } ?>>Load more results</a>
                    </div>
                </div>
            </div>
            <?php if( !$the_query->have_posts() ): ?>
                <div class="no-entry"><strong>No Entry Found.</strong></div>
            <?php endif; ?> 
        </div>          
    </div>
    <div class="post-filter-view-list <?php if( $view != 'horizontal' ){ echo 'd-none'; } ?>">
        <div class="container">
            <div class="mobile-space">
                <div class="col-xl-8 col-lg-7 col-12 text-left">
                    <?php the_field( 'content' ); ?>
                </div>
            </div>
        </div>
        <div class="page-content">
            <section class="post-type-section-list">
                <div class="container">
                    <div class="loader-area"></div>
                    <div class="row flex-lg-row-reverse">
                        <div class="col-xl-4 col-lg-5 col-12">
                            <div class="right-sidebar push-top">
                                <div class="placement-aside placement-aside-lg">
                                    <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="<?php echo $post_type; ?>" data-action="loadNewResearch" data-urlfilter="<?php the_field('url_filtering'); ?>">
                                        <ul class="list-unstyled topics-search horizontal-search filter-research-dropdown">
                                            <li>
                                                <label class="d-block filter-research-dropdown">
                                                    <span class="label-text">Filter by Topic</span>
                                                    <select name="topic[]" multiple>
                                                        <?php foreach($tax_topic->terms as $term): ?>
                                                        <?php 
                                                            $selected = '';
                                                            $term_name = strtolower($term->name);
                                                            $topic = array_map( 'strtolower', $topic );
                                                            if( in_array( $term_name, $topic ) ) {
                                                                $selected = 'selected';
                                                            }
                                                        ?>
                                                        <option value="<?php echo $term->term_id;?>" <?php echo $selected; ?> ><?php echo $term->name;?></option>                            
                                                        <?php endforeach;?>                           
                                                    </select>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block filter-research-dropdown">
                                                    <span class="label-text">Filter by Artform</span>
                                                    <select name="art_form[]" multiple>
                                                        <?php foreach($tax_artform->terms as $term): ?>
                                                        <?php 
                                                            $selected = '';
                                                            $term_name = strtolower($term->name);
                                                            $artform = array_map( 'strtolower', $artform );
                                                            if( in_array( $term_name, $artform ) ) {
                                                                $selected = 'selected';
                                                            }
                                                        ?>
                                                        <option value="<?php echo $term->term_id;?>" <?php echo $selected; ?> ><?php echo $term->name;?></option>                            
                                                        <?php endforeach;?>                           
                                                    </select>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block search-mobile-space">
                                                    <span class="label-text">Search by title</span>
                                                    <span class="position-relative">
                                                        <input type="text" placeholder="Enter title" name="title" value="<?php echo $search_text; ?>">
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
                                    $post_id = get_the_ID();
                                    $term_names = wp_get_post_terms($post_id, 'topic', array('fields' => 'names'));
                                    $post_date = get_the_date( 'j F, Y' );
                                    ?>
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
                                                    <?php foreach( $term_names as $name ): ?>
                                                    <span class="open-style d-inline-block mr-2"><?php echo $name; ?></span>
                                                    <?php endforeach; ?>
                                                    <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                                                    <strong>Publication date: <?php echo $post_date;?></strong>
                                                    <br>
                                                    <?php 
                                                        $excerpt = get_the_excerpt();
                                                       // $excerpt = substr($excerpt, 0, 200);
                                                       // echo $excerpt; 
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
                                        <a class="next btn btn-black" <?php if( $totalpost <= $num_posts ){ echo 'style="display: none;"'; } ?>>Load more results</a>
                                    </div>
                                </div>
                            </div>
                            <?php if( !$the_query->have_posts() ): ?> 
                                <div class="no-entry"><strong>No Entry Found.</strong></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<script type="text/javascript">
    window.addEventListener('load', (event) => {
        let url = window.location.href;
        if( url.includes( '?' ) ) { 
            let sctop = document.getElementById('<?php echo esc_attr( $id ); ?>').offsetTop;
            $('body, html').animate({ scrollTop: sctop }, 600);
        }
    });
</script>