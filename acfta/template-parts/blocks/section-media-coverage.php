<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-media-coverage.php
 *
 * Media Coverage Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'media-coverage-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-media-coverage';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section class="bg-grey py-80 <?php echo esc_attr( $classes ); ?>">
    <div class="container">
       <div class="col-lg-8">
        <div class="questions-list bg-white">
            <h2 class="mb-4"><?php the_field( 'heading' ); ?></h2>
            <?php if ( have_rows( 'media_list' ) ) : ?>
                
            <div class="accordion" id="accordionExample2" data-loadmore="container">	
                <?php $i = 1; ?>		                
                <?php $media_list_count = count( get_field( 'media_list' ) ); ?>
                <?php while ( have_rows( 'media_list' ) ) : the_row(); ?>
                    <?php $link = get_sub_field( 'link' ); ?>
                    <div class="card" style="<?php if( $i > 5 ){ echo 'display:none;'; } ?>">
                        <div class="card-header" id="question<?php echo $i;?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#question-collapse<?php echo $i;?>" aria-expanded="false" aria-controls="question-collapse<?php echo $i;?>">
                                    <span class="icon-plus-light mt-2"></span>
                                    <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><span class="text-capitalize"><?php echo esc_html( $link['title'] ); ?></span></a>
                                </button>
                            </h5>
                        </div>
                        <div id="question-collapse<?php echo $i;?>" class="collapse" aria-labelledby="question<?php echo $i;?>" data-parent="#accordionExample2">
                            <div class="card-body">
                                <?php the_sub_field( 'content' ); ?>
                            </div>
                        </div>
                    </div>
                <?php $i++; endwhile; ?>
            </div><!-- /faq -->
            <?php if( $media_list_count > 5 ): ?>
            <a href="#" data-loadmore="cards" data-offset="5" data-limit="5" class="btn btn--dark btn-xl btn-block">Load More Content</a>     
            <?php endif; ?>       
            <?php endif; ?>
        </div>
    </div> <!-- /container -->
</section>