<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACFTA
 */

get_header();
?>

	<!-- page-content -->
    <div class="research-single-post">		

		<?php
            while ( have_posts() ) :
                the_post();
            
                the_content();
        
            endwhile; // End of the loop. 
		?>
        
        
	</div>
    <!-- /page-content -->
   
<?php
get_footer();
