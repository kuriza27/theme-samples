<?php
$id = 'target_content-with-map-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<div class="position-relative">
    <div class="anchor">
        <a href="#<?php echo esc_attr( $id ); ?>"></a>
    </div>
</div>
<section id="<?php echo esc_attr( $id ); ?>" class="livin-map-section position-relative sp-100 overflow-hidden <?php echo esc_attr( $block['className'] );?>">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-5 col-xl-4 livin-map-content animate-children">
                <h3 class="h3">
                    <span class="title-selected sec"><?php the_field( 'title' ); ?></span>
                </h3>
                <strong class="text-120"><?php the_field( 'figure' ); ?></strong>
                <h4 class="pt-4"><?php the_field( 'heading' ); ?></h4>
                <div class="pr-lg-4 pb-3 pt-2">
                    <p><?php the_field( 'text' ); ?></p>
                </div>
                <div class="row gutters-10 d-none d-md-flex">
                    <?php if ( have_rows( 'buttons' ) ) : ?>
                        <?php $c=0; while ( have_rows( 'buttons' ) ) : the_row(); ?>
                            <div class="col-6">
                                <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'] . $c, get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-primary w-100', esc_attr( $id ), ''); ?>
                            </div>
                        <?php $c++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-7 col-xl-8">
                <?php $image = get_field( 'image' ); ?>
                <?php $size = '867x795'; ?>
                <?php if ( $image ) : ?>
                    <div class="translate-down-anim" data-speed="0.8">
                        <?php echo wp_get_attachment_image( $image, $size, false, array("class" => "w-100") ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row d-md-none mt-4">
            <?php if ( have_rows( 'buttons' ) ) : ?>
                <?php $c=0; while ( have_rows( 'buttons' ) ) : the_row(); ?>
                    <div class="col-md-6 col-12">
                        <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'] . $c, get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-primary w-100', esc_attr( $id ), ''); ?>
                    </div>
                <?php $c++; endwhile; ?>
            <?php endif; ?>
        </div>
    </div><!---End Container-->
</section>