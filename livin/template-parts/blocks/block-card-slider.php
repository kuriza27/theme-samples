<?php
$id = 'target_posts-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php the_field( 'background_color' ); ?> position-relative section-padding <?php echo esc_attr( $block['className'] ); ?>" id="target2">
    <?php if ( get_field( 'has_anchor' ) == 1 ) : ?>
    <div class="anchor">
        <a href="#<?php echo esc_attr( $id ); ?>"></a>
    </div>
    <?php endif; ?>
    <div class="container animate-children">
        <?php if( get_field( 'heading' ) ): ?>
        <h3 class="text-center"><?php the_field( 'heading' ); ?></h3> 
        <?php endif; ?>
        <?php if ( have_rows( 'cards' ) ) : ?>
        <div class="cards-slider js-cards-slider">
            <?php while ( have_rows( 'cards' ) ) : the_row(); ?>
            <?php $link = ( get_sub_field( 'link' ) ) ? get_sub_field( 'link' ) : []; ?>
            <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="sl">
                <article class="card-outlined d-flex flex-column w-100">
                    <div class="flex-grow-1">
                        <h4 class="card-outlined-h4"><?php the_sub_field( 'top_text' ); ?></h4>
                        <h3 class="mb-3"><?php the_sub_field( 'title' ); ?></h3>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span><?php echo esc_html( $link['title'] ); ?></span>
                        <span class="right-long-icon"></span>
                    </div>
                </article>
            </a>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>