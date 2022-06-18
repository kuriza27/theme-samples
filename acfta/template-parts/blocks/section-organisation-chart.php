<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-organisation-chart.php
 *
 * Organisational Chart Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'organisational-chart-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-organisational-chart-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="structure" class="bg-grey py-80 our-structure mobile-space <?php echo esc_attr( $classes ); ?>">
    <div class="container text-align-center">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <h2 class="mb-4"><?php the_field( 'heading' ); ?></h2>
                <?php if ( have_rows( 'organisation_chart' ) ) : ?>
                    <?php while ( have_rows( 'organisation_chart' ) ) : the_row(); ?>       
                        <?php $width = get_sub_field( 'column_width' ); ?>             
                        <div class="chart-row mb-5 pb-3">
                            <?php $teamTitle = get_sub_field( 'team_title' ); ?>
                            <?php if ( get_sub_field( 'add_columns' ) == 1 ) : ?>
                                <div class="row">
                                <?php if ( have_rows( 'members' ) ) : ?>
                                    <div class="col-xl-6">
                                        <h4 class="mb-4"><?php echo $teamTitle; ?></h4>    
                                        <div class="row gutter-22 justify-content-center">   
                                            <?php while ( have_rows( 'members' ) ) : the_row(); ?>                            
                                                <?php $link = get_sub_field( 'link' ); ?>
                                                <div class="col-lg-6 col-sm-6 col-12 d-flex mb-3 ">
                                                    <div class="bg-white text-align-center py-20 px-2 w-100 min-h-136 d-flex align-items-center">
                                                        <div class="chart-col-inner">
                                                            <?php if ( $link ) : ?>
                                                                <a class="mb-0 text-underline" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php the_sub_field( 'name' ); ?></a>
                                                            <?php else: ?>
                                                                <p class="mb-0 text-underline"><?php the_sub_field( 'name' ); ?></p>
                                                            <?php endif; ?>
                                                            <h6><?php the_sub_field( 'position' ); ?></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>  
                                        </div>
                                    </div>
                                    <?php endif; ?>  
                                    <?php $teamColumnTitle = get_sub_field( 'team_tile_column' ); ?>
                                    <?php if ( have_rows( 'members_column' ) ) : ?>  
                                    <div class="col-xl-6 padding-lg">
                                        <h4 class="mb-4"><?php echo $teamColumnTitle;?></h4>
                                        <div class="row gutter-22 justify-content-center">  
                                                <?php while ( have_rows( 'members_column' ) ) : the_row(); ?>                            
                                                <?php $link = get_sub_field( 'link_column' ); ?>
                                                <div class="col-lg-6 col-sm-6 col-12 d-flex mb-3 ">
                                                    <div class="bg-white text-align-center py-20 px-2 w-100 min-h-136 d-flex align-items-center">
                                                        <div class="chart-col-inner">
                                                            <?php if ( $link ) : ?>
                                                                <a class="mb-0 text-underline" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php the_sub_field( 'name_column' ); ?></a>
                                                            <?php else: ?>
                                                                <p class="mb-0 text-underline"><?php the_sub_field( 'name_column' ); ?></p>
                                                            <?php endif; ?>
                                                            <h6><?php the_sub_field( 'position_column' ); ?></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>  
                                        </div>
                                    </div>
                                    <?php endif; ?>
                              </div><!--/end of column-->
                            <?php else:?>
                            <h4 class="mb-4"><?php the_sub_field( 'team_title' ); ?></h4>    
                            <div class="row gutter-22 justify-content-center">        
                                <?php if ( have_rows( 'members' ) ) : ?>
                                <?php while ( have_rows( 'members' ) ) : the_row(); ?>                            
                                    <?php $link = get_sub_field( 'link' ); ?>
                                    <div class="col-lg-<?php echo $width; ?> col-sm-6 col-12 d-flex mb-3 ">
                                        <div class="bg-white text-align-center py-20 px-2 w-100 min-h-136 d-flex align-items-center">
                                            <div class="chart-col-inner">
                                                <?php if ( $link ) : ?>
                                                    <a class="mb-0 text-underline" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php the_sub_field( 'name' ); ?></a>
                                                <?php else: ?>
                                                    <p class="mb-0 text-underline"><?php the_sub_field( 'name' ); ?></p>
                                                <?php endif; ?>
                                                <h6><?php the_sub_field( 'position' ); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>  
                                <?php endif; ?>                    
                            </div>
                            <?php endif; ?>
                        </div><!--/chart-row-->
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php echo '<h3>Please add items here.</h3>'; ?>
                <?php endif; ?>      
            </div>      
        </div>
    </div>
</section>


	
	
	
	
	
	