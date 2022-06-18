<?php
$id = 'partners-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<?php if ( get_field( 'enabled_custom_styling' ) == 1 ) : ?>
    <style>
        .partners-section.custom-partner-list1{
            background-color:<?php the_field( 'background_color' ); ?>!important;
            color: <?php the_field( 'heading_color' ); ?>!important;
        }

        .partner-w-stamp .title-selected:before, .title-selected.in-text.alt:after{
            background-color:<?php the_field( 'heading_background_color' ); ?>;
        }
    </style>
<?php endif; ?>

<section id="<?php echo esc_attr( $id ); ?>" class="partners-section partner-w-stamp <?php echo esc_attr( $block['className'] ); ?> <?php if ( get_field( 'enabled_custom_styling' ) == 1 ) : ?>custom-partner-list1<?php endif; ?>">
    <div class="container">
        
           <div class="d-xs-block d-sm-none d-md-none d-lg-none">     
                <div class="d-flex">
                        <div class="col-md-3"><span class="title-selected in-text"><p><?php the_field( 'title' ); ?></p></span></div>
                        <div class="col-md-3 mobile-stamp-text" style="font-size:13px;">
                        <?php the_field( 'image_content' ); ?>   
                        </div>
                        <div class="col-md-4">
                            <?php $stamp_logo_image = get_field( 'stamp_logo_image' ); ?>
                            <?php $size = '238x298'; ?>
                            <?php if ( $stamp_logo_image ) : ?>
                                <?php echo wp_get_attachment_image( $stamp_logo_image, $size ); ?>
                            <?php endif; ?>  
                        </div>
                </div>
            </div>
        <div class="row align-items-end animate-children">
            <div class="col-md-9 animate-children <?php if ( get_field( 'align_stamp_left' ) == 1 ) : ?>d-none<?php endif; ?>">
                <div class="<?php if ( get_field( 'align_center' ) == 1 ) : ?>text-center<?php endif; ?> d-none d-sm-block d-lg-block">
                       <?php if(get_field('title')) { ?> <span class="title-selected in-text"><p><?php the_field( 'title' ); ?></p></span><br><?php } ?>
                </div>
                <br>
                <?php if ( get_field( 'enable_logo_sprite_hover' ) == 1 ) : ?>
                    <div class="partners-list partners-list-with-hover js-partners-list <?php if ( get_field( 'enabled_custom_styling' ) == 1 ) : ?>custom-partner-list1<?php endif; ?>">
                        <?php if ( have_rows( 'logos_with_hover_images' ) ) : ?>
		                <?php while ( have_rows( 'logos_with_hover_images' ) ) : the_row(); ?>
                                <?php $image = get_sub_field( 'image' ); ?>
                                <?php if ( get_field( 'enabled_custom_styling' ) == 1 ) : ?>
                                    <?php $size = '238x298'; ?>
                                <?php else:?>
                                    <?php $size = '220x56'; ?>
                                <?php endif; ?>
                                    <a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="sl">
                                        <img data-hoverimg="<?php the_sub_field( 'image' );?>" data-originalimg="<?php the_sub_field( 'white_image' );?>" src="<?php the_sub_field( 'white_image' ); ?>" onmouseover="hover(this);" onmouseout="unhover(this);"/>
                                    </a>                   
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="partners-list js-partners-list <?php if ( get_field( 'enabled_custom_styling' ) == 1 ) : ?>custom-partner-list1<?php endif; ?>">
                        <?php if ( have_rows( 'logos' ) ) : ?>
                            <?php while ( have_rows( 'logos' ) ) : the_row(); ?>
                                <?php $image = get_sub_field( 'image' ); ?>
                                <?php if ( get_field( 'enabled_custom_styling' ) == 1 ) : ?>
                                    <?php $size = '238x298'; ?>
                                <?php else:?>
                                    <?php $size = '220x56'; ?>
                                <?php endif; ?>
                                <?php if ( $image ) : ?>
                                    <a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="sl">
                                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                                    </a>
                                <?php endif; ?>                    
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-3 d-none d-sm-block d-lg-block">
                <?php $stamp_logo_image = get_field( 'stamp_logo_image' ); ?>
                <?php $size = 'full'; ?>
                <?php if ( $stamp_logo_image ) : ?>
                    <div class="<?php if ( get_field( 'align_stamp_left' ) == 1 ) : ?>align-left<?php else:?> align-right<?php endif;?>">
                    <?php echo wp_get_attachment_image( $stamp_logo_image, $size ); ?>
                    </div>
                <?php endif; ?>       
                <?php the_field( 'image_content' ); ?>   
            </div>
        </div>
    </div>
</section><!-- .partners-section -->