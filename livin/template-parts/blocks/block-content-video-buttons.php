<?php
$id = 'target_content-video-buttons' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="position-relative sp-100 home-video-section <?php echo esc_attr( $block['className'] ); ?>">
    <div class="anchor">
        <a href="#<?php echo esc_attr( $id ); ?>"></a>
    </div>
    <div class="container-sm text-center animate-children">
        <h3 class="h3 mb-4">
            <span class="title-selected"><?php the_field( 'title' ); ?></span>
        </h3>
        <h2 class="title-80">
            <?php the_field( 'heading' ); ?>
        </h2>
        <div class="video-block">
            <?php the_field( 'video' ); ?>
            <!-- <img src="images/taylor-wilcox-4nKOEAQaTgA-unsplash.jpg" alt="" />
            <button class="video-block-play">
                <svg width="79" height="89" viewBox="0 0 79 89" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M76.7617 41.052L6.53944 1.45204C5.17889 0.686441 3.51989 0.704041 2.17689 1.48724C0.825111 2.27924 0 3.72244 0 5.28883V84.4887C0 86.0551 0.825111 87.4983 2.17689 88.2903C2.86156 88.6863 3.62522 88.8887 4.38889 88.8887C5.12622 88.8887 5.87233 88.7039 6.53944 88.3255L76.7617 48.7255C78.1398 47.9423 79 46.4816 79 44.8888C79 43.296 78.1398 41.8352 76.7617 41.052Z"
                        fill="#EF5437"
                        />
                </svg>
            </button> -->
        </div>
        <p>
            <?php the_field( 'text' ); ?>
        </p>
        <div class="row gutters-16 justify-content-center">
            <?php if ( have_rows( 'buttons' ) ) : ?>
                <?php $c=0; while ( have_rows( 'buttons' ) ) : the_row(); ?>
                    <div class="col-auto">
                        <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'] . $c, get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-primary', esc_attr( $id ), ''); ?>
                    </div>
                <?php $c++; endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>