
<?php
$id = 'blog-content-sidebar-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="main-section blog-top-section border-bottom <?php echo esc_attr( $block['className'] ); ?>">
    <div class="container">
        <div class="row justify-content-center animate-children">
            <div class="col-lg-7 mb-5">
                        <div class="blog-content-heading">
                            <h3 class="h3 text-uppercase in-header-title"><span
                                    class="title-selected sec"><?php the_title(); ?></span></h3>
                        </div>
                    <div class="position-relative">
                        <!---Blog Slider--->
                            <div id="<?php echo esc_attr( $id ); ?>" class="blog-news-slider js-blog-news-slider">
                                <?php $news_slider = get_field( 'news_slider' ); ?>
                                <?php if ( $news_slider ) : ?>
                                    <?php foreach ( $news_slider as $post_ids ) : ?>
                                        <div class="sl">
                                            <h1 class="mb-3"><?php echo get_the_title( $post_ids ); ?></h1>
                                            <p class="news-text"><?php echo get_the_excerpt( $post_ids); ?></p>
                                            <a href="<?php echo get_permalink( $post_ids );?>" class="title-bordered sm">Continue Reading</a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <!---End Blog Slider--->  
                    </div>              
            </div>
            <?php if ( have_rows( 'sidebar' ) ): ?>
            <div class="col-lg-5 v-delim-l d-none d-lg-block">
                <aside class="sidebar animate-children">
                    <?php while ( have_rows( 'sidebar' ) ) : the_row(); ?>
                    <?php if ( get_row_layout() == 'form_widget' ) : ?>                    
                        <div class="widget form-widget">
                        <h4><?php the_sub_field( 'title' ); ?></h4>
                        <p><?php the_sub_field( 'text' ); ?></p>
                        <?php $form = get_sub_field( 'form' ); ?>
                        <?php if ( $form ) : ?>
                            <?php $formID = $form['id']; ?>
                            <?php echo do_shortcode('[gravityform id="'.$formID.'" title="true" description="true" ajax="true"]'); ?>
                        <?php endif; ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'links_widget' ) : ?>
                    <div class="widget sidebar-menu">
                        <h4><?php the_sub_field( 'title' ); ?></h4>
                        <?php the_sub_field( 'links' ); ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'media_widget' ) : ?>
                    <div class="widget video-widget">
                        <div class="video-block">
                            <?php if ( get_sub_field( 'media' ) == 1 ) : ?>
                                <?php the_sub_field( 'video' ); ?>
                            <?php else : ?>
                                <?php $image = get_sub_field( 'image' ); ?>
                                <?php $size = '517x246'; ?>
                                <?php if ( $image ) : ?>
                                    <?php echo wp_get_attachment_image( $image, $size ); ?>
                                <?php endif; ?>
                            <?php endif; ?>                            
                            <button class="video-block-play">
                                <svg width="79" height="89" viewBox="0 0 79 89" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                    <path d="M76.7617 41.052L6.53944 1.45204C5.17889 0.686441 3.51989 0.704041 2.17689 1.48724C0.825111 2.27924 0 3.72244 0 5.28883V84.4887C0 86.0551 0.825111 87.4983 2.17689 88.2903C2.86156 88.6863 3.62522 88.8887 4.38889 88.8887C5.12622 88.8887 5.87233 88.7039 6.53944 88.3255L76.7617 48.7255C78.1398 47.9423 79 46.4816 79 44.8888C79 43.296 78.1398 41.8352 76.7617 41.052Z"
                                            fill="#EF5437"></path>
                                </svg>
                            </button>
                        </div>
                        <h4><?php the_sub_field( 'title' ); ?></h4>
                        <p><?php the_sub_field( 'text' ); ?></p>
                        <?php $button = get_sub_field( 'button' ); ?>
                        <?php if ( $button ) : ?>
                            <a class="btn btn-primary" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                        <?php endif; ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'social_media_widget' ) : ?>
                    <div class="social-wrap social-wrap-blog widget text-center text-md-left">
                        <h4 class="mb-4"><?php the_sub_field( 'title' ); ?></h4>
                        <?php if ( have_rows( 'social' ) ) : ?>
                        <ul class="social social-circle list-unstyled d-flex justify-content-md-start justify-content-lg-between justify-content-center">
                            <?php while ( have_rows( 'social' ) ) : the_row(); ?>
                            <li><a href="<?php the_sub_field( 'url' ); ?>" target="_blank"><span class="icon-<?php the_sub_field( 'icon' ); ?>"></span></a></li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'newsletter_widget' ) : ?>
                    <div class="widget form-widget">
                        <h4><?php the_sub_field( 'title' ); ?></h4>
                        <?php $form = get_sub_field( 'form' ); ?>
                        <?php if ( $form ) : ?>
                            <?php $formID = $form['id']; ?>
                            <?php echo do_shortcode('[gravityform id="'.$formID.'" title="true" description="true" ajax="true"]'); ?>
                        <?php endif; ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'buttons_widget' ) : ?>
                    <div class="widget">
                        <h4 class="mb-4"><?php the_sub_field( 'title' ); ?></h4>
                        <?php if ( have_rows( 'buttons' ) ) : ?>
                        <div class="row gutters-10">
                            <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                            <?php $button = get_sub_field( 'button' ); ?>
                            <div class="col-12 col-md-3 col-lg-6 d-flex">
                                <a class="btn btn-secondary w-100 d-flex align-items-center justify-content-center mb-2" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endwhile; ?>
                </aside>
            </div>            
            <?php endif; ?>
        </div>
    </div>
</section>