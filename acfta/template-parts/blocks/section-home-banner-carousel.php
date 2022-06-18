
<section class="header-slider js-header-slider h-banner-carousel">
<?php if ( have_rows( 'carousel' ) ) : ?>
    <?php while ( have_rows( 'carousel' ) ) : the_row(); ?>    
        <div class="home-banner-carousel text-white <?php echo $block['className']; ?>"   
        <?php if ( get_sub_field( 'banner_image' ) ) : ?>style="background-image: url(<?php echo the_sub_field( 'banner_image' ); ?>)"<?php endif; ?>>
            <div class="header-content d-flex">
                <div class="container d-flex w-100">
                    <div class="row w-100">
                        <div class="col d-flex flex-column header-content-info">
                            <div class="header-slider  h-100">
                                    <div class="sl">
                                        <h1><?php the_sub_field( 'heading' ); ?></h1>
                                        <?php the_sub_field( 'content' ); ?>
                                        <?php $button = get_sub_field( 'button' ); ?>
                                        <?php if ( $button ) : ?>
                                            <a class="btn btn-light" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                                        <?php endif; ?>
                                    </div>
                            </div>
                                <h6 class="d-none d-lg-block"><?php the_field( 'credit_text' ); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
      </div>
    <?php endwhile; ?>
<?php endif; ?>
</section>