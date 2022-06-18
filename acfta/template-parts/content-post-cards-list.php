<?php
$the_query = new WP_Query($args);	
$totalpost = $the_query->found_posts; 
?>

<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="post opportunity-item pt-0 pb-5">
        <div class="row">
            <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
                <?php $size='365x200';?>
                <a href="<?php echo get_permalink();?>">
                    <?php if( has_post_thumbnail() ){ ?>
                    <?php the_post_thumbnail($size,['class' => 'post-img w-100']);  ?>
                    <?php } 
                        else{
                    ?> 
                        <div style="background-color:#000;height:172px;"></div>
                    <?php } ?>
                </a>
            </div>
            <div class="col">
                <div class="mobile-space">
                    <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                    <?php 
                        $excerpt = get_the_excerpt();
                        $excerpt = substr($excerpt, 0, 200);
                        echo $excerpt; 
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>