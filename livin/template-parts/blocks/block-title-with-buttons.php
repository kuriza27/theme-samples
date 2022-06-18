<?php
global $post;

$id = 'contact_form' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="helpful-links-section primary-bg section-padding text-white text-center <?php echo esc_attr( $block['className'] ); ?>">
    <div class="container">
        <div class="row justify-content-center animate-children">
            <div class="col-lg-10">
                <h3 class="mb-5"><?php the_field( 'title' ); ?></h3>
                <div class="row">
                    <?php 
                    $count = (!empty(get_field('buttons'))) ? 12 / count(get_field('buttons')) : 0;
                    $c=0;
                    while ( have_rows( 'buttons' ) ) : the_row(); ?>
                        <div class="col-xl-<?php echo $count;?> ">
                            <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'link' )['key'] . $c, get_sub_field( 'link' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-secondary btn-block', esc_attr( $id ), ''); ?>
                        </div>
                    <?php $c++; endwhile; ?>              
                </div>
            </div>
        </div>
    </div>
</section>