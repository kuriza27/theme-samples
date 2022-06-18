<?php
$id = 'partners-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<?php if ( get_field( 'enabled_custom_styling' ) == 1 ) : ?>
    <style>
        .partners-section.custom-partner-list{
            background-color:<?php the_field( 'background_color' ); ?>!important;
            color: <?php the_field( 'heading_color' ); ?>!important;
        }
        .partners-list.custom-partner-list img{
            filter: none!important;
            height: auto;
        }
    </style>
<?php endif; ?>

<section id="<?php echo esc_attr( $id ); ?>" class="partners-section <?php echo esc_attr( $block['className'] ); ?> <?php if ( get_field( 'enabled_custom_styling' ) == 1 ) : ?>custom-partner-list<?php endif; ?>">
    <div class="container">
        <div class="row align-items-end animate-children">
            <div class="col-md-12 animate-children">
                <div class="text-center">
                    <?php if(get_field( 'heading_size' )=='H1'):?>
                    <h1><?php the_field( 'title' ); ?></h1><br>
                    <?php elseif(get_field( 'heading_size' )=='H2'):?>
                    <h2><?php the_field( 'title' ); ?></h2><br>
                    <?php elseif(get_field( 'heading_size' )=='H3'):?>
                    <h3><?php the_field( 'title' ); ?></h3>
                    <?php elseif(get_field( 'heading_size' )=='H4'):?>
                    <h4><?php the_field( 'title' ); ?></h4>
                    <?php else:?>
                        <p><?php the_field( 'title' ); ?></p>
                    <?php endif;?>
                </div>
                <div class="partners-list js-partners-list <?php if ( get_field( 'enabled_custom_styling' ) == 1 ) : ?>custom-partner-list<?php endif; ?>">
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
            </div>
        </div>
    </div>
</section><!-- .partners-section -->