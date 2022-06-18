
<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-content-with-sidebar.php
 *
 * Content Right Sidebar Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'content-right-sidebar-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-content-right-sidebar';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> placement-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="placement-content">

                    <?php the_field( 'content' ); ?>

                    <?php if ( have_rows( 'buttons' ) ) : ?>
                    <div class="row my-md-5 my-3">
                        <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                            <?php $button = get_sub_field( 'button' ); ?>
                            <?php if ( $button ) : ?>
                                <?php
                                             $buttonClass = get_sub_field( 'button_color' );
                                             if($buttonClass=="White"){
                                                $buttonClass = "btn-outline-danger";
                                             }else if($buttonClass=="Grey"){
                                                $buttonClass = "btn-outline-dark";
                                             }
                                             else{
                                                $buttonClass = "btn--dark";
                                             }
                                  ?>
                                <div class="col-12 col-sm-6 col-lg-auto mt-3 mt-sm-0">
                                    <a class="btn <?php echo $buttonClass;?> btn-xl btn-block" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( have_rows( 'accordion' ) ) : ?>
                    <div class="accordion" id="accordionExample">
                        <?php $c=0; while ( have_rows( 'accordion' ) ) : the_row(); ?>
                            <div class="card">
                                <div class="card-header" id="heading1">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapse<?php echo $c; ?>" aria-expanded="<?php if($c == 0){ echo 'true'; } ?>"
                                                aria-controls="collapse<?php echo $c; ?>">
                                            <span class="icon-plus-light"></span>
                                            <?php the_sub_field( 'title' ); ?>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse<?php echo $c; ?>" class="collapse <?php if($c == 0){ echo 'show'; } ?>" aria-labelledby="heading<?php echo $c; ?>"
                                        data-parent="#accordionExample">
                                    <div class="card-body">
                                        <?php the_sub_field( 'content' ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php $c++; endwhile; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <div class="right-sidebar push-top">
                    <div class="placement-aside">
                        <a href="#" class="btn btn-black btn-sm"><?php the_field( 'title' ); ?></a>

                        <h3 class="placement-aside-title"><?php the_field( 'heading' ); ?></h3>
                        <?php $button = get_field( 'button' ); ?>
                        <?php if ( $button ) : ?>
                            <a class="btn btn-black btn-block reg-btn" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                        <?php endif; ?>

                        <?php if ( have_rows( 'schedule' ) ) : ?>
                            <?php while ( have_rows( 'schedule' ) ) : the_row(); ?>
                                <div class="placement-news">
                                    <small class="text-uppercase mb-1"><?php the_sub_field( 'subtitle' ); ?></small>
                                    <h4><a href="<?php $link = get_sub_field( 'link' ); ?>"><?php the_sub_field( 'title' ); ?></a></h4>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>

                        <div class="pt-4">
                            <?php the_field( 'text' ); ?>
                        </div>

                        <div class="placement-aside-footer">
                            <div class="bg-dark info-note-footer">
                                <?php the_field( 'info_note' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
