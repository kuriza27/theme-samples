<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-fopen-job-list.php
 *
 * Job List Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'job-list-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-job-list';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<section class="bg-grey py-80 <?php echo esc_attr( $classes ); ?> job-list-container">
    <div class="container">
         <!--- row --->
        <div class="row">    
                <div class="col-lg-12 col-xl-10">
                    <h2 class="mb-4 mobile-space"><?php the_field( 'section_title' ); ?></h2>
                    <?php if ( have_rows( 'jobs' ) ) : ?>
                    <?php while ( have_rows( 'jobs' ) ) : the_row(); ?>
                    <?php $job_list_link = get_sub_field( 'job_list_link' ); ?>
                        <?php if ( $job_list_link ) : ?>
                            <a href="<?php echo esc_url( $job_list_link['url'] ); ?>" class="col-lg-11" target="<?php echo esc_attr( $job_list_link['target'] ); ?>">
                            <?php 
                                $today = strtotime( 'now' );
                                $closing_date =  strtotime(get_sub_field( 'closing_date' ));
                            ?>
                                <div class="career-list bg-white col-lg-12 col-xl-10 <?php if($today > $closing_date):?>exp-app<?php endif;?>">
                                    <h3> <?php the_sub_field( 'job_title' ); ?></h3>
                                    <p><span class="light-grey-text">Closing date: <?php the_sub_field( 'closing_date' ); ?></span></p>
                                    <p><?php the_sub_field( 'job_description' ); ?></p>
                                    <div class="row">
                                        <div class="col-sm-3 info-box">
                                            <p><b>Job Category</b><br>
                                            <span> <?php the_sub_field( 'job_category' ); ?></span></p>
                                        </div>
                                        <div class="col-sm-3 info-box">
                                            <p><b>Location</b><br>
                                            <span class=""><?php the_sub_field( 'location' ); ?></span></p>
                                        </div>
                                        <div class="col-sm-3 info-box">
                                            <br>
                                                <p class="text-break btn--dark btn-more-info">More Information <span class="icon-plus-light"></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                         <?php else : ?>
                            <?php 
                                $today = strtotime( 'now' );
                                $closing_date =  strtotime(get_sub_field( 'closing_date' ));
                            ?>
                            <div class="career-list bg-white col-lg-10 <?php if($today > $closing_date):?>exp-app<?php endif;?>">
                                <h3> <?php the_sub_field( 'job_title' ); ?></h3>
                                <p><span class="light-grey-text">Closing date: <?php the_sub_field( 'closing_date' ); ?></span></p>
                                <p><?php the_sub_field( 'job_description' ); ?></p>
                                <div class="row">
                                    <div class="col-sm-3 info-box">
                                        <p><b>Job Category</b><br>
                                        <span> <?php the_sub_field( 'job_category' ); ?></span></p>
                                    </div>
                                    <div class="col-sm-3 info-box">
                                        <p><b>Location</b><br>
                                        <span class=""><?php the_sub_field( 'location' ); ?></span></p>
                                    </div>
                                    <div class="col-sm-3 info-box">
                                        <br>
                                            <p class="text-break btn--dark btn-more-info">More Information <span class="icon-plus-light"></span>
                                    </div>
                                </div>
                            </div>
                         <?php endif; ?>    
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
        </div>
        <!---/row----->
    </div>
</section>