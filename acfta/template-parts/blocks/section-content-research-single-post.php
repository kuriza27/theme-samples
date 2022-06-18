<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-content-research-single-post.php
 *
 * Research Single Post Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'research-single-post-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-research-single-post-content';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

?>
<?php if ( get_field( 'enable_sticky_research_header_navigation_' ) == 1 ) : ?>
<header id="top-header" class="header bg-dark hidden">
    <div class="position-absolute w-100 bg-dark">
            <div class="sticky-menu">
                <?php if ( !isset($_COOKIE['covid_alert']) and get_field( 'show_notification_bar', 'option' ) == 1 ) : ?>
                   <div class="alert alert-covid alert-primary alert-dismissible fade show" role="alert">
                    <div class="container position-relative d-flex align-items-center">
                        <span class="i-icon flex-shrink-0 align-self-start">i</span>
                            <span><?php the_field( 'notification_bar', 'option' ); ?></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><span class="icon-cancel"></span></span>
                            </button>
                        </div>
                    </div>
				<?php endif; ?>
                <div class="container text-white">
                    <div class="row align-items-lg-end align-items-center justify-content-between">
                        <div class="col-auto d-lg-none">
                            <button class="btn-reset header-search"><span class="icon-search"></span></button>
                        </div>
                        <div class="col col-lg-auto">
                            <a class="logo" href="<?php echo site_url(); ?>">
                                <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2021/06/ACA_LOGOHORZ_REV-Converted.svg" width="350" height="auto" class="attachment-full size-full" alt="" loading="lazy">     
                            </a>
                        </div>
                        <div class="col-auto order-xl-2">
                            <button class="btn-reset header-search d-none d-lg-inline"><span class="icon-search"></span>
                            </button>
                            <button class="btn-reset menu-toggle"><span class="icon-menu"></span></button>
                        </div>
                        <div class="col-12 col-lg d-none d-xl-block nav-container">
                            <nav class="header-nav alt pt-80">
                                <?php 
                                    wp_nav_menu( array(
                                        'menu'        => 'Header Menu',
                                        'container'   => false,
                                        'depth' => 1,
                                        'menu_class'  => 'list-unstyled d-flex align-items-end justify-content-between justify-content-xl-end',
                                        'walker'      => new main_menu_Walker(),
                                    ) );
                                ?>  
                            </nav>
                        </div>
                    </div>
                     <?php do_action("acfta_mega_menu") ?>
                    
                </div>
            </div>
            <?php if ( have_rows( 'research_single_post_content' ) ): ?>
                <?php while ( have_rows( 'research_single_post_content' ) ) : the_row(); ?>
                    <?php if ( get_row_layout() == 'navigation' ) : ?>
                    <div class="breadcrumb-container-nav light mt-4">
                        <div class="container">
                            <nav aria-label="">
                                <ol class="research-nav-link">
                                    <li class="breadcrumb-item"><strong>Navigate to:</strong></li>
                                    <?php while ( have_rows( 'navigation_links' ) ) : the_row(); ?>
                                    <?php $links = get_sub_field( 'links' ); ?>
                                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo esc_url( $links['url'] ); ?>"><?php echo esc_html( $links['title'] ); ?></a></li>
                                    <?php endwhile; ?>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
    </div>
