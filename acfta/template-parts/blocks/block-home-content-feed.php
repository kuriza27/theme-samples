<?php
/**
 * Block template file: C:\projects\acfta.wp/wp-content/themes/acfta/template-parts/blocks/block-home-content-feed.php
 *
 * Home Content Feed Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'home-content-feed-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-home-content-feed-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

global $post;
?>
<section id="<?php echo esc_attr( $id ); ?>" class="section-5-7 section-8-4 block-content-feed-2-column <?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <div class="row" data-container="content_feed_<?php echo $block['id']; ?>">
        <?php if ( have_rows( 'content_feed' ) ) : ?>
            <?php 
                $limit = 6;
                $offset = 5;       
                $index = 0;       
            ?>
            <?php while ( have_rows( 'content_feed' ) ) : the_row(); ?>                
                <?php 
                    $feed_content = get_sub_field( 'content' );
                    $feed_layout = get_sub_field( 'layout_style' );
                    $page_or_post = get_sub_field( 'page_or_post' ); 
                ?>

                <?php if ( $page_or_post ) : ?>
                    <?php $post = $page_or_post; ?>
                    <?php setup_postdata( $post ); ?> 

                    <?php $feed_image = get_feed_featured_image( $post->ID ); ?>

                    <?php if( $feed_layout == 'full' ): ?> 
                    <div class="col-lg-12 covid-audiance-section feed-item <?php if( $offset <= $index){ echo 'feed-hidden'; } ?>">
                        <div class="img-text-box position-relative d-flex flex-wrap justify-content-end img-to-right">                        
                            <?php if ( $feed_image ) : ?>
                                <?php $size = '1190x766'; ?>
                                <?php echo wp_get_attachment_image( $feed_image, $size ); ?>
                            <?php endif; ?>          
                            <div class="sl-text">
                                <div class="fsm-top">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php echo $feed_content; ?>
                                </div>
                                <div class="text-right">
                                    <a class="more-link d-inline-flex align-items-center" href="<?php the_permalink(); ?>" target="">More information <span class="icon-plus-light"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-lg-<?php echo $feed_layout; ?> feed-item pb-5 <?php if( $offset <= $index){ echo 'feed-hidden'; } ?>">
                        <div class="card bd-none w-100">
                            <?php if ( $feed_image ) : ?>
                                <?php $size = '1024x1024'; ?>
                                <a class="d-flex" href="<?php the_permalink(); ?>"> 
                                    <?php echo wp_get_attachment_image( $feed_image, $size, false, array( "class" => 'w-100 h-auto' ) ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-section">
                                <h4><a class="d-flex" href="<?php the_permalink(); ?>"><?php the_title(); ?> <span class="icon-plus-light ml-auto"></span></a></h4>
                                <?php echo $feed_content; ?>
                            </div>                    
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            <?php $index++; 
            endwhile; ?>
        <?php else : ?>
            <?php // no rows found ?>
        <?php endif; ?>
        </div>
    </div>
    <?php if( count(get_field( 'content_feed' )) > $limit ): ?>
    <div class="col-12 text-center">
        <a class="btn btn-black btn-small align-items-center justify-content-center mt-0" data-load="content_feed" data-offset="<?php echo $offset; ?>" data-limit="<?php echo $limit; ?>" data-post="<?php echo $post_id; ?>" data-block="<?php echo $block['id']; ?>" href="#">Load More <span class="icon-plus-light"></span></a>
    </div>
    <?php endif; ?>
</section>