<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-content-basic.php
 *
 * Page Basic Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'page-basic-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-page-basic-content';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="basic-page-section">
    <div class="container-xl">
        <div class="row justify-content-end">
           <div class="col-xl-4"></div>
            <div class="col-xl-7">
            <?php if ( have_rows( 'basic_content' ) ): ?>
		        <?php while ( have_rows( 'basic_content' ) ) : the_row(); ?>
                    <?php if ( get_row_layout() == 'content' ) : ?>
                        <div class="mobile-space content-list-squared">
                            <?php the_sub_field('content'); ?>
                        </div>
                        <?php $button = get_sub_field( 'button' ); ?>
                        <?php if ( $button ) : ?>
                            <a href="<?php echo esc_url( $button['url'] ); ?>" class="btn btn-small btn-black align-items-center justify-content-center"><?php echo esc_html( $button['title'] ); ?> <span class="icon-plus-light"></span></a>
                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'accordion' ) : ?>
                        <div class="accordion-list bg-white"><!--/accordion-list--->
                            <?php if ( have_rows( 'accordion_details' ) ) : ?>
                                <div class="accordion" id="accordionExample2">
                                    <?php $i=1;while ( have_rows( 'accordion_details' ) ) : the_row(); ?>
                                         <!--card-->
                                        <div class="card">
                                            <div class="card-header" id="heading0<?php echo $i;?>">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                                            data-target="#collapse0<?php echo $i;?>" aria-expanded="false"
                                                            aria-controls="collapse0<?php echo $i;?>">
                                                            <?php the_sub_field( 'title' ); ?>
                                                        <span class="icon-plus-light ml-auto"></span>

                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapse0<?php echo $i;?>" class="collapse" aria-labelledby="heading0<?php echo $i;?>"
                                                data-parent="#accordionExample2">
                                                <div class="card-body">
                                                    <?php the_sub_field( 'accordion_content' ); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/card-->
                                    <?php $i++;endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div><!--/accordion-list--->
                    <?php endif; ?>
            	<?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</section>