
<nav aria-label="breadcrumb">
    <?php $manual_breadcrumb = get_field( 'manual_breadcrumb' ); ?>
    <?php if ( $manual_breadcrumb ) : ?>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><span></span></li>
        <?php foreach ( $manual_breadcrumb as $item_id ) :  ?>
            <li class="breadcrumb-item"><a href="<?php echo get_permalink( $item_id ); ?>"><?php echo get_the_title( $item_id ); ?></a></li>
        <?php endforeach; ?>                        
            <li class="breadcrumb-item"><a href="<?php echo get_permalink( get_the_ID() ); ?>"><?php echo get_the_title( get_the_ID() ); ?></a></li>
        </ol>
    <?php else: ?>
    <?php yoast_breadcrumb('<ol class="breadcrumb"><li class="breadcrumb-item">','</li></ol>'); ?>                     
    <?php endif; ?>           
</nav>