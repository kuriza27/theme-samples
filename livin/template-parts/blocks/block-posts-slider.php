<?php
$id = 'target_posts-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$has_anchor = !empty(get_field('has_anchor'))? get_field('has_anchor') : "" ;
$backColor  = !empty(get_field('background_color'))? get_field('background_color') : "primary-bg" ;

?>
<section id="<?php echo esc_attr( $id ); ?>" class="block-posts-slider <?php echo $backColor;?> position-relative section-padding <?php echo esc_attr( $block['className'] ); ?>">
    <?php if($has_anchor):?>
        <div class="anchor">
            <a href="#<?php echo esc_attr( $id ); ?>"></a>
        </div>
    <?php endif;?>
    <div class="container animate-children">
        <?php if(!empty(get_field('text_top'))):?>
            <h3 class="text-center"><?php echo get_field('text_top');?></h3>    
        <?php endif;?>
        <div class="cards-slider js-cards-post-slider">
        <?php $select_posts = get_field( 'select_posts' ); ?>
        <?php if ( $select_posts ) : ?>
            <?php foreach ( $select_posts as $post_ids ) : ?>
                <?php $category = get_the_category( $post_ids ); $cat = $category[0]->cat_name; ?>
                <a href="<?php echo get_permalink( $post_ids ); ?>" class="sl">
                    <article class="card-outlined d-flex flex-column w-100">
                        <div class="flex-grow-1">
                            <h4 class="card-outlined-h4"><?php echo $cat; ?></h4>
                            <h3 class="mb-3"><?php echo get_the_title( $post_ids ); ?></h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <span>More</span>
                            <span class="right-long-icon"></span>
                        </div>
                    </article>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>
</section>