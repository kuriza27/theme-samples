<?php
$id = 'group-info-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="info-groups-section <?php echo esc_attr( $block['className'] ); ?>">
    <div class="container text-center animate-children">
        <div class="row justify-content-center">
        <div class="col-lg-11 info-content text-center animate-children">
            <p><?php the_field( 'text' ); ?></p>
            <br />
            <h3><?php the_field( 'heading' ); ?></h3>
        </div>
        </div>
    </div>
    <div class="container-fluid animate-children">
        <div class="d-none d-md-block">
            <div class="info-groups-list row row-cols-lg-3 text-center">
                <?php if ( have_rows( 'info_list' ) ) : ?>
                    <?php while ( have_rows( 'info_list' ) ) : the_row(); ?>
                        <?php $link = get_sub_field( 'link' ); ?>
                        <div class="col d-flex align-items-center justify-content-center animate-children">
                            <div>
                            <h2><?php the_sub_field( 'title' ); ?></h2>
                            <?php if ( $link ) : ?>
                                <a href="<?php echo esc_url( $link); ?>">Find out more <span class="icon-right"></a>
                            <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="d-md-none">
                <div class="info-groups-list js-info-groups-list  text-center animate-children">
                    <?php if ( have_rows( 'info_list' ) ) : ?>
                        <?php while ( have_rows( 'info_list' ) ) : the_row(); ?>
                            <?php $link = get_sub_field( 'link' ); ?>
                            <div class="col d-flex align-items-center justify-content-center">
                                <div>
                                <h2><?php the_sub_field( 'title' ); ?></h2>
                                <?php if ( $link ) : ?>
                                    <a href="<?php echo esc_url( $link); ?>">Find out more <span class="icon-right"></a>
                                <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
        </div>
    </div>
</section><!-- .info-groups-section -->