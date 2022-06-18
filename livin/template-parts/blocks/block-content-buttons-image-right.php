<?php
$id = 'target_content-buttons-image-right' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="life-section position-relative section-padding rm-display-flex <?php echo esc_attr( $block['className'] ); ?>">
    <div class="anchor">
        <a href="#<?php echo esc_attr( $id ); ?>"></a>
    </div>
    <div class="container">
        <div
            class="row no-gutters align-items-center flex-lg-row-reverse"
            >
            <div class="col-7">
                <div class="half-img-right">
                    <?php $image = get_field( 'image' ); ?>
                    <?php $size = '798x798'; ?>
                    <?php if ( $image ) : ?>
                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-5">
                <div class="half-left-content translate-down-anim" data-speed="0.8">
                    <h3 class="h3 ml-16">
                        <span class="title-selected sec text-uppercase"><?php the_field( 'title' ); ?></span>
                    </h3>
                    <h2 class="text-80">
                        <?php the_field( 'heading' ); ?>
                    </h2>
                    <p class="mb-4 pb-lg-2">
                        <?php the_field( 'text' ); ?>
                    </p>
                    <?php if ( have_rows( 'buttons' ) ) : $count = sizeof( get_field( 'buttons' ) ); $align = ''; ?>
                        <?php if( $count > 2 ) { $align = 'justify-content-center'; }  ?>
                    <div class="row <?php echo $align; ?>">
                        <?php $c=0; while ( have_rows( 'buttons' ) ) : the_row(); ?>
                            <div class="col-xl-6 col-12">
                                <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'] . $c, get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-primary w-100', esc_attr( $id ), ''); ?>
                            </div>
                        <?php $c++; endwhile; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>