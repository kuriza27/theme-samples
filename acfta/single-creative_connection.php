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
    <div class="page-content">		

		<?php
		while ( have_posts() ) :
			the_post();
		
			the_content();
		endwhile; // End of the loop. 
		?>
		<div class="container d-md-block d-lg-none d-xl-none">
			<div class="footer-sidebar"></div>
		</div>
	</div>
    <!-- /page-content -->

<?php
get_footer();
