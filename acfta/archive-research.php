<?php
/**
 * Template Name: Archive Research
 * The template for displaying research post pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ACFTA
 */

get_header();
$pageSet = 12;
$paged = (isset($_GET['_page']) and absint($_GET['_page'])) ? absint($_GET['_page']) : 1;

$num_posts = get_field( 'num_posts' );
$post_type = 'research';
$args = array (
    'post_type'      => $post_type,
    'numberposts'    => $num_posts,
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

if( $_GET['_topic'] != '' ){
	$topic_params = array_map('urldecode', explode(",", $_GET['_topic']));
    $args['tax_query'][] = array(
        'taxonomy' => 'topic',
        'field' => 'name',
        'terms' => $topic_params
    );
}
// if( $_GET['area'] != '' ){
// 	$area_params = explode(",", $_GET['area']);
//     $args['tax_query'][] = array(
//         'taxonomy' => 'area',
//         'field' => 'name',
//         'terms' => $area_params
//     );
// }
if( $_GET['_art_form'] != '' ){
	$art_form_params = array_map('urldecode', explode(",", $_GET['_art_form']));
    $args['tax_query'][] = array(
        'taxonomy' => 'art_form',
        'field' => 'name',
        'terms' => $art_form_params
    );
}
if( $_GET['topic'] != '' || $_GET['art_form'] != '' ) {
    if( count($args['tax_query']) > 1 ){
        $args['tax_query']['relation'] = 'AND';
    }
}
if( $_GET['title'] != '' ){
    $args['s'] = $_GET['title'];
}

$the_query = new WP_Query($args);

$totalpost = $the_query->found_posts; 
?>
<?php 
$term_args = array(
    'post_type'              => 'research',
    'taxonomy'               => 'topic',
    'hide_empty'             => false
);
$typeTopic = new WP_Term_Query( $term_args );

$term_args2 = array(
    'post_type'              => 'research',
    'taxonomy'               => 'area',
    'hide_empty'             => false
);
$typeArea = new WP_Term_Query( $term_args2 );

$term_args3 = array(
    'post_type'              => 'research',
    'taxonomy'               => 'art_form',
    'hide_empty'             => false
);
$typeArt = new WP_Term_Query( $term_args3 );

?>
<!--display 1-->
<div class="display-grid-view">
    <section id="<?php echo esc_attr( $id ); ?>-archive-research" class="page-header-block pt-140 header archive-research">
       <div class="header-content">
            <div class="container<?php if ( get_field( 'align_center' ) == 1 ) : ?>-sm<?php endif; ?>">
                        <div class="row align-items-end">
                            <div class="col-12 col-sm-8">
                                <h1><?php echo the_title();?></h1><br>
                            </div>
                            <div class="col-12 col-sm-4 d-flex justify-content-end">   
                                <div class="mobile-space">                                  
                                        <!--<ul class="share-list list-unstyled d-flex mb-0">
                                            <li><a href="#"><span class="icon-share-2"></span></a></li>
                                            <li><a href="#"><span class="icon-email"></span></a></li>
                                            <li><a href="#"><span class="icon-plus"></span></a></li>
                                        </ul>-->
                                        <?php echo do_shortcode('[addtoany]'); ?>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-4"> </div>
            </div>
        </div>
        <div class="breadcrumb-container light mt-4">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <?php yoast_breadcrumb('<ol class="breadcrumb '. $breadcrumbs_color .'"><li class="breadcrumb-item">','</li></ol>'); ?>
                </nav>
            </div>
        </div>

    </section>
    <div class="page-content">
            <section class="archive-research post-type-section overflow-hidden">
                <div class="container">
                <div class="loader-area"></div>
                    <div class="row">
                        <div class="col">
                            <div class="post-type-left">
                                <div class="post-type-results-info alt">
                                    <h2>I am interested in</h2>
                                    <form action="#" class="filter-form pt-3 white-fields">
                                        <div class="d-lg-none">
                                            <label class="d-block filter-research-dropdown">
                                                <span class="label-text">Search by title</span>
                                                <span class="position-relative">
                                                <input type="text"
                                                       placeholder="Enter title">
                                                <button class="search-input-btn">
                                                    <span class="icon-search"></span>
                                                </button>
                                            </span>
                                            </label>
                                        </div>
                                        <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse"
                                           data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                                            Search <span class="icon-chevron-thin-down ml-auto"></span></a>
                                        <div class="collapse" id="filterFields">
                                            <div class="row pt-md-0 pt-3">
                                                <div class="col-lg">
                                                    <label class="d-block filter-research-dropdown">
                                                        <span class="label-text">Select Topic</span>
                                                        <select name="topic" class="select" multiple>
                                                            <!-- <option value="">Select</option> -->
                                                            <?php foreach($typeTopic->terms as $rsA):
                                                                    if( in_array($rsA->name, $topic_params) ){
                                                                        $selected='selected="selected"';
                                                                    }
                                                                    else{
                                                                        $selected='';
                                                                    }
                                                            ?>
                                                                <option value="<?php echo $rsA->term_id;?>" <?php echo $selected; ?> ><?php echo $rsA->name;?></option>
                                                            <?php endforeach;?> 
                                                        </select>
                                                    </label>
                                                </div>
                                                <?php /*
                                                <div class="col-lg">
                                                    <label class="d-block">
                                                        <span class="label-text">Filter by area</span>
                                                        <select name="area">
                                                            <option value="">Select</option>
                                                            <?php foreach($typeArea->terms as $rsA):
                                                                if( $_GET['area'] == $rsA->term_id ){
                                                                        $selected='selected="selected"';
                                                                    }
                                                                    else{
                                                                        $selected='';
                                                                    }
                                                            ?>
                                                                <option value="<?php echo $rsA->term_id;?>" <?php echo $selected; ?> ><?php echo $rsA->name;?></option>
                                                            <?php endforeach;?> 
                                                        </select>
                                                    </label>
                                                </div>
                                                */ ?>
                                                <div class="col-lg">
                                                    <label class="d-block filter-research-dropdown">
                                                        <span class="label-text">Filter by artform</span>
                                                        <select name="art_form" multiple>
                                                            <!-- <option value="">Select</option> -->
                                                            <?php foreach($typeArt->terms as $rsA):
                                                                    if( in_array($rsA->name, $art_form_params) ){
                                                                        $selected='selected="selected"';
                                                                    }
                                                                    else{
                                                                        $selected='';
                                                                    }

                                                            ?>
                                                                <option value="<?php echo $rsA->term_id;?>" <?php echo $selected; ?> ><?php echo $rsA->name;?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="col-lg d-none d-lg-block">
                                                    <label class="d-block">
                                                        <span class="label-text">Search by title</span>
                                                        <span class="position-relative">
                                                <input type="text" placeholder="Enter title" class="search-by-title" value="<?php echo $_GET['title'];?>">
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
                                                            <a href="#"  class="list-view icon-list-view"><span class="icon-list"></span></a>
                                                            <div class="list-view icon-grid-view"><span class="icon-grid1"></span></div>
                                                        </span>                       
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <span class="search-return-label" style="display:none;">Your search has returned <strong><span class="totalpost"><?php echo $totalpost;?></span> results</strong></span>
                                </div>
                                <div class="posts-list alt no-gutters row pt-0" data-view="block">
                                <?php if( $the_query->have_posts() ): ?>

                                <?php
                                    while( $the_query->have_posts() ) : $the_query->the_post();   
                                ?>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 post d-flex">
                                                <div class="d-flex flex-column w-100">
                                                     <div class="flex-shrink-0">
                                                          <?php $size='365x200';?>
                                                          <a href="<?php echo get_permalink();?>">
                                                            <?php if( has_post_thumbnail() ){?>
                                                            <?php  the_post_thumbnail($size,['class' => 'post-img w-100']);  ?>
                                                            <?php } 
                                                                else{
                                                            ?> 
                                                                <div class="default-grid-card--no-image p-4 d-flex align-items-center justify-content-center">
                                                                    <div class="img-holder">
                                                                        <?php echo wp_get_attachment_image( '979', 'full' ); ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                            </a>
                                                      </div>
                                                <div class="flex-grow-1 d-flex flex-column post-data">
                                                            <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                                                            <div class="post-meta"><?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></div>
                                                                 <?php 
																	$excerpt = get_the_excerpt();
																	$excerpt = substr($excerpt, 0, 200);
																	echo $excerpt; 
																    ?>
                                                                           
                                                                <a href="<?php echo get_permalink();?>" class="more-link mt-auto">Read More</a>
                                                            </div>
                                                </div>
                                    </div>
                                    <?php
                                            endwhile;
                                            // wp_reset_postdata();
                                            // the_posts_navigation();
                                            custom_post_type_navigation( [
                                            	'max_num_pages' => $the_query->max_num_pages, 
                                            	'custom_post_type' => get_post_type()] 
                                            );

                                            else :

                                            get_template_part( 'template-parts/content', 'none' );

                                            endif;
                                            ?>

                                </div><!--/post-list-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>
        <!-- /page-content -->
</div>
<!--/display 1-->
<!--display 2-->
<div class="d-none display-list-view">
    <section id="<?php echo esc_attr( $id ); ?>-archive-research" class="page-header-block pt-140 header archive-research">
       <div class="header-content">
            <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="row align-items-end">
                                    <div class="col-12 col-xl-8">
                                    <h1>Arts Nation <br>Research Library</h1><br>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end col-xl-4">
                                        <!--<ul class="share-list list-unstyled d-flex mb-0">
                                            <li><a href="#"><span class="icon-share-2"></span></a></li>
                                            <li><a href="#"><span class="icon-email"></span></a></li>
                                            <li><a href="#"><span class="icon-plus"></span></a></li>
                                        </ul>-->
                                        <?php echo do_shortcode('[addtoany]'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">

                            </div>
                        </div>
                    </div>
        </div>
        <div class="breadcrumb-container light mt-4">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <?php yoast_breadcrumb('<ol class="breadcrumb '. $breadcrumbs_color .'"><li class="breadcrumb-item">','</li></ol>'); ?>
                </nav>
            </div>
        </div>
    </section>
        <div class="page-content">
            <section class="post-type-section">
                <div class="container">
                    <div class="loader-area"></div>
                    <div class="row flex-lg-row-reverse">
                        <div class="col-xl-4 col-lg-5 col-12">
                            <div class="right-sidebar push-top-lg">
                                <div class="placement-aside">
                                    <h3>I am interested in</h3>
                                    <form action="">
                                        <ul class="list-unstyled topics-search horizontal-search filter-research-dropdown">
                                            <li>
                                                <label for="">Select a topic</label>
                                                <select name="topic" id="" class="form-control" multiple>
                                                    <!-- <option value="">Select</option> -->
                                                    <?php foreach($typeTopic->terms as $rsA):
                                                                    if( in_array($rsA->name, $topic_params) ){
                                                                        $selected='selected="selected"';
                                                                    }
                                                                    else{
                                                                        $selected='';
                                                                    }
                                                            ?>
                                                                <option value="<?php echo $rsA->term_id;?>" <?php echo $selected; ?> ><?php echo $rsA->name;?></option>
                                                            <?php endforeach;?>
                                                </select>
                                            </li>
                                            <?php /*
                                            <li>
                                                <label for="">Select an area</label>
                                                <select name="area" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <?php foreach($typeArea->terms as $rsA):
                                                        if( $_GET['area'] == $rsA->term_id ){
                                                                $selected='selected="selected"';
                                                            }
                                                            else{
                                                                $selected='';
                                                            }
                                                    ?>
                                                        <option value="<?php echo $rsA->term_id;?>" <?php echo $selected; ?> ><?php echo $rsA->name;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </li> */ ?>
                                            <li>
                                                <label for="">Select an artform</label>
                                                <select name="art_form" id="" class="form-control" multiple>
                                                    <!-- <option value="">Select</option> -->
                                                    <?php foreach($typeArt->terms as $rsA):
                                                        if( in_array($rsA->name, $art_form_params) ){
                                                            $selected='selected="selected"';
                                                        }
                                                        else{
                                                            $selected='';
                                                        }

                                                ?>
                                                    <option value="<?php echo $rsA->term_id;?>" <?php echo $selected; ?> ><?php echo $rsA->name;?></option>
                                                <?php endforeach;?>
                                                </select>
                                            </li>
                                            <li>
                                                <label for="">Enter a search term</label>
                                                <input type="search" placeholder="Search" class="form-control" class="search-by-title">
                                            </li>
                                            <li>
                                                <input type="button" class="search-input-btn btn btn-black btn-block" value="Search">
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                                <div class="view-widget d-none d-lg-block">
                                    <span class="label-text mb-2 d-inline-block">View </span>
                                    <label class="d-flex align-items-center">
                                        <span class="position-relative">
                                            <div class="list-view icon-list-view"><span class="icon-list"></span></div>
                                            <a href="#"  class="list-view icon-grid-view"><span class="icon-grid1"></span></a>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-12">
                            <div class="post-type-left">
                                <div class="post-type-results-info">
                                <span class="search-return-label" style="display:none;">Your search has returned <strong><span class="totalpost"><?php echo $totalpost;?></span> results</strong></span>
                                </div>
                                <div class="posts-list" data-view="list">
                                <?php if( $the_query->have_posts() ): ?>
                                    <?php
                                        while( $the_query->have_posts() ) : $the_query->the_post();   
                                    ?>
                                    <div class="post">
                                        <div class="row">
                                            <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
                                                <?php $size='365x200';?>
                                                <a href="<?php echo get_permalink();?>">
                                                    <?php if( has_post_thumbnail() ){ ?>
                                                    <?php the_post_thumbnail($size,['class' => 'post-img w-100']);  ?>
                                                    <?php } 
                                                        else{
                                                    ?> 
                                                        <div class="default-horizontal-card--no-image p-4 d-flex align-items-center justify-content-center">
                                                            <div class="img-holder">
                                                                <?php echo wp_get_attachment_image( '979', 'full' ); ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    </a>
                                            </div>
                                            <div class="col">
                                                <div class="mobile-space">
                                                <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                                                    <div class="post-meta"><?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></div>
                                                    <?php 
														$excerpt = get_the_excerpt();
														$excerpt = substr($excerpt, 0, 200);
														echo $excerpt; 
													?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            endwhile;
                                           

                                            else :

                                            get_template_part( 'template-parts/content', 'none' );

                                            endif;
                                            ?>
                                </div>
                                <!--pagination-->
                                <div class="mobile-space">
                                    <!-- <nav class="post-type-pagination" aria-label="Page navigation example"> -->
                                        <?php // the_posts_navigation(); ?>
                                        <?php 
                                        	custom_post_type_navigation( [
                                            	'max_num_pages' => $the_query->max_num_pages, 
                                            	'custom_post_type' => get_post_type()] 
                                            ); 
                                        ?>
                                    <!-- </nav> -->
                                </div>
                                <!--/pagination-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</div>
<!---/display 2-->
<?php
//get_sidebar();
get_footer();
