<?php
$the_query = new WP_Query($args);	
$totalpost = $the_query->found_posts; 

if( $columns == 4 ) {
    $column_classes = 'col-12 col-md-6 col-lg-4 col-xl-3';
} elseif( $columns == 3 ) {
    $column_classes = 'col-12 col-md-6 col-xl-4';
} elseif( $columns == 2 ) {
    $column_classes = 'col-12 col-md-6';
}
?>

<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php
    $published_date = get_the_date( 'j F, Y' );
    $cat = get_the_category()[0];
    ?>
    <div class="<?php echo $column_classes; ?> post d-flex  <?php echo esc_attr($cat->slug); ?>">
        <div class="d-flex flex-column w-100">
            <div class="flex-shrink-0">
                <?php $size='350x350';?>
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
                <?php 
                  $title =  get_the_title();
                  $strlowerTitle = strtolower($title);
                ?>
                <h4><a href="<?php echo get_permalink();?>"><?php echo $title ?></a></h4>
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
<?php endwhile; ?>