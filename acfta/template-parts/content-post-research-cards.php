<?php
$the_query = new WP_Query($args);	
$totalpost = $the_query->found_posts; 
?>

<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php 
$post_id = get_the_ID();
$term_names = wp_get_post_terms($post_id, 'topic', array('fields' => 'names'));
$post_date = get_the_date( 'j F, Y' );
?>
<div class="col-lg-4 col-sm-6 col-12 mb-2 mb-sm-3 mb-lg-0">
    <a href="<?php echo get_permalink(); ?>" class="highlight-box d-flex">
        <?php the_post_thumbnail('732x650', array('class' => 'w732xh650')); ?>
        <div class="box-bottom">
            <?php foreach( $term_names as $name ): ?>
            <span class="advocacy-tag mr-2"><?php echo $name;?></span>
            <?php endforeach; ?>
            <h3><?php the_title(); ?></h3>
            <span class="box-date">Publication date: <?php echo $post_date;?></span>
        </div>
    </a>
</div>
<?php endwhile; ?>