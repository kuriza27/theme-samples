<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-resource-content.php
 *
 * Resource Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'resource-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-resource-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
$the_query = new WP_Query(array (
    'post_type'     => 'corporate_docs',
    'posts_per_page' => 9
    )
);
global $post;
$totalpost = $the_query->found_posts; 
?>

<?php

$term_args = array(
    'post_type'              => 'corporate_docs',
    'taxonomy'               => 'document_type',
    'hide_empty'             => false
);
$typeDoc = new WP_Term_Query( $term_args );

$term_args2 = array(
    'post_type'              => 'corporate_docs',
    'taxonomy'               => 'post_tag',
    'hide_empty'             => false
);
$typeTag = new WP_Term_Query( $term_args2 );

?>
<section class="selects-section border-top-0 pt-lg-5">
    <div class="<?php echo esc_attr( $classes ); ?>">
        <section class="resources-tools-section">
            <div class="mobile-space">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1><?php the_field( 'heading' ); ?></h1>
                            <?php the_field( 'content' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="selects-section border-top-0 pt-lg-5" data-form-filter="9">
            <div class="post-filter-view-grid">
                <!--Filter-->
                <div class="mobile-space">
                    <div class="container">
                        <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="corporate_docs" data-action="loadResources" class="filter-form pt-3 pt-md-5">
                            <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse"
                            data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                                Search <span class="icon-chevron-thin-down ml-auto"></span>
                            </a>
                            <div class="collapse" id="filterFields">
                                <div class="row pt-md-0 pt-3">
                                    <div class="col-lg">
                                        <label class="d-block filter-research-dropdown filter-resources-dropdown">
                                            <span class="label-text">Filter by Document Type</span>
                                            <select name="document_type" multiple>
                                                <?php foreach($typeDoc->terms as $rsF):?>
                                                    <option value="<?php echo $rsF->term_id;?>"><?php echo $rsF->name;?></option>                            
                                                <?php endforeach;?> 
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-lg">
                                        <label class="d-block filter-research-dropdown filter-resources-dropdown">
                                            <span class="label-text">Filter by tags</span>
                                            <select name="post_tag" multiple>
                                                <?php foreach($typeTag->terms as $rsArt):?>
                                                    <option value="<?php echo $rsArt->term_id;?>"><?php echo $rsArt->name;?></option>                            
                                                <?php endforeach;?> 
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-lg">
                                        <label class="d-block">
                                            <span class="label-text">Search by Term</span>
                                            <span class="position-relative">
                                                <input type="text" placeholder="Enter term here" name="title" value="">
                                                <button class="search-input-btn">
                                                    <span class="icon-search"></span>
                                                </button>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-auto">
                                        <label class="d-block">
                                            <span class="label-text">View </span>
                                            <span class="position-relative">
                                                <a href="javascript:void(0);" class="list-view icon-list-view" data-view="list"><span class="icon-list"></span></a>
                                                <div class="list-view icon-grid-view"><span class="icon-grid1"></span></div>
                                            </span>
                                        </label>
                                    </div>  
                                </div>
                                <div class="post-type-results-info mb-5" style="display: none;"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/filter--->
                <div class="container documents-list list-main-container">
                    <?php if( $the_query->have_posts() ): ?>
                    <div class="row" data-output="grid">
                        <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <div class="col-xl-4 col-md-6">
                            <div class="document-box d-flex">
                                <?php
                                    $post_id = get_the_ID();
                                    $pdf_link_attachment = get_field( 'pdf_link_attachment', $post_id);
                                    $rtf_link_attachment = get_field( 'rtf_link_attachment', $post_id);
                                    $doc_link_attachment = get_field( 'doc_link_attachment', $post_id);
                                    $image_link_attachment = get_field( 'image_link_attachment', $post_id);

                                    if ( $pdf_link_attachment ) :
                                        $file_format="PDF";
                                        $url = esc_url( $pdf_link_attachment['url']);
                                    elseif ( $doc_link_attachment ) :
                                        $file_format="DOC";
                                        $url = esc_url( $doc_link_attachment['url'] );
                                    elseif($rtf_link_attachment):
                                        $file_format="RTF";
                                        $url = esc_url( $rtf_link_attachment['url'] );
                                    elseif($image_link_attachment):
                                        $file_format="IMG";
                                        $url = esc_url( $image_link_attachment['url'] );
                                    else:
                                        $file_format="";
                                    endif;
                                ?>
                                <div class="doc-img d-flex justify-content-center align-items-center"><?php echo $file_format; ?></div>
                                <div class="document-info">
                                    <h4><a href="<?php echo $url;?>" download><?php the_title(); ?></a></h4>
                                    <?php 
                                        $excerpt = get_the_excerpt(); 
                                        $excerpt = substr( $excerpt, 0, 250 ); // Only display first 260 characters of excerpt
                                        $result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
                                        echo $result.".";
                                        ?>
                                    <div class="links-group d-flex">
                                            <a href="<?php echo $url;?>" download><?php echo $file_format;?></a>
                                            <a class="ml-auto" href="<?php echo $url;?>" download><span class="icon-plus-light"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>                            
                        <?php 
                            endwhile; 
                        ?>
                    </div><!---/row-->
                    <div class="loading-icon"></div>
                    <?php endif; ?>
                </div><!--/container document-list-->    
                <div class="loading-pagination mt-4 px-3 text-center">
                    <div class="col">      
                        <div class="text-center">
                            <a class="next btn btn-black" >Load more results</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/end post-filter-view-grid -->
            <div class="post-filter-view-list d-none">
                <div class="container">
                    <div class="row flex-lg-row-reverse">
                        <div class="col-xl-4 col-lg-5 col-12">
                            <div class="right-sidebar push-top">
                                <div class="placement-aside">
                                    <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-cpt="corporate_docs" data-action="loadResources">
                                        <ul class="list-unstyled topics-search horizontal-search filter-research-dropdown">
                                            <li>
                                                <label class="d-block filter-research-dropdown filter-resources-dropdown">
                                                    <span class="label-text">Filter by Document Type</span>
                                                    <select name="document_type" multiple>
                                                        <?php foreach($typeDoc->terms as $rsF):?>
                                                            <option value="<?php echo $rsF->term_id;?>"><?php echo $rsF->name;?></option>                            
                                                        <?php endforeach;?> 
                                                    </select>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block filter-research-dropdown filter-resources-dropdown">
                                                    <span class="label-text">Filter by tags</span>
                                                    <select name="post_tag" multiple>
                                                        <?php foreach($typeTag->terms as $rsArt):?>
                                                            <option value="<?php echo $rsArt->term_id;?>"><?php echo $rsArt->name;?></option>                            
                                                        <?php endforeach;?> 
                                                    </select>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="d-block">
                                                    <span class="label-text">Search by Term</span>
                                                    <span class="position-relative">
                                                        <input type="text" placeholder="Enter term here" name="title" value="">
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
                                    <div class="post pt-0 pb-5">
                                        <?php
                                            $post_id = get_the_ID();
                                            $pdf_link_attachment = get_field( 'pdf_link_attachment', $post_id);
                                            $rtf_link_attachment = get_field( 'rtf_link_attachment', $post_id);
                                            $doc_link_attachment = get_field( 'doc_link_attachment', $post_id);
                                            $image_link_attachment = get_field( 'image_link_attachment', $post_id);

                                            if ( $pdf_link_attachment ) :
                                                $file_format="PDF";
                                                $url = esc_url( $pdf_link_attachment['url']);
                                            elseif ( $doc_link_attachment ) :
                                                $file_format="DOC";
                                                $url = esc_url( $doc_link_attachment['url'] );
                                            elseif($rtf_link_attachment):
                                                $file_format="RTF";
                                                $url = esc_url( $rtf_link_attachment['url'] );
                                            elseif($image_link_attachment):
                                                $file_format="IMG";
                                                $url = esc_url( $image_link_attachment['url'] );
                                            else:
                                                $file_format="";
                                            endif;
                                        ?>
                                        <div class="row">
                                            <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
                                                <?php $size='365x200';?>
                                                <a href="<?php echo get_permalink();?>">
                                                    <div style="background-color:#000;height:172px;font-size:28px;" class="d-flex align-items-center text-center justify-content-center">
                                                        <span class="color-white font-weight-bold"><?php echo $file_format; ?></span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="mobile-space">
                                                    <span class="<?php echo $status_class ?> d-inline-block"><?php echo $status; ?></span>
                                                    <?php the_title(); ?>
                                                    <p class="font-weight-medium"><?php echo $price; ?></p>
                                                    <?php 
                                                        $excerpt = get_the_excerpt();
                                                        $excerpt = substr($excerpt, 0, 200);
                                                        echo $excerpt; 
                                                    ?>
                                                    <div class="links-group d-inline-flex mt-5">
                                                        <a class="d-inline-block mr-5 font-weight-bold" href="<?php echo $url;?>" download><?php echo $file_format;?></a>
                                                        <a class="ml-auto" href="<?php echo $url;?>" download><span class="icon-plus-light"></span></a>
                                                    </div>
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
            </div>
            <!-- /end post-filter-view-list -->
        </section>              
    </div>    
 </section>