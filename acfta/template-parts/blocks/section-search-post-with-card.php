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

$pageSet = 8;

$the_query = new WP_Query(array (
        'post_type'     => get_field( 'select_post_type' ),
        'numberposts'   => $pageSet,
        'meta_key'	    => 'closing_date',
        'orderby'		=> 'meta_value',
        'order'			=> 'DESC'
    )
);
$totalpost = $the_query->found_posts; 
?>

<?php

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
   
?>

<?php if ( get_field( 'enable_border_top' ) == 1 ) : ?>
    <hr class="hr mb-0">
<?php endif; ?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> selects-section mobile-space" data-form-filter="6">
    <div class="post-filter-view-grid">
        <div class="container">      
            <?php if ( get_field( 'enable_content_center' ) == 1 ) : ?>
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2><?php the_field( 'heading' ); ?></h2>
                    <p class="lead"><?php the_field( 'content' ); ?></p>
                </div>
            </div>
            <?php else : ?>
            <h2><?php the_field( 'heading' ); ?></h2>
            <p class="lead"><?php the_field( 'content' ); ?></p>
            <?php endif; ?>
            <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="<?php echo get_field( 'select_post_type' ); ?>" data-action="loadCards" class="filter-form pt-3 pt-md-5">
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
                                    <?php foreach($typeApp->terms as $rsA):
                                        if( (is_array($_GET['application_type']) AND in_array($rsA->term_id, $_GET['application_type']) ) OR $_GET['application_type']  == $rsA->term_id ){
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
                        <div class="col-lg">
                            <label class="d-block filter-research-dropdown max-width-4">
                                <span class="label-text">Filter by Funding Type</span>
                                <select name="funding_type[]" multiple>
                                    <?php foreach($typeFun->terms as $rsF):
                                        if( (is_array($_GET['funding_type']) AND in_array($rsA->term_id, $_GET['funding_type']) ) OR $_GET['funding_type'] == $rsF->term_id ){
                                            $selected='selected="selected"';
                                        }
                                        else{
                                            $selected='';
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
                                <select name="artform[]" multiple>
                                    <?php foreach($typeArt->terms as $rsArt):
                                        if( (is_array($_GET['artform']) AND in_array($rsA->term_id, $_GET['artform']) ) OR $_GET['artform'] == $rsArt->term_id ){
                                            $selected='selected="selected"';
                                        } else {
                                            $selected='';
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
                                    <input type="text" placeholder="Enter title" name="title" value="<?php echo $_GET['title'];?>">
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
        <?php if( $the_query->have_posts() ): ?>
        <div class="highlights-section low-caps">
            <div class="container-fluid">
                <div class="row gutter-22" data-output="grid">
                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <?php 
                    $postid = get_the_ID();
                    $cat =  get_post_type( $the_query->the_post() );
                    $post_date = get_the_date( 'j F, Y' );
                    ?>
                    <div class="col-lg-4 col-sm-6 col-12 mb-2 mb-sm-3 mb-lg-0">
                        <a href="<?php echo get_permalink(); ?>" class="highlight-box d-flex">
                            <?php the_post_thumbnail('full', array('class' => 'classname')); ?>
                            <div class="box-bottom">
                                <span class="advocacy-tag"><?php echo $cat;?></span>
                                <h3><?php the_title(); ?></h3>
                                <span class="box-date">Publication date: <?php echo $post_date;?></span>
                            </div>
                        </a>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>                
            <div class="loading-pagination mt-4 px-3 text-center">
                <div class="col">      
                    <div class="text-center">
                        <a class="next btn btn-black" >Load more results</a>
                    </div>
                </div>
            </div>
        </div>          
        <div class="loading-icon"></div>
        <?php endif; ?>
    </div>
    <div class="post-filter-view-list d-none">
        <div class="container">
            <div class="mobile-space">
                <div class="col-xl-8 col-lg-7 col-12 text-left">
                    <h2><?php the_field( 'heading' ); ?></h2>
                    <p class="lead text-left"><?php the_field( 'content' ); ?></p>
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
                                <div class="placement-aside">
                                    <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="<?php echo get_field( 'select_post_type' ); ?>" data-action="loadCards">
                                        <ul class="list-unstyled topics-search horizontal-search filter-research-dropdown">
                                            <li>
                                                <label class="d-block filter-research-dropdown">
                                                    <span class="label-text">Filter by Application type</span>
                                                    <select name="application_type[]" multiple>
                                                        <?php foreach($typeApp->terms as $rsA):
                                                                if( (is_array($_GET['application_type']) AND in_array($rsA->term_id, $_GET['application_type']) ) OR $_GET['application_type']  == $rsA->term_id ){
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
                                            </li>
                                            <li>
                                                <label class="d-block filter-research-dropdown">
                                                    <span class="label-text">Filter by Funding Type</span>
                                                    <select name="funding_type[]" multiple>
                                                        <?php foreach($typeFun->terms as $rsF):
                                                            if( (is_array($_GET['funding_type']) AND in_array($rsA->term_id, $_GET['funding_type']) ) OR $_GET['funding_type'] == $rsF->term_id ){
                                                                $selected='selected="selected"';
                                                            }
                                                            else{
                                                                $selected='';
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
                                                        <?php foreach($typeArt->terms as $rsArt):
                                                            if( (is_array($_GET['artform']) AND in_array($rsA->term_id, $_GET['artform']) ) OR $_GET['artform'] == $rsArt->term_id ){
                                                                $selected='selected="selected"';
                                                            } else {
                                                                $selected='';
                                                            }
                                                        ?>
                                                        <option value="<?php echo $rsArt->term_id;?>" <?php echo $selected; ?> ><?php echo $rsArt->name;?></option>                            
                                                        <?php endforeach;?> 
                                                    </select>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block">
                                                    <span class="label-text">Search by title</span>
                                                    <span class="position-relative">
                                                        <input type="text" placeholder="Enter title" name="title" value="<?php echo $_GET['title'];?>">
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
                                    $postid = get_the_ID();
                                    $cat =  get_post_type( $the_query->the_post() );
                                    $post_date = get_the_date( 'j F, Y' );
                                    ?>
                                    <div class="post opportunity-item pt-0 pb-5">
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
                                                    <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
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
</section>
