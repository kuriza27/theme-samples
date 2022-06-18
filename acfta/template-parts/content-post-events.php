<?php

$the_query = new WP_Query($args);	

$totalpost = $the_query->found_posts; 
$count = 1;
?>
<?php if( $paginate ): ?>
    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php   
        $post_id = get_the_ID();
        $cat = 'Events';
        $post_date = get_the_date( 'j F, Y' );
        $field_title = get_field( 'field_title', $post_id );
        $duration = get_field( 'duration_info', $post_id );
        $event_date = get_field( 'event_date', $post_id );
        ?>
        <div class="col-lg-6">
            <a href="<?php echo get_permalink(); ?>" class="event-box sm d-flex">
                <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'search-post-thumb' ) ); ?>
                <div class="event-info">
                    <h5 class="badge"><?php echo $cat; ?></h5>
                    <h2><?php the_title(); ?></h2>
                    <div class="meta d-flex justify-content-between"><span><?php echo $field_title;?> | <?php echo $duration;?></span> <span>Event Date: <?php echo $event_date;?></div>
                </div>
            </a>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php   
        $post_id = get_the_ID();
        $cat = 'Events';
        $post_date = get_the_date( 'j F, Y' );
        $field_title = get_field( 'field_title', $post_id );
        $duration = get_field( 'duration_info', $post_id );
        $event_date = get_field( 'event_date', $post_id );
        ?>
        <?php if($count == 1): ?>
            <div class="col-lg-7">
                <a href="<?php echo get_permalink(); ?>" class="event-box lg d-flex">
                    <?php the_post_thumbnail('full', array('class' => 'classname')); ?>
                    <div class="event-info">
                        <h5 class="badge"><?php echo $cat; ?></h5>
                        <h2><?php the_title(); ?></h2>
                        <div class="meta d-flex justify-content-between">
                            <span><?php echo $field_title; ?> | <?php echo $duration;?></span> 
                            <span>Event Date: <?php echo $event_date;?>
                        </div>
                    </div>
                </a>                    
            </div>
        <?php endif; ?>
        <?php if( $count == 2 ): ?>
        <div class="col-lg-5">
        <?php endif; ?>
        <?php if( $count == 2 || $count == 3 ): ?>
            <a href="<?php echo get_permalink($post_id); ?>" class="event-box sm d-flex">                    
                <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'search-post-thumb' ) ); ?>
                <div class="event-info">
                    <h5 class="badge"><?php echo $cat; ?></h5>
                    <h2 class="mb-3"><?php the_title(); ?></h2>
                    <div class="meta d-flex justify-content-between">
                        <span><?php echo $field_title;?> | <?php echo $duration;?></span> 
                        <span>Event Date: <?php echo $event_date;?>
                    </div>
                </div>
            </a>
        <?php endif; ?>
        <?php if( $count == 3 ): ?>
        </div>
        <?php endif; ?>

        <?php if($count >= 4): ?> 
            <div class="col-lg-6">
                <a href="<?php echo get_permalink($post_id); ?>" class="event-box sm d-flex">
                    <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'search-post-thumb' ) ); ?>
                    <div class="event-info">
                        <h5 class="badge"><?php echo $cat; ?></h5>
                        <h2><?php the_title(); ?></h2>
                        <div class="meta d-flex justify-content-between"><span><?php echo $field_title;?> | <?php echo $duration;?></span> <span>Event Date: <?php echo $event_date;?></div>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    <?php $count++; endwhile; ?>
<?php endif; ?>
