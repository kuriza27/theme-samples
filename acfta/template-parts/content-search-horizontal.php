
<div class="post">
    <div class="row">
        <div class="col-md-5 px-0 px-sm-3">
            <?php $size='365x200';?>
            <a href="<?php echo get_permalink();?>">
                <?php if( has_post_thumbnail() ){ ?>
                <?php the_post_thumbnail($size,['class' => 'post-img w-100']);  ?>
                <?php } 
                    else{
                ?> 
                    <div class="default-horizontal-card--no-image p-4 d-flex align-items-center justify-content-center">
                        <div class="img-holder">
                            <?php echo wp_get_attachment_image( '979', 'full' ); ?>
                        </div>
                    </div>
                <?php } ?>
            </a>
        </div>
        <div class="col">
            <div class="mobile-space">
                <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                <div class="post-meta"><?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></div>
                <?php 
                    $excerpt = get_the_excerpt();
                    $excerpt = substr($excerpt, 0, 200);
                    echo $excerpt; 
                ?>
            </div>
        </div>
    </div>
</div>