<?php
/**
 *
 * Digital Events Series Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'digital-events-series-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-digital-events-series-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> digital-events-section">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1><?php the_field( 'heading_title' ); ?></h1>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                    <?php $digital_events = get_field( 'digital_events' ); ?>
                    <?php if ( $digital_events ) : ?>
                        <?php foreach ( $digital_events as $post_ids ) : ?>
                            <?php 
                                $field_title = get_field( 'field_title', $post_ids); 
                                $duration = get_field( 'duration_info', $post_ids);
                                $event_date = get_field( 'event_date', $post_ids);
                            ?>
                            <div class="col-lg-4">
                                <a href="<?php echo get_permalink( $post_ids ); ?>" class="event-box md d-flex">
                                    <?php $size = 'full'; ?>
                                    <?php echo  get_the_post_thumbnail($post_ids,$size); ?>
                                     <?php 
                                          $post_type = get_post_type($post_ids);
                                          $chars = array("-", "_");
                                          $cat = str_replace($chars," ", $post_type);
                                     ?>
                                    <div class="event-info">
                                        <h5 class="badge"><?php echo $cat; ?></h5>
                                        <h2><?php echo get_the_title( $post_ids ); ?></h2>
                                        <div class="meta d-flex justify-content-between"><span><?php echo $field_title;?> | <?php echo $duration;?></span> <span>Event Date: <?php echo $event_date;?></span></div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div><!-- /row -->
                </div>
</section>