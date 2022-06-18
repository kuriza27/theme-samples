<?php
$id = 'content-feed-2-column-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-content-feed-2-column';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$column = get_field( 'column' );
$columnSpan = explode('_', $column)[1];
$column = explode('-', $columnSpan);
?>
<section id="<?php echo esc_attr( $id ); ?>" class="section-<?php echo $columnSpan; ?> <?php echo $classes; ?>">
    <div class="container">
        <div class="row">
            <?php if ( have_rows( 'content_feed' ) ) : $c = 0; ?>
                <?php while ( have_rows( 'content_feed' ) ) : the_row(); ?>
                    <div class="col-lg-<?php echo $column[$c]; ?>">
                        <div class="card bd-none <?php if ( !is_front_page() ) :?>animate-children<?php endif;?>">
                            <?php $image = get_sub_field( 'image' ); ?>
                            <?php $size = '1024x1024'; ?>
                            <?php $link = get_sub_field( 'link' ); ?>

                                <?php if ( $image ) : ?>
                                    <a class="d-flex" href="<?php if ( $link ) : echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); endif;?>"> <?php echo wp_get_attachment_image( $image, $size, false, array( "class" => 'w-100 h-auto' ) ); ?></a>
                                <?php endif; ?>

                            <div class="card-section">
                                <h4>
                                    <a class="d-flex" href="<?php  if ( $link ) :  echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); endif;?>"><?php the_sub_field( 'heading' ); ?>
                                    <span class="icon-plus-light ml-auto"></span></a>
                                </h4>
                                <?php the_sub_field( 'text' ); ?>
                            </div>

                        </div>
                    </div>
                <?php
                $c++;
                endwhile; ?>
            <?php endif; ?>

            <?php $button = get_field( 'button' ); ?>
            <?php if ( $button ) : ?>
                <div class="col-12 text-center">
                    <a class="btn btn-black btn-small align-items-center justify-content-center" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?> <span class="icon-plus-light"></span></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
