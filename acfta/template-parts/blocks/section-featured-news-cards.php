
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
$id = 'featured-news-cards-' . $block['id'];
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
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> digital-events-section cards--featured-news">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1><?php the_field( 'heading' ); ?></h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row" data-container="<?php echo esc_attr( $id );  ?>">        

            <?php if ( have_rows( 'first' ) ) : ?>
            <div class="col-lg-4 col-sm-6 col-12 card--featured card--tall card--tall-empty">
            <?php while ( have_rows( 'first' ) ) : the_row(); ?>
                <?php $button = get_sub_field( 'button' ); ?>
                <a href="<?php echo esc_url( $button['url'] ); ?>" class="event-box md funding-section-content flex-column justify-content-center align-items-start d-flex mb-0 h-auto-m">
                    <div class="card--empty">
                        <?php the_sub_field( 'content' ); ?>
                        <?php if ( $button ) : ?>
                            <span class="btn btn-white"><?php echo esc_html( $button['title'] ); ?></span>
                        <?php endif; ?>                        
                    </div>
                </a>
            <?php endwhile; ?>             
            </div>
            <?php endif; ?>   

            <?php $featured_posts = get_field( 'featured_posts' ); ?>
            <?php $featured_posts = array_slice( $featured_posts, 0, 5 ); ?>
            <?php if ( $featured_posts ) : $count = 0; ?>

                <?php foreach ( $featured_posts as $post_ids ) : ?>

                    <?php if( $count < 2 ): ?>                    
                    <div class="col-lg-4 col-sm-6 col-12 card--tall card--featured">
                        <a href="<?php echo esc_url( get_permalink($post_ids) ); ?>" class="event-box md d-flex">
                            <?php $size = '605x820'; ?>
                            <?php echo  get_the_post_thumbnail($post_ids,$size); ?>
                            <?php 
                                $post_type = get_post_type($post_ids);
                                $chars = array("-", "_");
                                $cat = get_the_terms($post_ids, 'category')[0];

                                $category_name = $cat->name;
                                if($category_name=="Media Releases"){
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
                                <span class="badge <?php echo $badgeColor;?>"><?php echo $category_name; ?></span>
                                <h2><?php echo get_the_title( $post_ids ); ?></h2>
                                <div class="event-meta d-flex justify-content-between"><span>Read time | <?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute" post_id='."$post_ids".']');?></span> <span>Date: <?php $post_date = get_the_date( 'j F Y', $post_ids ); echo $post_date;?></span></div>
                            </div>
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="col-lg-4 col-sm-6 col-12 card--short card--featured">
                        <a href="<?php echo esc_url( get_permalink($post_ids) ); ?>" class="event-box sm d-flex">
                            <?php $size = '605x384'; ?>
                            <?php echo  get_the_post_thumbnail($post_ids,$size); ?>
                            <?php 
                                $post_type = get_post_type($post_ids);
                                $chars = array("-", "_");
                                $cat = get_the_terms($post_ids, 'category')[0];

                                $category_name = $cat->name;
                                if($category_name=="Media Releases"){
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
                                <h5 class="badge <?php echo $badgeColor; ?>"><?php echo $cat->name; ?></h5>
                                <h2><?php echo get_the_title( $post_ids ); ?></h2>
                                <div class="event-meta d-flex justify-content-between"><span>Read time | <?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute" post_id='."$post_ids".']');?></span> <span>Date: <?php $post_date = get_the_date( 'j F Y' , $post_ids ); echo $post_date;?></span></div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>      

                <?php $count++; endforeach; ?>     
            <?php endif; ?>
        </div>
        <?php if( count( get_field( 'featured_posts' ) ) > 5 ): ?>
        <div class="loading-pagination mt-4 px-3 text-center">
            <div class="col">      
                <div class="text-center">
                    <a class="btn btn-black btn-with-loader d-flex justify-content-between" data-action="loadFeaturedNewsCards" data-offset="5" data-ids="<?php echo json_encode(get_field( 'featured_posts' )); ?>" data-limit="6" data-elem="<?php echo esc_attr( $id ); ?>" href="javascript:void(0)" data-ajax="<?php echo admin_url( 'admin-ajax.php' ); ?>">Load more results <span class="icon-plus-light d-inline-block icon-loader"></span></a>
                </div>
            </div>
        </div>          
        <?php endif; ?>          
    </div>
</section>