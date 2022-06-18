
<?php
$id = 'banner-header-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
    <div class="banner-content-main text-white has-admin-grey-bg <?php echo $block['className']; ?>">
            <div class="header-content pb-0">
                    <div class="container">
                        <div class="row">
                            <div class="col animate-children">
                                <h3 class="h3 text-uppercase"><span class="title-selected sec"><?php the_field( 'title' ); ?></span></h3>
                                <h1 class="mb-0"><?php the_field( 'content' ); ?>
                                </h1>
                            </div>
                        </div>
                    </div>
            </div>
            <section class="partners-section partner-section-inner">
                <div class="container">
                    <div class="row align-items-end animate-children">
                        <div class="col-12 col-lg-2 order-lg-last">
                            <?php $stamp = get_field( 'stamp' ); ?>
                            <?php if ( $stamp ) : ?>
                                <img class="right-sticky-img" src="<?php echo esc_url( $stamp['url'] ); ?>" alt="<?php echo esc_attr( $stamp['alt'] ); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-10 text-center text-lg-left">
                            <p class="text-left"><?php the_field( 'image_heading' ); ?></p>
                            <div class="partners-list js-partners-list ">
                                <?php if ( have_rows( 'partner_images' ) ) : ?>
                                    <?php while ( have_rows( 'partner_images' ) ) : the_row(); ?>
                                        <?php $image = get_sub_field( 'image' ); ?>
                                        <?php if ( $image ) : ?>
                                            <a class="sl" href="<?php the_sub_field( 'url' ); ?>"><img src="<?php echo esc_url( $image['url'] ); ?>" alt=""></a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>
