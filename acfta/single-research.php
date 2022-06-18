<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACFTA
 */

get_header();

$this_post = get_post();
$blocks = parse_blocks($this_post->post_content);

$new_class = '';
foreach ($blocks as $block) {
	if ($block['blockName'] == 'acf/page-header') {
		$new_class = 'header-banner--black';
	} else if( $block['blockName'] == 'acf/page-header-single-post' ) {
        $new_class = 'header-banner--black';
    } else if( $block['blockName'] == 'acf/page-header-fullwidth-no-sidebar' ) {
        $new_class = 'header-banner--black';
    } else if( $block['blockName'] == 'acf/page-basic-header' ) {
        $new_class = 'header-banner--black';
    }
}

//var_dump($blocks);
?>

	<!-- page-content -->
    <div class="research-single-post <?php echo $new_class; ?>">		

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
