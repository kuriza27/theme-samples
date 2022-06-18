<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-digital-events.php
 *
 * Digital Events Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'digital-events-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-digital-events-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

?>
<section class="<?php echo esc_attr( $classes ); ?> digital-events-section">
<div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <h1><?php the_field( 'heading' ); ?></h1>
                        </div>
                    </div>
                </div>
<div class="container-fluid">
            <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
	                        <?php $button = get_field( 'button' ); ?>
                            <?php if($button):?>
                            <a href="<?php echo esc_url( $button['url'] ); ?>" class="event-box md funding-section-content flex-column justify-content-center align-items-start d-flex mb-0 h-auto-m">
                            <?php else: ?>
                            <a href="#" class="event-box md funding-section-content flex-column justify-content-center align-items-start d-flex mb-0 h-auto-m"> 
                            <?php endif; ?>   
                               <div class="">
                                    <h2><?php the_field( 'latest_heading' ); ?></h2>
                                    <?php the_field( 'content' ); ?>
                                    <?php $button = get_field( 'button' ); ?>
                                    <?php if ( $button ) : ?>
                                        <span class="btn btn-white"><?php echo esc_html( $button['title'] ); ?></span>
                                    <?php endif; ?>
                                    
                                </div>
                            </a>
                        </div>
                        <?php $news_and_events = get_field( 'news_and_events' ); ?>
                        <?php if ( $news_and_events ) : 
                            $count = 0;     ?>
                            <?php foreach ( $news_and_events as $post_ids ) : ?>
                               <?php 
                                if($count < 2){
                                ?>
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <a href="<?php echo esc_url( get_permalink($post_ids) ); ?>" class="event-box md d-flex">
                                        <?php $size = 'full'; ?>
                                        <?php echo  get_the_post_thumbnail($post_ids,$size); ?>
                                        <?php 
                                            $post_type = get_post_type($post_ids);
                                            $chars = array("-", "_");
                                            $cat = get_the_terms($post_ids, 'category')[0];

                                            $category_name = $cat->name;
                                            $badgeColor ="";
                                            if($category_name=="Media Release"){
                                                $badgeColor = "badge-blue";
                                            }
                                            if($category_name=="Stories"){
                                                $badgeColor = "badge-green";
                                            }
                                            if($category_name=="Speeches and Opinions"){
                                                $badgeColor = "badge-purple";
                                            }
                                            if($category_name=="Biographies"){
                                                $badgeColor = "badge-orange";
                                            }
                                        ?>
                                        <div class="event-info">
                                            <span class="badge <?php echo $badgeColor;?>"><?php echo $cat->name; ?></span>
                                            <h2><?php echo get_the_title( $post_ids ); ?></h2>
                                            <div class="event-meta d-flex justify-content-between"><span>Read time | <?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute" post_id='."$post_ids".']');?></span> <span>Date: <?php $post_date = get_the_date( 'd.m.Y',$post_ids); echo $post_date;?></span></div>
                                        </div>
                                    </a>
                                </div>
                                <?php } else { ?>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                    <a href="<?php echo esc_url( get_permalink($post_ids) ); ?>" class="event-box sm d-flex">
                                        <?php $size = 'full'; ?>
                                        <?php echo  get_the_post_thumbnail($post_ids,$size); ?>
                                        <?php 
                                            $post_type = get_post_type($post_ids);
                                            $chars = array("-", "_");
                                            $cat = get_the_terms($post_ids, 'category')[0];

                                            $category_name = $cat->name;
                                            if($category_name=="Media Release"){
                                                $badgeColor = "badge-blue";
                                            }
                                            if($category_name=="Stories"){
                                                $badgeColor = "badge-green";
                                            }
                                            if($category_name=="Speeches and Opinions"){
                                                $badgeColor = "badge-purple";
                                            }
                                            if($category_name=="Biographies"){
                                                $badgeColor = "badge-green";
                                            }
                                        ?>
                                        <div class="event-info">
                                            <h5 class="badge <?php echo $badgeColor;?>"><?php echo $cat->name; ?></h5>
                                            <h2><?php echo get_the_title( $post_ids ); ?></h2>
                                            <div class="event-meta d-flex justify-content-between"><span>Read time | <?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute" post_id='."$post_ids".']');?></span> <span>Date: <?php $post_date = get_the_date( 'd.m.Y', $post_ids); echo $post_date;?></span></div>
                                        </div>
                                    </a>
                                </div>
                            <?php }; $count ++;  endforeach; ?>
                            
                        <?php endif; ?>

                       
            </div>
</section>