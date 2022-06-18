<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-facilitator-content.php
 *
 * Facilitator Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'facilitator-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-facilitator-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

?>
<section class="facilitators-section <?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <div class="row d-none d-sm-flex">
            <div class="col">
                <h2><?php the_field( 'heading' ); ?></h2>
            </div>
        </div>
        <div class="row facilitator-boxes">
            <div class="col-lg-4 col-md-6">
                <div class="highlight-box facilitator-box general-box d-flex">                    
                    <?php the_field( 'card_indicator' ); ?>
                </div>
            </div>
            <?php $facilitators = get_field( 'facilitators' );  ?>
            <?php if ( $facilitators ) : ?>
                <?php                     
                    $maxcount = count($facilitators);
                ?>
                <?php $i = 1; ?>
                <?php foreach ( $facilitators as $post_ids ) : ?>
                <!--highlight--->
                <div id="highlightBox<?php echo $i;?>" class="col-lg-4 col-md-6 facilitator-content"> 
                        <a href="javascript:void();" class="highlight-box facilitator-box general-box d-flex">
                            <div class="card-img-faci" data-target="#faciliatorModal"  data-toggle="modal">
                                <?php $size = 'full'; ?>
                                <?php echo  get_the_post_thumbnail($post_ids,'$size', array('class' => 'img-highlight')); ?>
                                <h3><?php 
                                    $org = get_field( 'organisation', $post_ids );
                                    $position = get_field( 'position', $post_ids );
                                    if($position){
                                        echo $position.':';
                                    }
                                    ?>
                                    <?php echo get_the_title( $post_ids ); ?><?php if( $org ):?>,
                                    <?php echo $org; ?>
                                    <?php endif;?>
                                </h3>
                                <button class="btn-reset  btn-plus"><span class="icon-plus-light"></span></button>
                            </div>
                        </a>
                        <div class="facilitator-data container">
                            <div class="row">
                                <div class="col-lg-4 text-center">
                                <?php $size = 'full'; ?>
                                <?php echo  get_the_post_thumbnail($post_ids,$size, array('class' => 'facil-img-2')); ?>
                                </div>
                                <div class="col-lg-7">
                                    <div class="sect-text">
                                        <h3>
                                            <?php 
                                            if($position){
                                                echo $position.':';
                                            }
                                           ?>
                                            <?php echo get_the_title( $post_ids ); ?>
                                            <?php if( $org ):?>,
                                             <?php echo $org; ?>
                                            <?php endif;?>
                                        </h3>
                                        <?php
                                            $content = get_the_excerpt($post_ids); 
                                            //$content = $post->post_content;
                                            echo $content;
                                            ?>
                                        <div class="modal-nav">
                                        <a class="btn btn-outline-dark btn-small align-items-center d-inline-block" href="<?php echo get_the_permalink($post_ids); ?>" target="">Read More <span class="icon-plus-light"></span></a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/highlight--->
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    
            <?php endif; ?>
        </div>
    </div>
</section>