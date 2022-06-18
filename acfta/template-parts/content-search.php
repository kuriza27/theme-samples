<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ACFTA
 */

?>
<div class="col-12 col-md-6 col-lg-4 col-xl-3 post d-flex">
    <div class="d-flex flex-column">
        <div class="flex-shrink-0">
            <?php $size='447X650';?>
            <a href="<?php echo get_permalink();?>"><?php  the_post_thumbnail($size,['class' => 'post-img w-100']);  ?></a>
        </div>
        <div class="flex-grow-1 d-flex flex-column post-data">
            <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
            <div class="post-meta"><?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></div>
            <?php 
            $excerpt = get_the_excerpt();
            $excerpt = substr($excerpt, 0, 200);
            echo $excerpt; 
            ?>                        
            <a href="<?php echo get_permalink();?>" class="more-link mt-auto">Read More</a>
        </div>
    </div>
</div>


