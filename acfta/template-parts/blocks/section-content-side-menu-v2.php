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
$classes = 'block-content-side-menu-v2';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$categoryName ="";
$categories = get_the_category();

if($categories){
    $categoryName = $categories[0]->name;
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> pb-5">
    <div class="container">
        <div class="row">
        <?php if ( get_field( 'enable_border_right' ) == 1 ) : ?>
            <div class="col-lg-7 col-xl-8 border-right">
        <?php else : ?>
            <div class="col-lg-7 col-xl-8">
        <?php endif; ?>
            <div class="page-single-content  content-list-squared">
                <?php if ( have_rows( 'content_blocks' ) ): ?>
                    <?php $contentBlock=1; while ( have_rows( 'content_blocks' ) ) : the_row(); ?>
                         <?php if ( get_row_layout() == 'heading_and_social_media' ) : ?>
                                <div class="mx-n15 d-lg-none">
                                    <?php $mobile_image_banner = get_sub_field( 'mobile_image_banner' ); ?>
                                        <?php $size = 'full'; ?>
                                        <?php if ( $mobile_image_banner ) : ?>
                                            <?php echo wp_get_attachment_image( $mobile_image_banner, $size ); ?>
                                        <?php endif; ?>
                                </div>
                                <div class="mobile-space">
                                    <div class="d-flex flex-column flex-lg-row justify-content-between">
                                        <h3 class="my-4 my-lg-0"><?php the_sub_field( 'heading_title' ); ?></h3>
                                        <?php the_sub_field( 'social_media_content' ); ?>
                                    </div>
                                    <br class="d-none d-lg-inline">
                                </div>
                        <?php elseif ( get_row_layout() == 'content_block' ) : ?>
                            <div class="mobile-space page-content-area <?php the_sub_field( 'custom_classes' ); ?> content-list-squared">
                                <?php the_sub_field( 'content' ); ?>
                            </div>
                        <?php elseif ( get_row_layout() == 'image_with_caption' ) : ?>
                            <figure class="mb-0">
                                <?php $image = get_sub_field( 'image' ); ?>
                                <?php $size = 'full'; ?>
                                <?php if ( $image ) : ?>
                                    <?php echo wp_get_attachment_image( $image, $size ); ?>
                                <?php endif; ?>
                                <figcaption class="text-right"><?php the_sub_field( 'caption' ); ?></figcaption>
                            </figure>
                        <?php elseif ( get_row_layout() == 'buttons_block' ) : ?>
                            <?php if ( have_rows( 'buttons' ) ) : ?>
                                <div class="row">
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
                            <?php elseif ( get_row_layout() == 'pdf_list' ) : ?>
                                <?php if ( have_rows( 'pdf_list' ) ) : ?>
                                    <div class="mobile-space">
                                        <div class="row">
                                            <?php while ( have_rows( 'pdf_list' ) ) : the_row(); ?>
                                            <div class="col-md-4 col-sm-6 col-12">
                                                <?php $image = get_sub_field( 'image' ); ?>
                                                <?php $pdftitle = get_sub_field( 'pdf_title' ); ?>
                                                <?php $pdfcategory = get_sub_field( 'pdf_category' ); ?>
                                                <?php $size = 'full'; ?>
                                                <?php if ( $image ) : ?>
                                                    <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"  class="w-100"/>
                                                <?php endif; ?>
                                                    <div class="d-flex annual-report">
                                                        <h6>
                                                            <?php if ( $pdftitle ) : ?>
                                                            <a href="<?php the_sub_field( 'pdf_link' ); ?>"><?php the_sub_field( 'pdf_title' ); ?></a>
                                                            <?php endif; ?>
                                                            <?php if ( $pdfcategory ) : ?>
                                                            <a href="<?php the_sub_field( 'pdf_link' ); ?>"><?php the_sub_field( 'pdf_category' ); ?></a>
                                                            <?php endif; ?>
                                                        </h6>
                                                        <a href="<?php the_sub_field( 'pdf_link' ); ?>"><span class="light-grey-text icon-plus-light"></span></a>
                                                    </div>
                                            </div>
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
                                                                                            <?php the_sub_field( 'question' ); ?>
                                                                                        </button>
                                                                                    </h5>
                                                                                </div>
                                                                                <div id="inner-question-collapse<?php echo $contentBlock.$i.$j; ?>" class="collapse" aria-labelledby="inner-question<?php echo $contentBlock.$i.$j; ?>"
                                                                                <?php if( $always_open != 1 ) : ?>data-parent="#inner-accordionExample<?php echo $contentBlock;?>"<?php endif; ?>>
                                                                                    <div class="card-body">
                                                                                        <?php the_sub_field( 'answer' ); ?>
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
                                <div class="mobile-space">
                                     <br><h3><?php the_sub_field( 'heading_title_v2' ); ?></h3>
                                </div>
                                <?php if ( have_rows( 'featured_content_list' ) ) : ?>
                                    <div class="row">
                                        <?php while ( have_rows( 'featured_content_list' ) ) : the_row(); ?>
                                            <?php $feature_posts = get_sub_field( 'feature_posts' ); ?>
                                            <?php if ( $feature_posts ) : ?>
                                                <?php foreach ( $feature_posts as $post_ids ) : ?>
                                                    <div class="col-lg-6">
                                                        <div class="mx-n15 w100">
                                                            <?php $size = '447X235'; ?>
                                                            <?php  echo get_the_post_thumbnail( $post_ids, $size);?>
                                                            <div class="d-flex our-team px-45">
                                                                <h5><?php echo get_the_title( $post_ids ); ?></h5>
                                                                <p><a href="<?php echo get_permalink($post_ids) ;?>" target="_blank">    <span class="light-grey-text icon-plus-light"></span></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            <?php elseif ( get_row_layout() == 'form' ) : ?>
                                    <?php $forms = get_sub_field( 'forms' ); ?>
                                    <?php if ( $forms ) : ?>
                                            <div class="form-wrap">
                                                <?php gravity_form( $forms, false, false, null, true, 1, true ); ?>
                                            </div>
                                    <?php endif; ?>
                            <?php elseif ( get_row_layout() == 'art_showcase' ) : ?>
                                            <?php if ( have_rows( 'art_selection' ) ) : ?>
                                                <div class="py-40 art-showcase-area facilitator-boxes">
                                                        <?php while ( have_rows( 'art_selection' ) ) : the_row(); ?>
                                                            <div class="art-section"><!--art section--->
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="mobile-space">
                                                                            <h2 class="mb-0 mb-md-3"><?php the_sub_field( 'heading' ); ?></h2>
                                                                            <p><?php the_sub_field( 'note' ); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <?php if ( have_rows( 'showcase_card' ) ) : ?>
                                                                        <?php while ( have_rows( 'showcase_card' ) ) : the_row(); ?>
                                                                            <?php $image = get_sub_field( 'card_image' ); ?>
                                                                            <div class="col-md-6">
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
                                                                                                    <div>
                                                                                                    <?php $card_link = get_sub_field( 'card_link' ); ?>
                                                                                                        <?php if ( $card_link ) : ?>
                                                                                                            <a class="btn btn-outline-dark btn-small align-items-center d-lg-inline-block" href="<?php echo esc_url( $card_link['url'] ); ?>" target="<?php echo esc_attr( $card_link['target'] ); ?>"><?php echo esc_html( $card_link['title'] ); ?></a>
                                                                                                        <?php endif; ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                
                                                                            </div><!--/col-md-6--->
                                                                        <?php endwhile; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div><!--/art section--->
                                                     <?php endwhile; ?>
                                                </div>
                                        <?php endif; ?>
                            <?php elseif ( get_row_layout() == '2_column_content' ) : ?>
                                                <?php if ( have_rows( 'add_columns' ) ) : ?>
                                                                <?php while ( have_rows( 'add_columns' ) ) : the_row(); ?>
                                                                <?php $column_width = get_sub_field( 'select_column_width_layout' ); ?>
                                                                   <?php if($column_width==2):?>
                                                                    <div class="row <?php the_sub_field( 'custom_classes' ); ?>">
                                                                        <div class="col-xl-3 col-md-5">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-xl-9 col-md-7">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php elseif($column_width==3): ?>
                                                                    <div class="row <?php the_sub_field( 'custom_classes' ); ?>">
                                                                        <div class="col-xl-9 col-md-7">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-xl-3 col-md-5">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php elseif($column_width==4): ?>
                                                                    <div class="row <?php the_sub_field( 'custom_classes' ); ?>">
                                                                        <div class="col-xl-2 col-md-4">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-xl-10 col-md-8">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php elseif($column_width==5): ?>
                                                                    <div class="row <?php the_sub_field( 'custom_classes' ); ?>">
                                                                        <div class="col-xl-10 col-md-8">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-xl-2 col-md-4">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php else:?>
                                                                    <div class="row <?php the_sub_field( 'custom_classes' ); ?>">
                                                                        <div class="col-md-6">
                                                                            <?php the_sub_field( 'column_left' ); ?>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <?php the_sub_field( 'column_right' ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                <?php endwhile; ?>
                                                <?php endif; ?>
                            <?php elseif ( get_row_layout() == '3_column_content' ) : ?>
                                        <?php if ( have_rows( 'add_columns' ) ) : ?>
                                                <?php while ( have_rows( 'add_columns' ) ) : the_row(); ?>
                                                <div class="row <?php the_sub_field( 'custom_classes' ); ?>">
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
                                        <?php endif; ?>
                            <?php elseif ( get_row_layout() == 'content_with_background_and_button' ) : ?>
                                             <?php $bgColor = get_sub_field( 'content_background_color' ); ?>
                                            <div class="mobile-space page-content-area" style="background-color:<?php echo $bgColor;?>;padding:40px;margin-bottom:30px;">
                                                <?php the_sub_field( 'content' ); ?>
                                                <?php $button_link = get_sub_field( 'button_link' ); ?>
                                                <?php if ( $button_link ) : ?>
                                                    <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="text-20 mb-4 btn btn--dark" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_link['title'] ); ?></a>
                                                <?php endif; ?>
                                             </div>
                            <?php elseif ( get_row_layout() == 'contact_form_salesforce' ) : ?>
                                <?php include 'contact-form-salesforce.php';?>
                        <?php endif; ?>
                    <?php $contentBlock++;endwhile; ?><!--/content-blocks-->
                <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4 d-none d-lg-block">
                <?php if ( have_rows( 'sidebar_blocks' ) ): ?>
                    <div class="right-sidebar push-top-md">
                    <?php if($categoryName =='Biographies'):?>
                        <div class="placement-aside mb-4 page-content-area">
                            <div class="sidebar-block--content pb-4">
                                <div class="content-list-squared">
                                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("contact-media-enquiries") ) : ?><?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                        <?php while ( have_rows( 'sidebar_blocks' ) ) : the_row(); ?>
                            <?php if ( get_row_layout() == 'content' ) : ?>
                              <div class="placement-aside mb-4 page-content-area pb-5 content-list-squared">
                                    <?php the_sub_field( 'content' ); ?>
                              </div>
                            <?php elseif ( get_row_layout() == 'recent_post' ) : ?>
                                <?php $recent = get_sub_field( 'recent' ); ?>
                                <?php if ( $recent ) : ?>
                                    <div class="placement-aside mb-4 sidebar-simple-text">
                                        <h3><?php the_sub_field( 'heading' ); ?></h3>
                                        <ul class="list-unstyled sidebar-list text-18">
                                            <?php foreach ( $recent as $post_ids ) : ?>
                                                <li data-post-type="<?php echo get_post_type($post_ids); ?>" data-post-id="<?php echo $post_ids?>">
                                                    <a href="<?php echo get_permalink( $post_ids ); ?>">
                                                        <h6><?php echo get_the_date( 'd M, Y', $post_ids );?></h6>
                                                        <h4> <?php echo get_the_title( $post_ids ); ?></h4>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                            <li class="button-container">
                                            <a href="#" class="btn w-100 btn--dark btn-block d-flex justify-content-between align-items-center load-more-speech-btn">
                                                <span>Load More</span>
                                                <span class="icon-plus-light"></span>
                                            </a>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <?php elseif ( get_row_layout() == 'social_media_info' ) : ?>
                                    <div class="placement-aside mb-4 sidebar-simple-text">
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
                                    <?php elseif ( get_row_layout() == 'events' ) : ?>
				                        <?php $events = get_sub_field( 'events' ); ?>
                                            <div class="events-aside <?php echo esc_attr( $classes ); ?> mb-4">
                                                <div class="row align-items-baseline">
                                                    <div class="col">
                                                        <h2 class="mb-4">Latest Events</h2>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button id="slPrev" class="sl-arrow"><span class="icon-left"></span></button>
                                                        <button id="slNext" class="sl-arrow"><span class="icon-right"></span></button>
                                                    </div>
                                                </div>
                                                <div class="events-slider js-events-slider">
                                                    <?php if ( $events ) : ?>
                                                        <?php foreach ( $events as $post_ids ) : ?>
                                                            <div class="sl">
                                                                <?php $size = '447X235'; ?>
                                                                <?php  echo get_the_post_thumbnail( $post_ids, $size,array( 'class' => 'event-thumb' ));?>
                                                                <h4><?php echo get_the_title( $post_ids ); ?></h4>
                                                                <a href="<?php echo get_permalink( $post_ids ); ?>" class="event-link"><span class="icon-plus-light"></span></a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php elseif ( get_row_layout() == 'contact_info' ) : ?>
                                            <div class="contact-aside py-40 mb-4">
                                                <h2 class="mb-4"><?php the_sub_field( 'contact_heading' ); ?></h2>
                                                <div class="">
                                                    <?php the_sub_field( 'contact_info' ); ?>
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
                                <?php endif; ?><!--/endif--->
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div><!--/row-->
    </div>
</section>
