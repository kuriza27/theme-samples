<?php
$id = 'content-left-imagebg' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<?php if ( get_field( 'disable_background_dark_filter' ) == 1 ) : ?>
    <style>
        .bg-section:before {
            background: unset!important;
        }
    </style>
<?php endif; ?>
<?php $background_image = get_field( 'background_image' ); ?>
<?php if ( $background_image ) : ?>
<section id="<?php echo esc_attr( $id ); ?>" class="impact-section bg-section text-white position-relative" style="background-image: url(<?php echo esc_url( $background_image['url'] ); ?>)">
    <div class="container">
        <div class="row animate-children">
            <div class="col-lg-9">
                <h2 class="text-80"> <?php the_field( 'heading' ); ?><br>
                    <h3><?php the_field( 'content' ); ?></h3>
                    <?php echo custom_button_styling(get_field( 'button_styling' ), 'btn-'. get_field_object( 'button_link' )['key'], get_field( 'button_link' ), get_field( 'enable_custom_button_styling' ), 'btn-secondary', esc_attr( $id ), ''); ?>
            </div>
        </div>
        <div class="content_image">
            <?php $content_image = get_field( 'content_image' ); ?>
            <?php $size = 'full'; ?>
            <?php if ( $content_image ) : ?>
                <?php echo wp_get_attachment_image( $content_image, $size ); ?>
            <?php endif; ?>
        </div>
        <?php if ( get_field( 'social_media' ) == 1 ) : ?>
            <div class="social-wrap content-left-social">
                    <?php if(!get_field( 'social_media_heading_title' )):?>
                        <h5><?php the_field( 'social_media_heading_title' ); ?></h5>
                     <?php endif; ?>
                     <?php if ( have_rows( 'social_media_list' ) ) : ?>
                        <div class="social js-social-list-donate list-unstyled d-flex">
                            <?php while ( have_rows( 'social_media_list' ) ) : the_row(); ?>
                            <?php $icon = get_sub_field( 'icon' ); ?>
                            <?php $size = 'full'; ?>
                            <?php if ( $icon ) : ?>
                                <div><a href="<?php the_sub_field( 'social_media_url' ); ?>" target="_blank"> <?php echo wp_get_attachment_image( $icon, $size ); ?></a></div>
                            <?php endif; ?>
                            <?php endwhile; ?>
                     </div>
                    <?php endif; ?>
                    <h2><?php the_field( 'subtext' ); ?></h2>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif ?>