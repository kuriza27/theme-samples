
<?php
$id = 'faqs-accordion-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-faqs-accordion';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
$targetID = get_field( 'target_id' );
?>
<section id="<?php echo esc_attr( $id ); ?>" class="bg-grey py-80 <?php echo $classes; ?>">
<div id="<?php echo $targetID; ?>">
    <!--container--->    
    <div class="container">
        <div class="row justify-content-<?php the_field( 'position' ); ?>">
            <?php if ( have_rows( 'accordion' ) ) : ?>
                <div class="col-lg-12 col-xl-8">
                        <?php $i=1;while ( have_rows( 'accordion' ) ) : the_row(); ?>
                        <div class="accordion-list questions-list bg-white"><!---accordion-list---> 
                            <h2 class="mb-4"><?php the_sub_field( 'heading' ); ?></h2>
                          <div class="accordion" id="accordionExample<?php echo  esc_attr( $id ).$i;?>">
                            <?php if ( have_rows( 'content' ) ) : ?>
                                <?php $c=1;while ( have_rows( 'content' ) ) : the_row(); ?>
                                <div class="card"> <!---card---> 
                                        <div class="card-header" id="heading<?php echo esc_attr( $id ).$i.$c;?>">
                                            <h5 class="mb-4">
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#collapse0<?php echo esc_attr( $id ).$i.$c;?>" aria-expanded="false"
                                                        aria-controls="collapse0<?php echo esc_attr( $id ).$i.$c;?>">
                                                    <span class="icon-plus-light"></span>
                                                    <?php the_sub_field( 'questions' ); ?>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse0<?php echo esc_attr( $id ).$i.$c;?>" class="collapse" aria-labelledby="heading<?php echo $i.$c;?>"
                                             >
                                            <div class="card-body">
                                                        <?php the_sub_field( 'answer' ); ?>
                                                        <?php if ( get_sub_field( 'enable_inner_accordion' ) == 1 ) : ?>
                                                            <?php if ( have_rows( 'inner_content' ) ) : ?>
                                                                <?php $j=1;while ( have_rows( 'inner_content' ) ) : the_row(); ?>
                                                                    <div class="accordion" id="inneraccordionExample<?php echo esc_attr( $id ).$i.$c.$j; ?>">
                                                                        <div class="card">
                                                                                <div class="card-header" id="inner-question<?php echo esc_attr( $id ).$i.$j; ?>">
                                                                                    <h5 class="mb-0">
                                                                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                                                                data-target="#inner-question-collapse<?php echo esc_attr( $id ).$i.$c.$j; ?>" aria-expanded="false"
                                                                                                aria-controls="inner-question-collapse<?php echo esc_attr( $id ).$i.$j; ?>">
                                                                                            <span class="icon-plus-light"></span>
                                                                                            <?php the_sub_field( 'inner_questions' ); ?>
                                                                                        </button>
                                                                                    </h5>
                                                                                </div>
                                                                                <div id="inner-question-collapse<?php echo esc_attr( $id ).$i.$c.$j; ?>" class="collapse" aria-labelledby="inner-question<?php echo esc_attr( $id ).$i.$j; ?>">
                                                                                    <div class="card-body">
                                                                                        <?php the_sub_field( 'inner_answer' ); ?>
                                                                                    </div>
                                                                                </div>
                                                                        </div><!--/inner-card-->
                                                                    </div>
                                                                <?php $j++; endwhile; ?>
                                                            <?php endif; ?> 
                                                     <?php endif; ?>
                                            </div>
                                        </div>
                                </div> <!---/card---> 
                                <?php $c++;endwhile; ?>
                                <?php endif; ?>
                          </div>
                        </div><!---/accordion-list--->
                    <?php $i++;endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div><!--/container--->
 </div>
</section>