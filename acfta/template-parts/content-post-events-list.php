
<?php

$the_query = new WP_Query($args);	

$totalpost = $the_query->found_posts; 
$count = 1;
?>

<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php 
    $post_id = get_the_ID();
    $cat = 'Events';
    $post_date = get_the_date( 'j F, Y' );
    $field_title = get_field( 'field_title', $post_id );
    $duration = get_field( 'duration_info', $post_id );
    $event_date = get_field( 'event_date', $post_id );
    ?>
    <div class="post pt-0 pb-5">
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
                    <h5 class="badge"><?php echo $cat; ?></h5>
                    <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                    <div class="meta d-flex justify-content-between mb-3">
                        <span class="font-weight-medium"><?php echo $field_title;?> | <?php echo $duration;?></span> 
                        <span class="font-weight-medium">Event Date: <?php echo $event_date;?>
                    </div>
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