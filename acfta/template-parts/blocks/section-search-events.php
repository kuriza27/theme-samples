
<?php
/**
 *
 * Search Events Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'search-events-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-search-events-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$term_args = array(
    'post_type'              => 'events',
    'taxonomy'               => 'post_tag',
    'hide_empty'             => false
);
$tags = new WP_Term_Query( $term_args );

$args = array (
    'post_type'         => 'research',
    'meta_key'			=> 'event_date',
    'orderby'			=> 'meta_value_num',
    'order'				=> 'ASC',
    'posts_per_page'    => 5,
    'meta_query'        => array(
        'relation'  => 'AND',
        array(
            'key'       => 'event_date',
            'compare'   => 'EXIST'
        ),
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
        )
    )
);

$the_query = new WP_Query( $args );

$totalpost = $the_query->found_posts; 
$count = 1;
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> selects-section" data-form-filter="5">
    <div class="post-filter-view-grid">
        <div class="mobile-space">
            <div class="container">
                <h2 class="h1"><?php the_field( 'heading_title' ); ?></h2>
                <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="research" data-action="loadEvents" class="filter-form pt-5">
                    <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse" data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                        Search <span class="icon-chevron-thin-down ml-auto"></span></a>
                    <div class="collapse" id="filterFields">
                        <div class="row justify-content-between pt-md-0 pt-3">
                            <div class="col-lg-4">
                                <label class="d-block filter-research-dropdown filter-resources-dropdown">
                                    <span class="label-text">Filter by Tag</span>
                                    <select name="post_tag" multiple>
                                        <?php foreach($tags->terms as $term):?>
                                            <option value="<?php echo $term->term_id;?>"><?php echo $term->name; ?></option>                            
                                        <?php endforeach;?> 
                                    </select>
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label class="d-block filter-research-dropdown filter-resources-dropdown">
                                    <span class="label-text">Filter by date</span>
                                    <input type="text" placeholder="Select Month" name="event_date" onfocus="(this.type='month')" onblur="if(this.value==''){this.type='text'}">
                                </label>
                            </div>
                            <div class="col-lg-3 d-none d-lg-block">
                                <label class="d-block filter-research-dropdown filter-resources-dropdown">
                                    <span class="label-text">Search by term</span>
                                    <span class="position-relative">
                                        <input type="text" placeholder="Enter term here" name="title" value="">
                                        <button class="search-input-btn">
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
                        <div class="post-type-results-info pt-0 mb-5" style="display: none;"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid list-main-container">
            <div class="row" data-output="grid">

            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php   
                    $post_id = get_the_ID();
                    $cat = 'Events';
                    $post_date = get_the_date( 'j F, Y' );
                    $field_title = get_field( 'field_title', $post_id );
                    $duration = get_field( 'duration_info', $post_id );
                    $event_date = get_field( 'event_date', $post_id );
                ?>
                <?php if($count == 1): ?>
                    <div class="col-lg-7">
                        <a href="<?php echo get_permalink(); ?>" class="event-box lg d-flex">
                            <?php the_post_thumbnail('full', array('class' => 'classname')); ?>
                            <div class="event-info">
                                <h5 class="badge"><?php echo $cat; ?></h5>
                                <h2><?php the_title(); ?></h2>
                                <div class="meta d-flex justify-content-between">
                                    <?php if(!empty($duration)): ?>
                                    <span><?php echo $field_title; ?> | <?php echo $duration;?></span> 
                                    <span>Event Date: <?php echo $event_date;?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>                    
                    </div>
                <?php endif; ?>
                <?php if( $count == 2 ): ?>
                <div class="col-lg-5">
                <?php endif; ?>
                <?php if( $count == 2 || $count == 3 ): ?>
                    <a href="<?php echo get_permalink($post_id); ?>" class="event-box sm d-flex">                    
                        <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'search-post-thumb' ) ); ?>
                        <div class="event-info">
                            <h5 class="badge"><?php echo $cat; ?></h5>
                            <h2 class="mb-3"><?php the_title(); ?></h2>
                            <?php if(!empty($duration)): ?>
                                <div class="meta d-flex justify-content-between">
                                        <span><?php echo $field_title;?> | <?php echo $duration;?></span> 
                                        <span>Event Date: <?php echo $event_date;?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endif; ?>
                <?php if( $count == 3 ): ?>
                </div>
                <?php endif; ?>

                <?php if($count >= 4): ?> 
                    <div class="col-lg-6">
                        <a href="<?php echo get_permalink($post_id); ?>" class="event-box sm d-flex">
                            <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'search-post-thumb' ) ); ?>
                            <div class="event-info">
                                <h5 class="badge"><?php echo $cat; ?></h5>
                                <h2><?php the_title(); ?></h2>
                                <div class="meta d-flex justify-content-between">
                                <?php if(!empty($duration)): ?>
                                    <span><?php echo $field_title;?> | <?php echo $duration;?></span> <span>Event Date: <?php echo $event_date;?>
                                <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

            <?php $count++; endwhile; ?>
                
            </div><!-- /row -->
            
            <div class="loading-icon"></div>
        </div><!-- /container-fluid -->
        <div class="loading-pagination mt-4 px-3 text-center">
            <div class="col">      
                <div class="text-center">
                    <a class="next btn btn-black" >Load more results</a>
                </div>
            </div>
        </div>
    </div>   
    <!-- /end post-filter-view-grid -->         
    <div class="post-filter-view-list d-none">
        <div class="container">
            <div class="mobile-space">
                <h2 class="h1"><?php the_field( 'heading_title' ); ?></h2>
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
                                    <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="research" data-action="loadEvents">
                                        <ul class="list-unstyled topics-search horizontal-search filter-research-dropdown">
                                            <li>
                                                <label class="d-block filter-research-dropdown filter-resources-dropdown">
                                                    <span class="label-text">Filter by Tag</span>
                                                    <select name="post_tag" multiple>
                                                        <?php foreach($tags->terms as $term):?>
                                                            <option value="<?php echo $term->term_id;?>"><?php echo $term->name; ?></option>                            
                                                        <?php endforeach;?> 
                                                    </select>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block filter-research-dropdown filter-resources-dropdown">
                                                    <span class="label-text">Filter by date</span>
                                                    <input type="month" name="event_date" value="">
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block search-mobile-space">
                                                    <span class="label-text">Search by title</span>
                                                    <span class="position-relative">
                                                        <input type="text" placeholder="Enter title" name="title" value="">
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
                                    $cat = get_post_type( $post_id );
                                    $post_date = get_the_date( 'j F, Y' );
                                    $field_title = get_field( 'field_title', $post_id );
                                    $duration = get_field( 'duration_info', $post_id );
                                    $event_date = get_field( 'event_date', $post_id );
                                    ?>
                                    <div class="post pt-0 pb-5">
                                        <div class="row">
                                            <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
                                                <?php $size='365x200';?>
                                                <a href="<?php echo get_permalink();?>">
                                                    <?php if( has_post_thumbnail() ){ ?>
                                                    <?php the_post_thumbnail($size,['class' => 'post-img w-100']);  ?>
                                                    <?php } 
                                                        else{
                                                    ?> 
                                                        <div style="background-color:#000;height:172px;"></div>
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="mobile-space">
                                                    <h5 class="badge"><?php echo $cat; ?></h5>
                                                    <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                                                    <div class="meta d-flex justify-content-between mb-3">
                                                        <span class="font-weight-medium"><?php echo $field_title;?> | <?php echo $duration;?></span> 
                                                        <span class="font-weight-medium">Event Date: <?php echo $event_date;?>
                                                    </div>
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
                                <?php else : ?>
                                    <div class="no-entry"><strong>No Entry Found.</strong></div>
                                <?php endif; ?>
                                </div>
                                <div class="loading-icon"></div>
                                <div class="loading-pagination mt-4 px-3 text-center">
                                    <div class="col">      
                                        <div class="text-center">
                                            <a class="next btn btn-black" >Load more results</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /end post-filter-view-list -->  
</section>