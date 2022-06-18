<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Livin
 */

get_header(); 	



$args = array(  
  'post_type' => 'page',
  'post_name__in'  => ['404-page']
);

$query =  new WP_Query( $args );

?>

	<!-- page-content -->
	<div class="page-content">
		<?php
		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) {

				$query->the_post();

				the_content();
			}
		}
		?>
	</div>
    <!-- /page-content -->

<?php
get_footer();
