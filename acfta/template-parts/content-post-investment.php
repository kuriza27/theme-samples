<?php
$the_query = new WP_Query($args);	
$totalpost = $the_query->found_posts; 

$html_open = array();
$html_closed = array();
$html_opening = array();
$html_closing = array();

$offset = ($paged * 8) - 8;
?>
<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php
    $post_id = get_the_ID();
    $opening = strtotime( get_field( 'opening_date', $post_id ) ); 
    $closing = strtotime( get_field( 'closing_date', $post_id ) );
    $closing_date = get_field( 'closing_date', $post_id );
    
    if( !$opening ) {
        $opening = strtotime( "-1 month" );
    }
    if( !$closing ) {
        $closing = strtotime( "-1 month" );
    }

    $today = strtotime( 'now' );
    $nextDate = strtotime( '+2 weeks' );
    
    if( $opening > $today ) {
        $status = 'Opening soon';
        $status_class = 'open-soon-style';
    } else if( $today >= $opening && $today <= $closing && $nextDate >= $closing ) {
        $status = 'Closing soon';
        $status_class = 'close-soon-style';
    } else if( $closing < $today ) {
        $status = 'Closed';
        $status_class = 'closed-style btn-black';
    } else {
        $status = 'Open';
        $status_class = 'open-style';
    }
?>
    <?php ob_start(); ?>
    <?php  
        $timezoneSelected = get_field( 'select_time_zone', $post_id);
         if(empty($timezoneSelected)){
            $timezoneSelected = "AEST";
         } 
    ?>
    <div class="col col-lg-3 col-md-6 col-12 d-flex">
        <div class="opportunity-item d-flex flex-column" >
            <span class="<?php echo $status_class ?> align-self-start"><?php echo $status; ?></span>
            <h3 class="h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php if( $status=='Open' || $status=='Closing soon'):?>
                     <div class="closing-text">
                        <strong>Closing Date:</strong><p><?php echo $closing_date; ?> (<?php echo $timezoneSelected ;?>)</p>
                    </div>
             <?php endif;?>
            <div class="opportunity-item-body flex-grow-1">
                <?php 
                    $postid = get_the_ID();
                    $price =  get_field( 'price_range',  $postid );
                ?>
                <p class="font-weight-medium"><?php echo $price; ?></p>
                <p><?php the_excerpt(); ?></p>
            </div>
            <a href="<?php the_permalink(); ?>" class="text-underline">View opportunity</a>
        </div>
    </div>
    <?php if( $status == 'Open' ): ?>
        <?php $html_open[] = ob_get_clean(); ?>
    <?php elseif( $status == 'Closed' ): ?>
        <?php $html_closed[] = ob_get_clean(); ?>
    <?php elseif( $status == 'Closing soon' ): ?>
        <?php $html_closing[] = ob_get_clean(); ?>
    <?php elseif( $status == 'Opening soon' ): ?>
        <?php $html_opening[] = ob_get_clean(); ?>
    <?php endif; ?>
<?php endwhile; ?>
<?php $html_closed = array_reverse( $html_closed ); ?>
<?php $html = array_merge($html_closing, $html_open, $html_opening, $html_closed ); ?>
<?php foreach( array_slice($html, $offset, 8) as $item ): ?>
    <?php echo $item; ?>
<?php endforeach; ?>