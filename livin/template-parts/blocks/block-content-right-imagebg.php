<?php
$id = 'content-right-imagebg' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<?php $background_image = get_field( 'background_image' ); ?>
<?php if ( $background_image ) : ?>
<section id="<?php echo esc_attr( $id ); ?>" class="shop-merch-section position-relative" id="target1" style="background-image: url(<?php echo esc_url( $background_image['url'] ); ?>)">
    <div class="anchor d-none d-lg-block">
        <a href="#target1"></a>
    </div>
    <div class="container">
        <div class="row no-gutters animate-children">
            <div class="col-lg-6 offset-lg-6">
                <h3 class="h3 mb-5"><span class="title-selected text-uppercase"><?php the_field( 'title' ); ?></span></h3>
                <h2 class="text-80 mb-4"><?php the_field( 'heading' ); ?></h2>
                <p class=" mb-4"><?php the_field( 'content' ); ?></p>
                <div class="row gutters-20">
                    <?php if ( have_rows( 'button_link' ) ) : ?>
                    <?php $c=0; while ( have_rows( 'button_link' ) ) : the_row(); ?>
                        <?php $url = get_sub_field( 'url' ); ?>
                            <?php if ( $url ) : ?>
                                <div class="col-sm-auto col-12 mt-2">
                                    <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'url' )['key'] . $c, get_sub_field( 'url' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-primary', esc_attr( $id ), ''); ?>
                                </div>  
                            <?php endif; ?>
                        <?php $c++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif ?>