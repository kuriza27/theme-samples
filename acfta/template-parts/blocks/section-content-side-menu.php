<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-content-side-menu.php
 *
 * Content Side Menu Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'content-side-menu-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-content-side-menu';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}


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

global $post;
$pageID = $post->ID;
$pageClass = get_field( 'page_content_class',$pageID);
$mobileSidebar = get_field( 'disable_sidebar_on_mobile', $pageID);

$categories = get_the_category();
$categoryName = "";
if($categories){
    $categoryName = $categories[0]->name;
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="peer-access-section <?php echo esc_attr( $classes ); ?> pb-5">
    <div class="container">
        <div class="row">
        <?php if ( get_field( 'enable_wider_sidebar_and_smaller_content' ) == 1 ) : ?>
            <div class="col-lg-5 col-xl-7">
        <?php else : ?>
            <div class="col-lg-7 col-xl-8">
        <?php endif; ?>
                <div class="page-single-content <?php echo $pageClass;?> content-list-squared">
                <?php if ( have_rows( 'content_blocks' ) ): ?>
                    <?php $contentBlock=1; while ( have_rows( 'content_blocks' ) ) : the_row(); ?>
                        <?php if ( get_row_layout() == 'content_block' ) : ?>
                            <div class="<?php the_sub_field( 'custom_class' ); ?>">
                                <div class="mobile-space page-content-area content-list-squared">
                                    <?php the_sub_field( 'content' ); ?>
                                </div>
                            </div>
                        <?php elseif ( get_row_layout() == 'image_with_caption' ) : ?>
                            <?php $imageSize = get_sub_field( 'image_size' ); ?>
                            <?php  $captionAlignment = get_sub_field( 'caption_alignment' ); ?>
                            <?php 
                                $caption = get_sub_field( 'caption' );
                                if($caption):
                            ?>
                                <!--/check image sizes with caption -->
                                <?php if($imageSize==1):?>
                                        <div class="mb-0">
                                            <?php $image = get_sub_field( 'image' ); ?>
                                            <?php $size = 'full'; ?>
                                            <?php if ( $image ) : ?>
                                                <?php echo wp_get_attachment_image( $image, $size,false, array( "class" => 'w-100 h-auto')); ?>
                                            <?php endif; ?>
                                            <div class="<?php echo $captionAlignment; ?>"><?php the_sub_field( 'caption' ); ?></div>
                                        </div>
                                 <?php else: ?>
                                        <figure class="mb-0">
                                            <?php $image = get_sub_field( 'image' ); ?>
                                            <?php $size = 'full'; ?>
                                            <?php if ( $image ) : ?>
                                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                                            <?php endif; ?>
                                            <figcaption class="<?php echo $captionAlignment; ?>"><?php the_sub_field( 'caption' ); ?></figcaption>
                                        </figure>
                                    <?php endif; ?>
                                <!--/end check image sizes with caption -->
                            <?php
                                else:
                            ?>
                                <div class="mx-n15 pb-3">
                                    <?php $image = get_sub_field( 'image' ); ?>
                                        <?php $size = 'full'; ?>
                                        <?php if ( $image ) : ?>
                                            <?php echo wp_get_attachment_image( $image, $size ); ?>
                                        <?php endif; ?>
                                </div>
                            <?php endif;?>
                        <?php elseif ( get_row_layout() == 'buttons_block' ) : ?>
                            <?php if ( have_rows( 'buttons' ) ) : ?>
                                <div class="mobile-space">
                                    <div class="row pt-20 mb-4">
                                        <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                                            <?php $button = get_sub_field( 'button' ); ?>
                                            <?php if ( $button ) : ?>
                                                <div class="col-lg-auto col-12 col-sm-6">
                                                <?php
                                                    $buttonClass = get_sub_field( 'button_class' );
                                                    if($buttonClass=="White"){
                                                        $buttonClass = "btn-outline-danger";
                                                    }else if($buttonClass=="Grey"){
                                                        $buttonClass = "btn-outline-dark";
                                                    }
                                                    else{
                                                        $buttonClass = "btn--dark";
                                                    }
                                                ?>
                                                    <a class="text-20 btn <?php echo $buttonClass ?> btn-block" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php elseif ( get_row_layout() == 'notification_block' ) : ?>
                            <div class="closed-data">
                                <?php the_sub_field( 'content' ); ?>
                            </div>
                        <?php elseif ( get_row_layout() == 'heading_block' ) : ?>
                            <<?php the_sub_field( 'h_tag' ); ?>><?php the_sub_field( 'heading' ); ?></<?php the_sub_field( 'h_tag' ); ?>>
                        <?php elseif ( get_row_layout() == 'video_block' ) : ?>
                            <div class="video-full-width-block mx-n15">
                                <?php the_sub_field( 'video' ); ?>
                            </div>
                            <?php elseif ( get_row_layout() == 'form_block' ) : ?>
                            <?php $form = get_sub_field( 'form' ); ?>
                                <?php if ( $form ) : ?>
                                    <div class="col-lg-8 border-right form-wrap py-80">
                                        <?php gravity_form( $form ); ?>
                                    </div>
                            <?php endif; ?>
                        <?php elseif ( get_row_layout() == 'annual_report' ) : ?>
				            <?php if ( have_rows( 'annual_report_list' ) ) : ?>
                                <div class="mobile-space">
                                    <div class="row">
                                            <?php while ( have_rows( 'annual_report_list' ) ) : the_row(); ?>
                                                    <div class="col-md-4 col-sm-6 col-12">
                                                            <?php 
                                                                $size = '288X411';  
                                                            ?>
                                                            <?php $image = get_sub_field( 'image' ); ?>
                                                            <?php $alt_text  = basename ( get_attached_file( $image ) );?>
                                                            <?php echo wp_get_attachment_image( $image, $size, false,array( "class" => 'w-100',"alt"=> $alt_text )); ?>
                                                            <div class="d-flex annual-report">
                                                                <?php if ( have_rows( 'file_links' ) ) : ?>
                                                                    <?php $i=1;while ( have_rows( 'file_links' ) ) : the_row(); ?>
                                                                    
                                                                        <?php $button_link = get_sub_field( 'button_link' ); ?>
                                                                        <?php if ( $button_link ) : ?>
                                                                            <h6> <a href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_link['title'] ); ?></a></h6>
                                                                        <?php endif; ?>
                                                                        <?php 
                                                                            if($i==1){
                                                                                $url = $button_link['url'];
                                                                            }
                                                                        ?>
                                                                    <?php $i++; endwhile; ?>
                                                                    <a href="<?php echo $url; ?>" target="_blank"><span class="light-grey-text icon-plus-light"></span></a>
                                                                <?php endif; ?>
                                                            </div>
                                                    </div><!--/annual report--->
                                            <?php endwhile; ?>
                                     </div>
                                </div>
                                <?php endif; ?>
                            <?php elseif ( get_row_layout() == 'content_accordion' ) : ?>                           
                                    <?php $always_open = get_sub_field( 'always_open' ); ?>
                                <?php if ( have_rows( 'accordion_list' ) ) : ?>         
                                    <div class="accordion" id="accordionContent<?php echo $contentBlock;?>">
                                        <?php $i = 1; while ( have_rows( 'accordion_list' ) ) : the_row(); ?>
                                            <div class="card">
                                                <div class="card-header" id="heading<?php echo $i; ?>">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                                data-target="#collapse<?php echo $contentBlock.$i; ?>" aria-expanded="false"
                                                                aria-controls="collapse<?php echo $contentBlock.$i; ?>">
                                                            <span class="icon-plus-light"></span>
                                                            <?php the_sub_field( 'title' ); ?>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapse<?php echo $contentBlock.$i; ?>" class="collapse" aria-labelledby="heading<?php echo $contentBlock.$i; ?>"
                                                <?php if( $always_open != 1 ) : ?>data-parent="#accordionContent<?php echo $contentBlock;?>"<?php endif; ?>>
                                                    <div class="card-body">
                                                        <?php the_sub_field( 'content' ); ?>
                                                        <?php $Link = get_sub_field( 'Link' ); ?>
                                                            <?php if ( $Link ) : ?>
                                                                <a class="text-20 btn btn--dark" href="<?php echo esc_url( $Link['url'] ); ?>" target="<?php echo esc_attr( $Link['target'] ); ?>"><?php echo esc_html( $Link['title'] ); ?></a>
                                                            <?php endif; ?>
                                                         <?php if ( get_sub_field( 'enable_inner_accordion' ) == 1 ) : ?>
                                                            <?php if ( have_rows( 'inner_content' ) ) : ?>
                                                                <?php $j=1;while ( have_rows( 'inner_content' ) ) : the_row(); ?>
                                                                    <div class="accordion" id="inner-accordionExample<?php echo $contentBlock;?>">
                                                                        <div class="card">
                                                                                <div class="card-header" id="inner-question<?php echo $j; ?>">
                                                                                    <h5 class="mb-0">
                                                                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                                                                data-target="#inner-question-collapse<?php echo $contentBlock.$i.$j; ?>" aria-expanded="false"
                                                                                                aria-controls="inner-question-collapse<?php echo $contentBlock.$i.$j; ?>">
                                                                                            <span class="icon-plus-light"></span>
                                                                                            <?php the_sub_field( 'inner_question' ); ?>
                                                                                        </button>
                                                                                    </h5>
                                                                                </div>
                                                                                <div id="inner-question-collapse<?php echo $contentBlock.$i.$j; ?>" class="collapse" aria-labelledby="inner-question<?php echo $contentBlock.$i.$j; ?>"
                                                                                    <?php if( $always_open != 1 ) : ?>data-parent="#inner-accordionExample<?php echo $contentBlock;?>"<?php endif; ?>>
                                                                                    <div class="card-body">
                                                                                        <?php the_sub_field( 'inner_answer' ); ?>
                                                                                        <?php if ( have_rows( 'super_inner_content' ) ) : ?>
                                                                                            <?php $c=1;while ( have_rows( 'super_inner_content' ) ) : the_row(); ?>
                                                                                                    <div class="accordion" id="superinner-accordionExample<?php echo $contentBlock;?>">
                                                                                                        <div class="card">
                                                                                                                <div class="card-header" id="superinner-question<?php echo $c; ?>">
                                                                                                                    <h5 class="mb-0">
                                                                                                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                                                                                                data-target="#superinner-question-collapse<?php echo $contentBlock.$i.$j.$c; ?>" aria-expanded="false"
                                                                                                                                aria-controls="superinner-question-collapse<?php echo $contentBlock.$i.$j.$c; ?>">
                                                                                                                            <span class="icon-plus-light"></span>
                                                                                                                            <?php the_sub_field( 'super_innerquestion' ); ?>
                                                                                                                        </button>
                                                                                                                    </h5>
                                                                                                                </div>
                                                                                                                <div id="superinner-question-collapse<?php echo $contentBlock.$i.$j.$c; ?>" class="collapse" aria-labelledby="superinner-question<?php echo $contentBlock.$i.$j.$c; ?>"
                                                                                                                <?php if( $always_open != 1 ) : ?>data-parent="#superinner-accordionExample<?php echo $contentBlock;?>"<?php endif; ?>>
                                                                                                                    <div class="card-body">
                                                                                                                        <?php the_sub_field( 'super_inneranswer' ); ?>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                        </div><!--/inner-card-->
                                                                                                    </div>
                                                                                            <?php $c++; endwhile; ?>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                        </div><!--/inner-card-->
                                                                    </div>
                                                                <?php $j++; endwhile; ?>
                                                            <?php endif; ?> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php $i++; endwhile; ?>
                                    </div>
                                    <!--/content accordion--->
                            <?php endif; ?>
                            <?php elseif ( get_row_layout() == 'featured_content' ) : ?>
                                <?php $title = get_sub_field( 'featured_title' ); ?>
                                <?php if ( have_rows( 'featured_content_list' ) ) : ?>
                                    <?php if($title): ?>
                                        <div class="mobile-space">
                                            <br><h3><?php echo $title; ?></h3>
                                         </div>
                                    <?php else:?>
                                        <div class="mobile-space">
                                            <br><h3>Feauture Content:</h3>
                                         </div>
                                    <?php endif;?>
                                    <div class="row featured-content-list">
                                        <?php while ( have_rows( 'featured_content_list' ) ) : the_row(); ?>
                                            <?php $feature_posts = get_sub_field( 'feature_posts' ); ?>
                                            <?php if ( $feature_posts ) : ?>
                                                <?php foreach ( $feature_posts as $post_ids ) : ?>
                                                    <div class="col-lg-6">
                                                        <a href="<?php echo get_permalink($post_ids);?>">
                                                        <div class="mx-n15 w100">
                                                            <?php $size = '447X235'; ?>
                                                            <?php  echo get_the_post_thumbnail( $post_ids, $size);?>
                                                            <a href="<?php echo get_permalink($post_ids);?>" class="d-flex our-team">
                                                                <div class="d-flex">
                                                                    <h5><?php echo get_the_title( $post_ids ); ?></h5>
                                                                    <span class="box-feat-content light-grey-text icon-plus-light"></span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                                <?php elseif ( get_row_layout() == 'video_popup' ) : ?>
                                <?php $image = get_sub_field( 'image' ); ?>
                                    <?php if ( $image ) : ?>
                                        <div class="video-block position-relative">
                                            <?php $size = 'full'; ?>
                                            <?php echo wp_get_attachment_image( $image, $size ); ?>
                                            <?php $url = get_sub_field( 'url' ); ?>
                                            <?php if ( $url ) : ?>
                                                <a href="<?php echo esc_url( $url) ; ?>" target="_blank" class="video-play-button d-inline-flex align-items-center">Watch the video <span class="icon-play align-self-stretch d-inline-flex align-items-center justify-content-center"></span></a>
                                            <?php endif; ?>
                                        </div><!--/video popup -->
                                    <?php endif; ?>
                                <?php elseif ( get_row_layout() == 'biographies' ) : ?>
                                    <?php $biography_list = get_sub_field( 'biography_list' ); ?>
                                    <div class="mobile-space">
                                        <div class="row">
                                            <?php if ( $biography_list ) : ?>
                                                <?php $size = '288X411'; ?>
                                                <?php foreach ( $biography_list as $post_ids ) : ?>
                                                    <div class="col-md-4 col-sm-6 col-12">
                                                        <?php echo get_the_post_thumbnail($post_ids, $size ); ?>
                                                        <a href="<?php echo get_permalink($post_ids);?>" class="d-flex align-items-start our-team justify-content-between px-0">
                                                            <p><?php echo get_the_title( $post_ids ); ?></p>
                                                            <span class="light-grey-text icon-plus-light"></span>
                                                        </a>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php elseif ( get_row_layout() == 'art_showcase' ) : ?>
                                            <?php if ( have_rows( 'art_selection' ) ) : ?>
                                                <div class="mt-4 art-showcase-area facilitator-boxes">
                                                        <?php while ( have_rows( 'art_selection' ) ) : the_row(); ?>
                                                            <div class="art-section"><!--art section -->
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="mobile-space">
                                                                            <h2 class="mb-0 mb-md-3"><?php the_sub_field( 'heading' ); ?></h2>
                                                                            <p><?php the_sub_field( 'note' ); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    <?php 
                                                                    $showcase_cards = get_sub_field( 'showcase_card' );
                                                                    $showcase_cards_count = count( $showcase_cards );
                                                                    $count = 1;
                                                                    if ( have_rows( 'showcase_card' ) ) : ?>
                                                                    <div class="row" data-loadmore="container">
                                                                        <?php while ( have_rows( 'showcase_card' ) ) : the_row(); ?>
                                                                            <?php $image = get_sub_field( 'image' ); ?>
                                                                            <div class="col-md-6" style="<?php if( $count > 2 ){ echo 'display:none;'; } ?>">
                                                                                    <a href="javascript:void();" class="highlight-box card-showcase general-box d-flex">
                                                                                        <div class="card-img-showcase" data-target="#faciliatorModal"  data-toggle="modal">
                                                                                            <?php $size = 'full'; ?>
                                                                                            <?php if ( $image ) : ?>
                                                                                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                                                                                            <?php endif; ?>
                                                                                            <h3> <?php the_sub_field( 'card_title' ); ?></h3>
                                                                                            <button class="btn-reset showcase-info btn-plus"><span class="icon-plus-light"></span></button>
                                                                                        </div>
                                                                                    </a>
                                                                                    <div class="facilitator-data container">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6 text-center">
                                                                                                <?php $size = 'full'; ?>
                                                                                                <?php echo wp_get_attachment_image( $image, $size,false,array( "class" => 'facil-img-2' ));?>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="sect-text">
                                                                                                    <h3><?php the_sub_field( 'card_title' ); ?></h3>
                                                                                                    <?php the_sub_field( 'card_content' ); ?>
                                                                                                    <div class="btn-area d-md-flex justify-content-between top">
                                                                                                        <?php $card_link = get_sub_field( 'card_link' ); ?>
                                                                                                        <?php if ( $card_link ) : ?>
                                                                                                            <a class="btn btn-outline-dark btn-small align-items-center 
                                                                                                            d-block d-md-inline-block
                                                                                                            mb-md-0 mb-3" href="<?php echo esc_url( $card_link['url'] ); ?>" target="<?php echo esc_attr( $card_link['target'] ); ?>"><?php echo esc_html( $card_link['title'] ); ?></a>
                                                                                                        <?php endif; ?>
                                                                                                        <?php $additional_button = get_sub_field( 'additional_button' ); ?>
                                                                                                        <?php if ( $additional_button ) : ?>
                                                                                                            <a class="btn btn-outline-dark btn-small align-items-center d-block d-md-inline-block" href="<?php echo esc_url( $additional_button['url'] ); ?>" target="<?php echo esc_attr( $additional_button['target'] ); ?>"><?php echo esc_html( $additional_button['title'] ); ?></a>
                                                                                                        <?php endif; ?>
                                                                                                    </div>
                                                                                                </div><!--/sect-text -->
                                                                                            </div>
                                                                                        </div><!--/row -->
                                                                                    </div>
                                                                                
                                                                            </div><!--/col-md-6--->
                                                                        <?php $count++; endwhile; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php if( $showcase_cards_count > 2 ): ?>
                                                                <a href="#" data-loadmore="cards" data-offset="2" data-limit="4" class="btn w-100 btn--dark btn-block d-flex justify-content-between align-items-center">
                                                                    <span>Load More</span>
                                                                    <span class="icon-plus-light"></span>
                                                                </a>
                                                                <?php endif; ?>
                                                            </div><!--/art section--->
                                                        <?php endwhile; ?>
                                                </div>
                                            <?php endif; ?>
                                <?php elseif ( get_row_layout() == 'image_card' ) : ?>
                                            <?php if ( have_rows( 'image' ) ) : ?>
                                                <div class="row">
                                                    <?php while ( have_rows( 'image' ) ) : the_row(); ?>
                                                        <div class="col-md-6">
                                                                <figure class="mb-0 pt-0">
                                                                    <?php $image = get_sub_field( 'image' ); ?>
                                                                    <?php $size = 'full'; ?>
                                                                    <?php if ( $image ) : ?>
                                                                        <?php $url = get_sub_field( 'url' ); ?>
                                                                            <?php if ( $url ) : ?>
                                                                                <a class="mx-n15 d-block" href="<?php echo esc_url( $url['url'] ); ?>" target="<?php echo esc_attr( $url['target'] ); ?>">
                                                                                    <?php echo wp_get_attachment_image( $image, $size ); ?></a>
                                                                            <?php endif; ?>
                                                                            <figcaption class="d-flex align-items-center mobile-space">
                                                                                <strong><?php echo esc_html( $url['title'] ); ?></strong>
                                                                                <a class=" ml-auto" href="#"><span class="icon-plus-light"></span></a>
                                                                            </figcaption>
                                                                    <?php endif; ?>
                                                                </figure>
                                                        </div>
                                                    <?php endwhile; ?>
                                               </div>
                                            <?php endif; ?>
                                <?php elseif ( get_row_layout() == '2_column_content' ) : ?>
                                                <?php if ( have_rows( 'add_columns' ) ) : ?>
                                                            <div class="mobile-space page-content-area">
                                                                <?php while ( have_rows( 'add_columns' ) ) : the_row(); ?>
                                                                <?php $column_width = get_sub_field( 'select_column_width_layout' ); ?>
                                                                   <?php if($column_width==2):?>
                                                                    <div class="row <?php the_sub_field('custom_class'); ?>">
                                                                        <div class="col-sm-3">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-sm-9">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php elseif($column_width==3): ?>
                                                                    <div class="row <?php the_sub_field('custom_class'); ?>">
                                                                        <div class="col-sm-9">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php elseif($column_width==4): ?>
                                                                    <div class="row <?php the_sub_field('custom_class'); ?>">
                                                                        <div class="col-sm-2">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-sm-10">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php elseif($column_width==5): ?>
                                                                    <div class="row <?php the_sub_field('custom_class'); ?>">
                                                                        <div class="col-sm-10">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php else:?>
                                                                    <div class="row <?php the_sub_field('custom_class'); ?>">
                                                                        <div class="col-sm-6">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                <?php endwhile; ?>
                                                            </div>
                                                <?php endif; ?>
                            <?php elseif ( get_row_layout() == '3_column_content' ) : ?>
                                            <?php if ( have_rows( 'add_columns' ) ) : ?>
                                                <div class="mobile-space page-content-area">
                                                    <?php while ( have_rows( 'add_columns' ) ) : the_row(); ?>
                                                    <div class="<?php the_sub_field( 'custom_class' ); ?>">
                                                        <div class="col-sm-4">
                                                            <?php the_sub_field( 'column_1' ); ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?php the_sub_field( 'column_2' ); ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?php the_sub_field( 'column_3' ); ?>
                                                        </div>
                                                    </div>
                                                    <?php endwhile; ?>
                                                </div>
                                            <?php endif; ?>
                             <?php elseif ( get_row_layout() == 'content_with_background_and_button' ) : ?>
                                             <?php $bgColor = get_sub_field( 'content_background_color' ); ?>
                                             <?php $borderColor = get_sub_field( 'border_color' ); ?>
                                            <div class="mobile-space page-content-area" style="background-color:<?php echo $bgColor;?>;padding:40px;margin-bottom:30px;border:1px solid <?php echo $borderColor; ?>">
                                                <div class="content-list-squared">
                                                   <?php the_sub_field( 'content' ); ?>
                                                </div>
                                                <?php $button_link = get_sub_field( 'button_link' ); ?>
                                                <?php if ( $button_link ) : ?>
                                                    <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="text-20 mb-4 btn btn--dark" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_link['title'] ); ?></a>
                                                <?php endif; ?>
                                            </div>
                            <?php elseif ( get_row_layout() == 'horizontal_post_list' ) : ?>
                                            <div class="mobile-space page-content-area">
                                                <?php if ( get_sub_field( 'search_from_posts' ) == 1 ) : ?>
                                                    <?php $post_list = get_sub_field( 'post_list' ); ?>
                                                    <?php if ( $post_list ) : ?>
                                                        <?php foreach ( $post_list as $post_ids ) : ?>
                                                            <div class="row">
                                                                <div class="col-sm-4 py-20">
                                                                    <?php $size = '447X235'; ?>
                                                                    <?php  echo get_the_post_thumbnail( $post_ids, $size);?>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <h6><?php echo the_title($post_ids);?></h6>
                                                                    <?php echo get_the_excerpt($post_ids);?>
                                                                    <br><br>
                                                                    <a href="<?php echo get_permalink( $post_ids ); ?>" class="text-20 mb-4 btn btn--dark">Learn More</a>
                                                                   
                                                                </div>
                                                            </div>
                                                            <br>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if ( have_rows( 'post_entry' ) ) : ?>
                                                        <?php while ( have_rows( 'post_entry' ) ) : the_row(); ?>
                                                            <div class="row">
                                                                <div class="col-sm-4 py-20">
                                                                    <?php $image = get_sub_field( 'image' ); ?>
                                                                    <?php $size = 'full'; ?>
                                                                    <?php if ( $image ) : ?>
                                                                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <h5><?php the_sub_field( 'title' ); ?></h5>
                                                                    <?php the_sub_field( 'content' ); ?>
                                                                    <?php $button = get_sub_field( 'button' ); ?>
                                                                    <?php if ( $button ) : ?>
                                                                        <a href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>" class="text-20 mb-4 btn btn--dark"><?php echo esc_html( $button['title'] ); ?></a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                            <?php elseif( get_row_layout() == 'link_blocks' ): ?>
                                            <div class="useful-links-section <?php echo esc_attr( get_sub_field('custom_classes') ); ?>">
                                                <div class="row gutter-22">
                                                    <?php if ( have_rows( 'links' ) ) : ?>
                                                        <?php while ( have_rows( 'links' ) ) : the_row(); ?>
                                                            <?php $links = get_sub_field( 'link' ); ?>
                                                            <?php if ( $links ) : ?>
                                                                <div class="col-lg-4 col-6 d-flex mb-3">
                                                                    <a href="<?php echo esc_url( $links['url'] ); ?>"><?php echo esc_html( $links['title'] ); ?></a>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endwhile; ?>
                                                    <?php else : ?>
                                                        <?php // no rows found ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                             <?php elseif ( get_row_layout() == 'document_list' ) : ?>
                                <br><h3><?php the_sub_field( 'heading_title' ); ?></h3><br>
                                    <?php if ( have_rows( 'documents' ) ) : ?>
                                        <div class="row" id="results-area">
                                            <?php while ( have_rows( 'documents' ) ) : the_row(); ?>
                                                <?php $document_name = get_sub_field( 'document_name' ); ?>
                                                <?php $document_link = get_sub_field( 'document_link' ); ?>
                                                <div class="col-lg 12 col-xl-6">
                                                    <div class="document-box d-flex">
                                                        <div class="doc-img d-flex justify-content-center align-items-center"> <?php the_sub_field( 'file_format' ); ?></div>
                                                            <div class="document-info">
                                                            <?php if ( get_sub_field( 'add_title_manually' ) == 1 ) : ?>
                                                                <h4><a href="<?php echo esc_url( $document_link['url'] ); ?>" download><?php the_sub_field( 'document_title' ); ?></a></h4>
                                                            <?php else:?>
                                                                <h4><a href="<?php echo esc_url( $document_link['url'] ); ?>" download><?php echo get_the_title( $document_name ); ?></a></h4>
                                                            <?php endif; ?>
                                                                <div class="links-group d-flex">
                                                                <a href="<?php echo esc_url( $document_link['url'] ); ?>" target="<?php echo esc_attr( $document_link['target'] ); ?>" download>Download</a>
                                                                <a href="<?php echo esc_url( $document_link['url'] ); ?>" target="_blank">Print</a>
                                                                <a class="ml-auto" href="<?php echo esc_url( $document_link['url'] ); ?>" target="<?php echo esc_attr( $document_link['target'] ); ?>">
                                                                <span class="icon-plus-light"></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>       
                                        </div>
                                     <?php endif; ?>   
                                <?php endif; ?>
                    <?php $contentBlock++; endwhile; ?>
                    <?php endif; ?><!--/endif left content-->
                </div>
            </div>
            <?php if ( get_field( 'enable_wider_sidebar_and_smaller_content' ) == 1 ) : ?>
              <div class="col-lg-6 col-xl-5 d-none d-lg-block">
            <?php else : ?>
              <div class="col-lg-5 col-xl-4 d-none d-lg-block">
	        <?php endif; ?>
                <?php if ( have_rows( 'sidebar_blocks' ) ): ?>
                    <?php if ( get_field( 'enable_wider_sidebar_and_smaller_content' ) == 1 ) : ?>
                    <div class="right-sidebar wider-sidebar push-top-<?php echo $marginTop;?>">
                    <?php else : ?>
                        <div class="right-sidebar push-top-<?php echo $marginTop;?>">
                    <?php endif; ?>
                    <?php if($categoryName =='Speeches and Opinions'):?>
                        <div class="placement-aside mb-4 page-content-area">
                            <div class="sidebar-block--content pb-4">
                                <div class="content-list-squared">
                                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Media Enquiries") ) : ?><?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
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
                                                        <h6><?php echo get_the_date( 'd M, Y', $post_ids );?></h6>
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
                                                    $tagname = wp_get_post_terms($post->ID,'funding_type', array( 'fields' => 'names'))[0];                                                   
                                                ?>
                                                <div class="placement-aside mt-4 page-content-area clone-to-mobile-sidebar">
                                                    <?php if ( get_sub_field( 'show_tag_info' ) == 1 ) :  ?>
                                                        <?php if ( get_sub_field( 'manual_tag_selection' ) == 1 ) : ?>
                                                            <?php $taxonomy = get_sub_field( 'taxonomy' ); ?>
                                                            <?php $term = get_term_by( 'id', $taxonomy, 'funding_type' ); ?>
                                                            <?php if ( $term ) : ?>
                                                                <a href="<?php echo get_home_url()."/investment-and-development/?funding_type=". urlencode(esc_html( $term->name )); ?>" class="btn btn-black btn-sm mb-4"><?php echo esc_html( $term->name ); ?></a>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <?php if($tagname):?>
                                                                <a href="<?php echo get_home_url()."/investment-and-development/?funding_type=". urlencode($tagname); ?>" class="btn btn-black btn-sm mb-4"><?php echo $tagname;?></a>
                                                            <?php endif; ?>
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
                                            </div><!--/post list with image-->
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
        </div><!--/row-->
    </div>
</section>
