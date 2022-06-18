<?php
$the_query = new WP_Query($args);	
$totalpost = $the_query->found_posts; 
?>

<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
<div class="col-lg-4 col-sm-6 col-12 mb-2 mb-sm-3 mb-lg-0">
    <a href="<?php echo get_permalink(); ?>" class="highlight-box d-flex">
        <?php the_post_thumbnail('full', array('class' => 'classname')); ?>
        <div class="box-bottom">
            <span class="advocacy-tag"><?php echo $cat;?></span>
            <h3><?php the_title(); ?></h3>
            <span class="box-date">Publication date: <?php echo $post_date;?></span>
        </div>
    </a>
</div>
<?php endwhile; ?>