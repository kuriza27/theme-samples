<?php
/**
 * Template Name: Archive Stories
 * The template for displaying research post pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ACFTA
 */

get_header();
$pageSet = 12;

$the_query = new WP_Query(array (
        'post_type'     => 'stories',
        'posts_per_page' => 12,
        'numberposts'   => $pageSet
    )
);
$totalpost = $the_query->found_posts; 
?>
<!--display 1-->
<div class="display-grid-view">
    <section id="<?php echo esc_attr( $id ); ?>-archive-stories" class="page-header-block pt-140 header archive-stories">
       <div class="header-content">
            <div class="container<?php if ( get_field( 'align_center' ) == 1 ) : ?>-sm<?php endif; ?>">
                        <div class="row align-items-end">
                            <div class="col-12 col-sm-8">
                            <h1><?php echo post_type_archive_title( '', false ); ?></h1><br>
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
                                            <label class="d-block">
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
                                                        <select name="topic">
                                                            <option value="">Select</option>
                                                            <?php foreach($typeTopic->terms as $rsA):?>
                                                                <option value="<?php echo $rsA->term_id;?>"><?php echo $rsA->name;?></option>
                                                            <?php endforeach;?> 
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="col-lg">
                                                    <label class="d-block filter-research-dropdown">
                                                        <span class="label-text">Filter by area</span>
                                                        <select name="area">
                                                            <option value="">Select</option>
                                                            <?php foreach($typeArea->terms as $rsA):?>
                                                                <option value="<?php echo $rsA->term_id;?>"><?php echo $rsA->name;?></option>
                                                            <?php endforeach;?> 
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="col-lg">
                                                    <label class="d-block filter-research-dropdown">
                                                        <span class="label-text ">Filter by artform</span>
                                                        <select name="art_form">
                                                            <option value="">Select</option>
                                                            <?php foreach($typeArt->terms as $rsA):?>
                                                                <option value="<?php echo $rsA->term_id;?>"><?php echo $rsA->name;?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="col-lg d-none d-lg-block">
                                                    <label class="d-block">
                                                        <span class="label-text">Search by title</span>
                                                        <span class="position-relative">
                                                <input type="text" placeholder="Enter title" class="search-by-title">
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
                                    <span>Your search has returned <strong><span class="totalpost"><?php echo $totalpost;?></span> results</strong></span>
                                </div>
                                <div class="posts-list alt no-gutters row pt-0">
                                <?php if( $the_query->have_posts() ): ?>

                                <?php
                                    while( $the_query->have_posts() ) : $the_query->the_post();   
                                ?>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 post d-flex">
                                                <div class="d-flex flex-column">
                                                     <div class="flex-shrink-0">
                                                          <?php $size='447X650';?>
                                                          <a href="<?php echo get_permalink();?>"><?php  the_post_thumbnail($size,['class' => 'post-img w-100']);  ?></a>
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

                                            the_posts_navigation();

                                            else :

                                            get_template_part( 'template-parts/content', 'none' );

                                            endif;
                                            ?>

                                </div><!--/post-list--->
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
    <section id="<?php echo esc_attr( $id ); ?>-archive-media-release" class="page-header-block pt-140 header archive-media-release">
       <div class="header-content">
            <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="row align-items-end">
                                    <div class="col-12 col-xl-8">
                                    <h1><?php echo post_type_archive_title( '', false ); ?></h1><br>
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
                                        <ul class="list-unstyled topics-search">
                                            <li>
                                                <label for="">Select a topic</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="" hidden="">Select</option>
                                                    <option value="">Topci 1</option>
                                                    <option value="">Topci 2</option>
                                                    <option value="">Topci 3</option>
                                                </select>
                                            </li>
                                            <li>
                                                <label for="">Select an artform</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="" hidden="">Select</option>
                                                    <option value="">artform 1</option>
                                                    <option value="">artform 2</option>
                                                    <option value="">artform 3</option>
                                                </select>
                                            </li>
                                            <li>
                                                <label for="">Enter a search term</label>
                                                <input type="search" placeholder="Search" class="form-control">
                                            </li>
                                            <li>
                                                <input type="submit" class="search-input-btn btn btn-black btn-block" value="Search">
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
                                <span>Your search has returned <strong><span class="totalpost"><?php echo $totalpost;?></span> results</strong></span>
                                </div>
                                <div class="posts-list">
                                <?php if( $the_query->have_posts() ): ?>
                                    <?php
                                        while( $the_query->have_posts() ) : $the_query->the_post();   
                                    ?>
                                    <div class="post">
                                        <div class="row">
                                            <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
                                                <?php $size='447X650';?>
                                                <a href="<?php echo get_permalink();?>"><?php  the_post_thumbnail($size,['class' => 'post-img w-100']);  ?></a>
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
                                    <nav class="post-type-pagination" aria-label="Page navigation example">
                                        <?php  the_posts_navigation(); ?>
                                    </nav>
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
