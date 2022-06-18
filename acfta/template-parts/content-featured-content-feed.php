<div class="col-lg-12 covid-audiance-section">
    <div class="img-text-box position-relative d-flex flex-wrap justify-content-end img-to-right">                        
        <?php if ( $feed_image ) : ?>
            <?php $size = '1190x766'; ?>
            <?php echo wp_get_attachment_image( $feed_image, $size ); ?>
        <?php endif; ?>          
        <div class="sl-text">
            <div class="fsm-top">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php echo $feed_content; ?>
            </div>
            <div class="text-right">
                <a class="more-link d-inline-flex align-items-center" href="<?php the_permalink(); ?>" target="">More information <span class="icon-plus-light"></span></a>
            </div>
        </div>
    </div>
</div>