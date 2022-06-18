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
<div class="col-lg-4 col-sm-6 col-12 mb-2 mb-sm-3 mb-lg-0 search-app-area">
    <a href="javascript:void(0);" class="highlight-box d-flex facilitator-box2">
        <div class="card-img-faci-load"  data-target="#faciliatorModal" data-toggle="modal">
            <?php the_post_thumbnail('732x650', array('class' => 'w732xh650')); ?>
            <div class="box-bottom">
                <?php foreach( $term_names as $name ): ?>
                <span class="advocacy-tag mr-2"><?php echo $name;?></span>
                <?php endforeach; ?>
                <h3><?php the_title(); ?></h3>
            </div>
        </div>
    </a>
    <div class="facilitator-data2 container search-app-modal-content">
                   <div class="row">
                        <div class="col-lg-6 text-center">
                            <?php $size = 'full'; ?>
                            <?php the_post_thumbnail($size); ?>
                         </div>
                       <div class="col-lg-6">
                           <div class="sect-text">
                            <h3><?php the_title(); ?></h3>
                          <?php the_excerpt(); ?>
                        <div class="modal-nav2">
                              <a href="<?php echo esc_url( get_permalink() ); ?>"  class="btn btn--dark btn-small align-items-center d-lg-inline-block">
                                 Learn More <span class="icon-plus-light"></span>
                             </a>
                         </div>
                     </div>
                 </div>
            </div>
    </div>
</div>
<?php endwhile; ?>
<script>
    jQuery(function ($) {
        $(".card-img-faci-load").click(function () {
            $(this).parent(".facilitator-box2").siblings(".facilitator-data2").clone().appendTo("#faciliatorInfo");
            $("#faciliatorInfo h3").html($("#faciliatorInfo h3").text().replace(/\n/g, "<br />"));
        });
    });
</script>