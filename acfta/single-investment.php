<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACFTA
 */

get_header();
global $post;
$pageID = $post->ID;
$mobileSidebar = get_field( 'disable_sidebar_on_mobile', $pageID);
?>

	<!-- page-content -->
    <div class="page-content">		

		<?php
		while ( have_posts() ) :
			the_post();
		
			the_content();
		endwhile; // End of the loop. 
		?>
		<div class="container <?php if($mobileSidebar==0):?>d-none <?php endif;?>d-lg-none">
			<div class="footer-sidebar"></div>
		</div>
	</div>
    <!-- /page-content -->

<?php
get_footer();
