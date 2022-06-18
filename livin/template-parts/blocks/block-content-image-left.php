<?php
$id = 'target_content-image-left-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo $id; ?>" class="support-section position-relative <?php echo $block['className']; ?>">
    <div class="d-md-none">
        <div class="anchor">
            <a href="#<?php echo $id; ?>"></a>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center animate-children">
            <div class="col-lg-6">
                <div class="img-group d-flex flex-wrap justify-content-lg-between align-items-start">
                    <?php if ( have_rows( 'image' ) ) : ?>
                        <?php while ( have_rows( 'image' ) ) : the_row(); ?>
                            <?php $image = get_sub_field( 'image' ); ?>
                            <?php if ( $image ) : ?>
                                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sect-text">
                    <h3 class="h3 text-uppercase"><span class="title-selected sec">#<?php the_field( 'title' ); ?></span>
                    </h3>
                    <h2 class="title-80"><?php the_field( 'heading' ); ?></h2>
                            <?php the_field( 'content' ); ?>
                    <div class="row gutters-10 buttons-group">
                        <?php if ( have_rows( 'buttons' ) ) : ?>
                            <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                                <?php $button_url = get_sub_field( 'button_url' ); ?>
                                <?php if ( $button_url ) : ?>
                                    <div class="col-lg-5 col-sm-6 d-flex">
                                            <a href="<?php echo esc_url( $button_url['url'] ); ?>" class="btn btn-primary btn-block"><?php echo esc_html( $button_url['title'] ); ?></a>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>