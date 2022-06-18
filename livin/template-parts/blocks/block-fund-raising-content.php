<?php
$id = 'fund-raising-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="info-groups-section alt <?php echo esc_attr( $classes ); ?>">
                <div class="container text-center animate-children">
                    <div class="row justify-content-center">
                        <div class="col-lg-11 text-center">
                            <h3><?php the_field( 'heading' ); ?></h3>
                        </div>
                    </div>
                </div>
            <div class="container-fluid animate-children">
                    <div class="d-none d-md-block">
                        <div class="info-groups-list row row-cols-lg-3 text-center">
                            <?php if ( have_rows( 'list' ) ) : ?>
                                <?php while ( have_rows( 'list' ) ) : the_row(); ?>
                                    <?php $url = get_sub_field( 'url' ); ?>
                                    <?php if ( $url ) : ?>
                                        <div class="col d-flex align-items-center justify-content-center">
                                            <div>
                                                <h2><?php the_sub_field( 'title' ); ?></h2>
                                                <a href="<?php echo esc_url( $url['url'] ); ?> target="<?php echo esc_attr( $url['target'] ); ?>"">Find out more</a>
                                            </div>
                                        </div>     
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-md-none">
                        <div class="info-groups-list js-info-groups-list  text-center">
                            <?php if ( have_rows( 'list' ) ) : ?>
                                    <?php while ( have_rows( 'list' ) ) : the_row(); ?>
                                        <?php $url = get_sub_field( 'url' ); ?>
                                        <?php if ( $url ) : ?>
                                            <div class="col d-flex align-items-center justify-content-center">
                                                <div>
                                                    <h2><?php the_sub_field( 'title' ); ?></h2>
                                                    <a href="<?php echo esc_url( $url['url'] ); ?>" target="<?php echo esc_attr( $url['target'] ); ?>"><span class="b-line">Find out more</span> <span class="icon icon-right"></span></a>
                                                </div>
                                            </div>     
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                        </div>
                    </div>
        </div>
</section>