</header>
<?php endif; ?>
<section class="research-single-page-section <?php echo esc_attr( $classes ); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-xl-8">
                          <div class="page-single-content content-list-squared">
                            <?php if ( have_rows( 'research_single_post_content' ) ): ?>
                                <?php while ( have_rows( 'research_single_post_content' ) ) : the_row(); ?>
                                    <?php if ( get_row_layout() == 'navigation' ) : ?>
                                            <?php if ( have_rows( 'navigation_links' ) ) : ?>
                                                <div class="single-page-nav" id="singlePageNav">
                                                    <span>Navigate to:</span>
                                                <?php while ( have_rows( 'navigation_links' ) ) : the_row(); ?>
                                                    <?php $links = get_sub_field( 'links' ); ?>
                                                    <?php if ( $links ) : ?>
                                                        <a href="<?php echo esc_url( $links['url'] ); ?>" aria-current="page" target="<?php echo esc_attr( $links['target'] ); ?>"><?php echo esc_html( $links['title'] ); ?></a>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                                </div>
                                            <?php endif; ?><!--/navigation links--->
                                        <?php elseif ( get_row_layout() == 'content' ) : ?>
                                            <div class="mobile-space">
                                                <?php the_sub_field( 'content' ); ?>
                                            </div>
                                        <?php elseif ( get_row_layout() == 'research_webinar_content' ) : ?>
                                                <div class=" <?php the_sub_field( 'background_color' ); ?> research-webinar">
                                                    <div class="research-webinar-content">
                                                        <h4> <?php the_sub_field( 'title' ); ?></h4>
                                                        <br><?php the_sub_field( 'content' ); ?>
                                                        <div class="d-flex">
                                                            <div class="webinar-details">
                                                                <?php if( get_sub_field( 'date' ) ): ?>
                                                                <b> Date </b><br>
                                                                <?php the_sub_field( 'date' ); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="webinar-details">
                                                                <?php if( get_sub_field( 'time' ) ): ?>
                                                                <b> Time</b><br>
                                                                <?php the_sub_field( 'time' ); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="webinar-details">
                                                                <?php $button_link = get_sub_field( 'button_link' ); ?>
                                                                <?php if ( $button_link ) : ?>
                                                                    <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="btn btn--dark "><?php echo esc_html( $button_link['title'] ); ?></a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div><!-- /research webinar content-->
                                                    <div class="upcoming-webinars">
                                                        <div class="research-webinar-content">
                                                            <?php $previous_webinar_link = get_sub_field( 'previous_webinar_link' ); ?>
                                                            <?php if ( $previous_webinar_link ) : ?>
                                                                <p class="mb-0"><a href="<?php echo esc_url( $previous_webinar_link['url'] ); ?>"><span class="icon-plus-light"></span></a> <?php echo esc_html( $previous_webinar_link['title'] ); ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div><!-- /bg-light-pink research webinar -->
                                    <?php elseif ( get_row_layout() == 'key_finding_section' ) : ?>
                                                    <div id="key-findings"></div>
                                                    <div class="mobile-space">
                                                                <h2 class="mb-4"><?php the_sub_field( 'heading' ); ?></h2>
                                                                <?php the_sub_field( 'finding_content' ); ?>
                                                                <br>
                                                    </div>
                                    <?php elseif ( get_row_layout() == 'key_finding_section' ) : ?>
                                                    <div id="key-findings"></div>
                                                    <div class="mobile-space">
                                                                <h2 class="mb-4"><?php the_sub_field( 'heading' ); ?></h2>
                                                                <?php the_sub_field( 'finding_content' ); ?>
                                                    </div>
                                    <?php elseif ( get_row_layout() == 'image_block_with_caption' ) : ?>
                                                <?php $image = get_sub_field( 'image' ); ?>
                                                <?php if ( $image ) : ?>
                                                    <div class="img-content">
                                                        <p class="ml-n3 mr-n3 ml-sm-0 mr-sm-0">
                                                            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                                                        </p>
                                                        <p class="text-align-right">
                                                            <span class="light-grey-text">
                                                            <?php the_sub_field( 'caption' ); ?>
                                                            </span>
                                                        </p>
                                                        <br class="d-none d-lg-inline"> <br>
                                                    </div>
                                                    <?php endif; ?>
                                    <?php elseif ( get_row_layout() == 'about_the_study_section' ) : ?>
                                                <div id="about-the-study"> </div>
                                                <div class="mobile-space">
                                                    <h2 class="mb-4">  <?php the_sub_field( 'heading_title' ); ?></h2>
                                                    <br class="d-none d-lg-inline">
                                                        <?php the_sub_field( 'content' ); ?>
                                                    <br class="d-none d-lg-inline"> <br >
                                                </div>
                                    <?php elseif ( get_row_layout() == 'partners_section' ) : ?>
                                                <?php if ( have_rows( 'partners' ) ) : ?>
                                                    <div id="partners"> </div>
                                                    <?php while ( have_rows( 'partners' ) ) : the_row(); ?>
                                                    <h2 class="mb-4 mobile-space"> <?php the_sub_field( 'heading' ); ?></h2>
                                                        <div class="row no-gutters">
                                                            <?php if ( have_rows( 'images' ) ) : ?>
                                                                <?php while ( have_rows( 'images' ) ) : the_row(); ?>
                                                                    <?php $image = get_sub_field( 'image' ); ?>
                                                                    <?php if ( $image ) : ?>
                                                                        <?php $image_link = get_sub_field( 'image_link' ); ?>
                                                                        <?php if ( $image_link ) : ?>
                                                                            <div class="col-sm-6 col-12 bordered-box text-align-center flex-wrap d-flex py-70 ">
                                                                               <a href="<?php echo esc_url( $image_link['url'] ); ?>" target="<?php echo esc_attr( $image_link['target'] ); ?>" class="col-sm-6 col-12 text-align-center flex-wrap d-flex">
                                                                                <img class="w250_h130" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                                                                              </a>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="col-sm-6 col-12 py-70 bordered-box text-align-center flex-wrap d-flex">
                                                                                <img class="w250_h130" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        
                                                                    <?php endif; ?>
                                                                <?php endwhile; ?>
                                                            <?php endif; ?>
                                                         </div>
                                                         <br><br>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                    <?php elseif ( get_row_layout() == 'participants_section' ) : ?>
                                        <?php $title = get_sub_field( 'heading_title' ); ?>
                                                <?php if ( have_rows( 'participants' ) ) : ?>
                                                    <div id="participants"></div>
                                                    <div class="mobile-space">
                                                        <h2 class="mb-lg-5"><?php echo $title; ?></h2>
                                                        <div class="row">
                                                            <?php while ( have_rows( 'participants' ) ) : the_row(); ?>
                                                                <div class="col-sm">
                                                                     <?php the_sub_field( 'list' ); ?>
                                                                </div>
                                                            <?php endwhile; ?>
                                                        </div>
                                                     </div>
                                                <?php endif; ?>
                                        <?php elseif ( get_row_layout() == 'content_with_background_options' ) : ?>
                                                   <?php $bgColor = get_sub_field( 'background_color' ); ?>
                                                    <?php $column = get_sub_field( 'select_content_column' ); ?>
                                                    <div class="container" style="background-color:<?php echo $bgColor;?>" class="<?php the_sub_field( 'add_class_option' ); ?>">
                                                        <div class="row justify-content-center justify-content-lg-start ">
                                                                <?php if( $column == 1 ): ?>
                                                            <div class="col-12">
                                                                <div class="column-content-wrap">
                                                                    <?php the_sub_field( 'column_1_1' ); ?>
                                                                </div>
                                                             </div>
                                                            <?php elseif( $column == 2 ): ?>
                                                                   <div class="col-md-6">
                                                                      <div class="column-content-wrap">
                                                                           <?php the_sub_field( 'column_1_2' ); ?>
                                                                       </div>
                                                                    </div>
                                                               <div class="col-md-6">
                                                              <div class="column-content-wrap">
                                                                 <?php the_sub_field( 'column_2_2' ); ?>
                                                             </div>
                                                         </div>
                                                      <?php endif; ?>
                                                 </div><!--/row-->
                                             </div><!--/container-->
                                        <?php elseif ( get_row_layout() == 'button' ) : ?>
                                            <?php $button_link = get_sub_field( 'button_link' ); ?>
                                            <?php if ( $button_link ) : ?>
                                                <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="text-20 btn btn--dark" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_link['title'] ); ?></a>
                                            <?php endif; ?>
                                    <?php endif; ?><!--/endif-->
                            <?php endwhile; ?>
                        <?php endif; ?>
                        </div>
                        </div><!---/col-->
                        <div class="col-lg-3 col-xl-4 d-none d-lg-block">
                            <div class="right-sidebar push-top-lg resources-sidebar-column">
                             <?php $image = get_field( 'image' ); ?>
                             <?php $image_link = get_field( 'image_link' ); ?>
                             <?php $size = '350x600'; ?>       
                             <?php if($image || get_field( 'heading' ) || have_rows( 'links' ) || get_field( 'content_option' )):?>                           
                                <div class="placement-aside sidebar-simple-text pb-5 research-img-area">
                                    <?php if( get_field( 'heading' ) != '' ): ?>
                                    <h3><?php the_field( 'heading' ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( $image ) : ?>
                                        <?php if( $image_link ): ?>
                                            <a href="<?php echo esc_url( $image_link) ; ?>">
                                        <?php endif; ?>
                                        <?php echo wp_get_attachment_image( $image, $size, false, array( "class" => 'h-auto' ) ); ?>
                                        <?php if( $image_link ): ?>
                                            </a>
                                        <?php endif; ?>                                    
                                    <?php endif; ?>
                                    <?php if ( get_field( 'remove_links' ) != 1 ) : ?>
                                    <?php if ( have_rows( 'links' ) ) : ?>
                                        <ul class="list-unstyled sidebar-list">
                                                 <h6 class="light-grey-text mt-2 text-14">Important Links</h6>
                                        <?php while ( have_rows( 'links' ) ) : the_row(); ?>
                                            <?php $link = get_sub_field( 'link' ); ?>
                                            <?php if ( $link ) : ?>
                                                <li>
                                                <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                        <li>
                                            <div class="col-lg">
                                                <?php $learn_more_link = get_field( 'learn_more_link' ); ?>
                                                <?php if ( $learn_more_link ) : ?>
                                                    <a class="btn btn--dark btn-block" href="<?php echo esc_url( $learn_more_link['url'] ); ?>" target="<?php echo esc_attr( $learn_more_link['target'] ); ?>"><?php echo esc_html( $learn_more_link['title'] ); ?></a>
                                                <?php endif; ?>
                                             </div>
                                        </li>
                                        </ul>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ( have_rows( 'resources' ) ): ?>
                                        <div class="sidebar--resources">
                                        <?php while ( have_rows( 'resources' ) ) : the_row(); ?>
                                            <div class="sidebar--resources__block">
                                            <?php if ( get_row_layout() == 'resources_block' ) : ?>
                                                <div class="sidebar--resources__title">
                                                    <?php if( get_sub_field( 'url' ) ): ?><a href="<?php the_sub_field( 'url' ); ?>"><?php endif; ?>
                                                    <span><?php the_sub_field( 'title' ); ?></span>
                                                    <?php if( get_sub_field( 'url' ) ): ?></a><?php endif; ?>
                                                </div>
                                                <?php if ( have_rows( 'resource_files' ) ) : ?>
                                                <div class="sidebar--resources__files">
                                                    <?php while ( have_rows( 'resource_files' ) ) : the_row(); ?>
                                                    <div class="sidebar--resources__file"><a href="<?php the_sub_field( 'file' ); ?>"><span class="icon-download"></span><span class="file-text"><?php the_sub_field( 'title' ); ?></span></a></div>
                                                    <?php endwhile; ?>
                                                </div>
                                                <?php else : ?>
                                                    <?php // no rows found ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( get_field( 'content_option' ) != '' ): ?>
                                    <div class="mobile-space">
                                        <?php the_field( 'content_option' ); ?>
                                    </div>
                                    <?php endif; ?>
                                </div><!-- /placement sidebar -->
                                <?php endif; ?>
                            </div>
                            <!-- /right sidebar -->
                        </div>
                    </div><!-- /row -->
                </div>
            </section>





