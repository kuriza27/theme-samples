<?php
$id = 'block-image-title-link-column-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'related-links-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <h2><?php the_field( 'heading' ); ?></h2>
        <div class="row">
        <?php if ( have_rows( 'column_items' ) ) : ?>
            <?php 
                $col_num = get_field( 'grid_columns' );
                if( $col_num == 2 ) {
                    $grid_class = 'col-12 col-md-6';
                    $size = '685x357';
                    
                } elseif( $col_num == 4 ) {
                    $grid_class = 'col-12 col-md-6 col-lg-3';
                    $size = '447X235';
                } else {                    
                    $grid_class = 'col-12 col-md-6 col-lg-4';
                    $size = '447X235';
                }
            ?>
            <?php while ( have_rows( 'column_items' ) ) : the_row(); ?>
            <div class="<?php echo $grid_class; ?>">
                <?php $image = get_sub_field( 'image' ); ?>
                <?php 
                    if ( get_sub_field( 'external' ) == 1 ) {
                        $link = get_sub_field( 'link_external' );
                        $target = '_blank';
                    } else {
                        $link = get_sub_field( 'link' );
                        $target = '_self';
                    }
                ?>
                <figure class="mb-3 pt-3 pb-lg-0">
                    <a href="<?php echo $link; ?>" target="<?php echo $target; ?>">
                        <?php if ( $image ) : ?>
                        <div class="placeholder__img mx-n15 d-block">
                            <?php echo wp_get_attachment_image( $image, $size ); ?>
                        </div>
                        <?php endif; ?>
                        <figcaption class="d-flex align-items-start mobile-space">
                            <div class="text-wrap">
                                <?php $title = get_sub_field( 'title' );?>
                                <?php if($title):?>
                                    <p><strong><?php the_sub_field( 'title' ); ?></strong></p>
                                <?php endif; ?>
                                    <p><?php the_sub_field( 'subtext' ); ?></p>
                            </div>
                            <span class="icon-plus-light ml-auto"></span>
                        </figcaption>
                    </a>
                </figure>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else : ?>
            <h3 class="text-center">No items added yet.</h3>
        <?php endif; ?>
    </div>
</section>