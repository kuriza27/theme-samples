<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ACFTA
 */

?>

<div class="col-12 col-md-6 col-lg-4 col-xl-3 post d-none d-md-flex">
             <div class="d-flex flex-column">
                           <div class="flex-shrink-0">
                                      <a href="#"><img class="post-img w-100" src="images/post-img-6.png" alt=""></a>
                            </div>
                           <div class="flex-grow-1 d-flex flex-column post-data">
                           <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                                        <div class="post-meta"><?php noda_acfta_posted_on();?></div>
                                        <?php the_excerpt(); ?>
                                        <a href="<?php esc_url( get_permalink() );?>" class="more-link mt-auto">View opportunity</a>
                            </div>
              </div>
</div>

