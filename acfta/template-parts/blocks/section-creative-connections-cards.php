<?php
$id = 'creative-connections-cards-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$classes = $block['className'];
$headerTitle = get_field( 'heading' );

$selected_width = get_field( 'container_width' );


if( $selected_width == 'default' ) {
    $container_width = '';
} elseif ( $selected_width == 'sm' ) {
    $container_width = '-sm';
} else {
    $container_width = '-fluid';
}

$parent_post = get_field( 'parent_post' );

$args = array(
    'post_type'       => 'investment',
    'posts_per_page'  => -1,
    'orderby'         => 'ID',
    'order'           => 'ASC',
    'post_parent'     => $parent_post,
    'post__not_in'    => array( get_the_ID() )
);

$posts = get_posts( $args );
?>
<section id="<?php echo esc_attr( $id ); ?>" class="highlights-section low-caps highlights-section-no-slider <?php echo esc_attr( $classes ); ?> link-cards-area">
    <div class="container<?php echo $container_width; ?> <?php if ( get_field( 'enable_mobile_slider_links' ) == 1 ) : ?>d-none d-lg-block <?php endif;?>">
        <?php if($headerTitle):?>
            <div class="row">
                <div class="col">
                    <h2><?php the_field( 'heading' ); ?></h2>
                </div>
            </div>
        <?php endif; ?>
        <div class="row gutter-22">
            <?php if ( count( $posts ) ) : ?>
                <?php foreach( $posts as $item ): ?>
                    <?php 
                    $post_blocks = parse_blocks( get_the_content( '', false, $item->ID ) );    
                    foreach( $post_blocks as $block ) {
                        if( $block['blockName'] == 'acf/page-banner' ) {
                            $title_text = strip_tags($block['attrs']['data']['header_content']);
                        }
                    }
                    ?>
                    <?php $link = get_permalink( $item->ID ); ?>
                    <!--card--->
                    <?php if ( get_field( 'enable_4_columns' ) == 1 ) : ?>
                        <div class="col-lg-3 mb-2">
                    <?php else : ?>
                        <div class="col-lg-4 mb-2">
                    <?php endif; ?>
                        <?php if ( get_sub_field( 'with_content' ) == 1 ) : ?>
                            <div class="funding-section-content">
                                <h2><?php echo str_replace('Creative Connections: ', '', $item->post_title) .': '. $title_text; ?></h2>
                                <p class="text-break"><?php echo $item->post_excerpt; ?></p>
                                <a href="<?php echo esc_url( $link ); ?>" class="btn btn-white">Explore</a>
                            </div>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $link); ?>" class="highlight-box d-flex">
                                <?php $size = '607x650'; ?>
                                <?php echo get_the_post_thumbnail( $item->ID, $size ); ?>
                                <h3><?php echo str_replace('Creative Connections: ', '', $item->post_title) .': '. $title_text; ?></h3>
                            </a>
                        <?php endif; ?>                
                    </div>
                    <!--/card--->
                <?php endforeach; ?>
            <?php endif; ?>       
        </div>
    </div>
    <div class="highlights-slider js-highlights-slider <?php if ( get_field( 'enable_mobile_slider_links' ) == 1 ) : ?>d-lg-none <?php else: ?> d-none<?php endif;?>">
        <?php if ( count( $posts ) ) : ?>
            <?php foreach( $posts as $item ): ?>
                <?php 
                $post_blocks = parse_blocks( get_the_content( '', false, $item->ID ) );    
                foreach( $post_blocks as $block ) {
                    if( $block['blockName'] == 'acf/page-banner' ) {
                        $title_text = strip_tags($block['attrs']['data']['header_content']);
                    }
                }
                ?>
                <?php $link = get_permalink( $item->ID ); ?>
                <div class="sl">
                    <a href="<?php echo esc_url( $link ); ?>" class="highlight-box d-flex align-items-end">
                        <?php $size = '607x650'; ?>
                        <?php echo get_the_post_thumbnail( $item->ID, $size ); ?>
                        <h3><?php echo str_replace('Creative Connections: ', '', $item->post_title) .': '. $title_text; ?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>                       
    </div>
</section>