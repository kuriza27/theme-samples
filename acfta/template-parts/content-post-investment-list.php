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
    <div class="post opportunity-item pt-0 pb-5">
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
                    <span class="<?php echo $status_class ?> d-inline-block"><?php echo $status; ?></span>
                    <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                    <p class="font-weight-medium"><?php echo $price; ?></p>
                    <?php 
                        $excerpt = get_the_excerpt();
                        echo $excerpt; 
                    ?>
                </div>
            </div>
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