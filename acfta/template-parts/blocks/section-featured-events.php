<?php
/**
 *
 * Featured Events Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'featured-events-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-featured-events-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> events-section">
    <div class="container-fluid">
            <div class="row">
            <?php $featured_events = get_field( 'featured_events' ); ?>
                <?php if ( $featured_events ) : ?>
                    <?php $count=1;foreach ( $featured_events as $post_ids ) : ?>
                        <?php 
                            $field_title = get_field( 'field_title', $post_ids); 
                            $duration = get_field( 'duration_info', $post_ids);
                            $event_date = get_field( 'event_date', $post_ids);
                        ?>
                        <?php if($count<=1): ?>
                        <div class="col-lg-7">
                            <a href="<?php echo get_permalink( $post_ids ); ?>" class="event-box lg d-flex">
                                <?php $size = '1080x790'; ?>
                                <?php echo  get_the_post_thumbnail($post_ids,$size); ?>
                                <?php 
                                    $post_type = get_post_type($post_ids);
                                    $chars = array("-", "_");
                                    $cat = get_the_terms( $post_ids, 'category' )[0];
                                ?>
                                <div class="event-info">
                                    <h5 class="badge"><?php echo $cat->name; ?></h5>
                                    <h2><?php echo get_the_title( $post_ids ); ?></h2>
                                    <div class="meta meta d-flex justify-content-between"><span><?php echo $field_title;?> | <?php echo $duration;?></span> <span>Event Date: <?php echo $event_date;?></span></div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php $count++; endforeach; ?>
                        <div class="col-lg-5">
                            <?php $count=1;foreach ( $featured_events as $post_ids ) : ?>
                            <?php 
                                $field_title = get_field( 'field_title', $post_ids); 
                                $duration = get_field( 'duration_info', $post_ids);
                                $event_date = get_field( 'event_date', $post_ids);
                            ?>
                            <?php if($count > 1): ?>                        
                                <a href="<?php echo get_permalink( $post_ids ); ?>" class="event-box sm d-flex">
                                    <?php $size = '763x384'; ?>
                                    <?php echo  get_the_post_thumbnail($post_ids,$size); ?>
                                    <?php 
                                        $post_type = get_post_type($post_ids);
                                        $chars = array("-", "_");
                                        $cat = get_the_terms( $post_ids, 'category' )[0];
                                    ?>
                                    <div class="event-info">
                                        <h5 class="badge"><?php echo $cat->name; ?></h5>
                                        <h2><?php echo get_the_title( $post_ids ); ?></h2>
                                        <div class="meta d-flex justify-content-between"><span><?php echo $field_title;?> | <?php echo $duration;?></span> <span>Event Date: <?php echo $event_date;?></span></div>
                                    </div>
                                </a>                        
                            <?php endif; ?>
                            <?php $count++; endforeach; ?>
                        </div>    
                <?php endif; ?>
            </div><!-- /row -->
     </div><!-- /container-fluid -->
</section>