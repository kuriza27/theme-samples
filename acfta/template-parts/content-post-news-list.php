<?php
$the_query = new WP_Query($args);	
$totalpost = $the_query->found_posts; 
?>

<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php
    $published_date = get_the_date( 'j F, Y' );
    $cat = get_the_category()[0];
    ?>
    <div class="post opportunity-item pt-0 pb-5 <?php echo esc_attr($cat->slug); ?>">
        <div class="row">
            <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
                <?php $size='350x350';?>
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
                    <?php 
                     $title =  get_the_title();
                     $strlowerTitle = strtolower($title);
                    ?>
                   <h4><a href="<?php echo get_permalink();?>"><?php echo $title; ?></a></h4>
                    <div class="post-meta"><?php echo $published_date; ?></div>
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