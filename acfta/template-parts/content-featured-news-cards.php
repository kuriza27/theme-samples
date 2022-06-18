<?php foreach ( $posts as $post_id ) : ?>
<div class="col-lg-4 col-sm-6 col-12 card--short card--featured">
    <a href="<?php echo esc_url( get_permalink($post_id) ); ?>" class="event-box sm d-flex">
        <?php $size = '605x384'; ?>
        <?php echo  get_the_post_thumbnail($post_id, $size); ?>
        <?php 
            $post_type = get_post_type($post_id);
            $chars = array("-", "_");
            $cat = get_the_terms($post_id, 'category')[0];

            $category_name = $cat->name;
            if($category_name=="Media Releases"){
                $badgeColor = "badge-blue";
              }
            if($category_name=="Stories"){
            $badgeColor = "badge-green";
            }
            if($category_name=="Speeches and Opinions"){
                $badgeColor = "badge-purple";
            }
            if($category_name=="Biographies"){
                $badgeColor = "badge-orange";
            }
        ?>
        <div class="event-info">
            <h5 class="badge <?php echo $badgeColor;?>"><?php echo $category_name; ?></h5>
            <h2><?php echo get_the_title( $post_id ); ?></h2>
            <div class="event-meta d-flex justify-content-between"><span>Read time | <?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute" post_id='."$post_id".']');?></span> <span>Date: <?php $post_date = get_the_date( 'j F Y',$post_id ); echo $post_date;?></span></div>
        </div>
    </a>
</div>
<?php endforeach; ?>