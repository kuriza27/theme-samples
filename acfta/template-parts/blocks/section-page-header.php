<?php
$id = 'page-header-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-page-header';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$headingAlignmentClasses = "col-12 col-sm-8";
$socialMediaClasses = "col-12 col-sm-4 d-flex justify-content-end";
$rowAlignmentClasses = "align-items-end justify-content-between";

global $post;
$pageID = $post->ID;

$title = empty( get_field( 'title' ) ) ? get_the_title( $post->ID ) : get_field( 'title' );
$version = get_field( 'page_header_version_alignment');
 if($version=='v2'):
    $headingAlignmentClasses = "col-12";
    $socialMediaClasses = "col-12 d-flex justify-content-end";
    $rowAlignmentClasses = "align-items-end";

 elseif($version=='v3'):
    $headingAlignmentClasses = "col-9 col-sm-8";
    $socialMediaClasses = "col-3 col-sm-4 d-flex justify-content-end";
    $rowAlignmentClasses = "align-items-end";

else:
    $headingAlignmentClasses = "col-12 col-sm-8";
    $socialMediaClasses = "col-12 col-sm-4 d-flex justify-content-end";
    $rowAlignmentClasses = "align-items-end justify-content-between";
 endif;

 $headerClass = get_field( 'header_class',$pageID);

?>
<section id="<?php echo esc_attr( $id ); ?>" class="page-header-block pt-200 header <?php echo $classes; ?> <?php echo $headerClass;?>">
    <div class="header-content min-h-auto">
            <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="row <?php echo $rowAlignmentClasses; ?>">
                                <div class="<?php echo $headingAlignmentClasses; ?>">
                                    <h1><?php the_field( 'title' ); ?></h1>
                                    <div class="d-none d-lg-block d-xl-none">
                                        <?php echo do_shortcode('[addtoany]'); ?>
                                    </div>
                                    <?php 
                                     //get category
                                        $catName = "";
                                        $cat = get_the_category();
                                        if($cat){ 
                                          $catName = $cat[0]->name;
                                        }
                                        if($catName):
                                    ?>
                                      <span class="reference-text"><?php $cat = get_the_category(); echo $cat[0]->name;?></span><br>
                                      <span class="reference-text"> <?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></span>
                                    <?php endif;?>
                                    <?php
                                        $reference = get_field( 'reference_n', $pageID);
                                        if( $reference ):
                                    ?>
                                      <span class="reference-text">Reference No</span><br>
                                       <span class="reference-no"><?php echo $reference; ?></span>
                                    <?php endif;?>
                                </div>
                                <div class="<?php echo $socialMediaClasses; ?> d-lg-none d-xl-block">
                                    <!--<ul class="share-list list-unstyled d-flex mb-0">
                                        <li><a href="#"><span class="icon-share-2"></span></a></li>
                                        <li><a href="#"><span class="icon-email"></span></a></li>
                                        <li><a href="#"><span class="icon-plus"></span></a></li>
                                    </ul>-->
                                    <?php echo do_shortcode('[addtoany]'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-none d-lg-block">

                        </div>
                    </div>
            </div>
    </div><!--/header-content---->
    <?php if ( get_field( 'show_breadcrumb' ) == 1 ) : ?>
    <div class="breadcrumb-container light mt-4">
        <div class="container">
            <div class="breadcrumb-area">
                <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
