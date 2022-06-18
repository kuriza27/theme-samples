<div class="col-12 col-md-6 col-lg-4 col-xl-3 post d-flex">
    <div class="d-flex flex-column w-100">
        <div class="flex-shrink-0">
            <?php $size='365x200';?>
            <a href="<?php echo get_permalink();?>">
                <?php if( has_post_thumbnail() ): ?>
                <?php  the_post_thumbnail($size,['class' => 'post-img w-100']);  ?>
                <?php else: ?> 
                    <div class="default-grid-card--no-image p-4 d-flex align-items-center justify-content-center">
                        <div class="img-holder">
                            <?php echo wp_get_attachment_image( '979', 'full' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </a>
        </div>
        <div class="flex-grow-1 d-flex flex-column post-data">
            <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
            <?php $published_date = get_the_date( 'j F, Y' ); ?>
            <div class="post-meta"><?php echo $published_date; ?></div>
            <?php 
            $excerpt = get_the_excerpt();
            $excerpt = substr($excerpt, 0, 200);
            echo $excerpt; 
            ?> 
            <br/> <br/>                                                       
            <a href="<?php echo get_permalink();?>" class="more-link mt-auto">Read More</a>
        </div>
    </div>
</div>