<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ACFTA
 */

get_header();
global $post;
$pageID = $post->ID;
$mobileSidebar = get_field( 'disable_sidebar_on_mobile', $pageID)
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
