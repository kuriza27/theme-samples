<div class="col-lg-<?php echo $feed_layout; ?> pb-5">
    <div class="card bd-none w-100">
        <?php if ( $feed_image ) : ?>
            <?php $size = '1024x1024'; ?>
            <a class="d-flex" href="<?php the_permalink(); ?>"> 
                <?php echo wp_get_attachment_image( $feed_image, $size, false, array( "class" => 'w-100 h-auto' ) ); ?>
            </a>
        <?php endif; ?>
        <div class="card-section">
            <h4><a class="d-flex" href="<?php the_permalink(); ?>"><?php the_title(); ?> <span class="icon-plus-light ml-auto"></span></a></h4>
            <?php echo $feed_content; ?>
        </div>
    </div>
</div>