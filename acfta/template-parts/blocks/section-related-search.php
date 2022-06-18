<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-related-search.php
 *
 * Related Search Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'related-search-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-related-search-slider';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<?php if ( get_field( 'disable_slider' ) == 1 ) : ?>
<section id="<?php echo esc_attr( $id ); ?>" class="related-search-containers <?php echo esc_attr( $classes ); ?>">
                <div class="container">
                    <h2 class="mb-4 mobile-space"><?php the_field( 'heading' ); ?></h2>
                    <div class="row">
                    <?php $posts = get_field( 'posts' ); ?>
                        <?php if ( $posts ) : ?>
                            <?php foreach ( $posts as $post_ids ) : ?>
                            <div class="col-md-4">
                                <?php $size = '440x235'; ?>
                                <a href="<?php echo get_permalink($post_ids);?>" class="d-block ml-n3 mr-n3 mx-sm-0"><?php  echo get_the_post_thumbnail( $post_ids, $size,array( 'class' => 'w-100' ));?></a>
                                <div class="d-flex our-team">
                                    <p class="mb-0 pr-5"><?php echo get_the_title( $post_ids ); ?></p>
                                    <a href="<?php echo get_permalink($post_ids);?>"><span class="light-grey-text icon-plus-light"></span></a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div><!--/row--->
                </div>
</section>
<?php else : ?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
                <div class="container">
                    <h2 class="mb-4 mobile-space"><?php the_field( 'heading' ); ?></h2>
                    <?php
                        $posts = get_field( 'posts' );
                        $c = sizeof( $posts );
                        $class = $c < 4 ? 'js-no-slider' : '';
                        $class = $c <= 1 ? $class.' js-no-scroll' : $class;
                    ?>
                    <div class="links-slider js-links-slider <?php echo $class; ?>">
                        <?php if ( $posts ) : ?>
                            <?php foreach ( $posts as $post_ids ) : ?>
                                <div class="sl">
                                    <?php $size = '440x235'; ?>
                                    <a href="<?php echo get_permalink($post_ids);?>" class="mx-n15 d-block"> <?php  echo get_the_post_thumbnail( $post_ids, $size,array( 'class' => 'w-100' ));?></a>
                                    <div class="d-flex justify-content-between our-team">
                                        <h6><?php echo get_the_title( $post_ids ); ?></h6>
                                        <a class="position-static align-self-start" href="<?php echo get_permalink($post_ids);?>"><span class="light-grey-text icon-plus-light vertical-super"></span></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
</section>
<?php endif; ?>
