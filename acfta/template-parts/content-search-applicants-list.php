<?php
$the_query = new WP_Query($args);	
$totalpost = $the_query->found_posts; 
?>

<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php 
$post_id = get_the_ID();
$term_names = wp_get_post_terms($post_id, 'topic', array('fields' => 'names'));
$post_date = get_the_date( 'j F, Y', $post_id );
?>
<div class="post opportunity-item pt-0 pb-5">
    <div class="row">
        <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
            <?php $size='365x200';?>
            <a href="<?php echo get_permalink();?>">
                <?php if( has_post_thumbnail() ): ?>
                <?php the_post_thumbnail($size,['class' => 'post-img w-100']);  ?>
                <?php else: ?> 
                    <div class="default-horizontal-card--no-image p-4 d-flex align-items-center justify-content-center">
                        <div class="img-holder">
                            <?php echo wp_get_attachment_image( '979', 'full' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </a>
        </div>
        <div class="col">
            <div class="mobile-space">
                <?php foreach( $term_names as $name ): ?>
                <span class="open-style d-inline-block mr-2"><?php echo $name; ?></span>
                <?php endforeach; ?>
                <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                <strong>Publication date: <?php echo $post_date;?></strong>
                <br>
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