<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Livin
 */

$banner = get_the_post_thumbnail_url( $post->ID, '1920x826' );
$bannerFeaturedImage = get_field('banner_featured_image');

if( $bannerFeaturedImage ){
	get_header('', array('class' => 'header-cover', 'banner' => $banner, 'breadcrumbs' => true, 'bodyClass' => 'blog-page', 'banner_featured_image' => $bannerFeaturedImage ));
} else {
	get_header('', array('breadcrumbs' => true, 'textColor' => 'text-black', 'class' => 'white-header', 'bodyClass' => 'blog-page', 'banner_featured_image' => $bannerFeaturedImage ));
}

?>
<style>
	.show-comment{
		background-color:<?php the_field( 'comment_button_background_color', 'option' ); ?>!important;
		color:<?php the_field( 'comment_button_text_color', 'option' ); ?>!important;
		border-color:<?php the_field( 'comment_button_background_color', 'option' ); ?>!important;
	}

	.show-comment:hover{
		background-color:<?php the_field( 'comment_button_background_hover_color', 'option' ); ?>!important;
		color:<?php the_field( 'comment_button_text_hover_color', 'option' ); ?>!important;
		border-color:<?php the_field( 'comment_button_background_hover_color', 'option' ); ?>!important;
	}
</style>


	<!-- page-content -->
	<div class="page-content blog-single-sm-font <?php if(!$bannerFeaturedImage){ echo 'blog-no-featured-image'; } ?>">		

		<?php
		while ( have_posts() ) :
			the_post();

			$category_name = !empty(get_the_category($post->ID)) ? get_the_category($post->ID)[0]->cat_name : '';
			$post_type = get_post_type_object( get_post_type( $post->ID ) );
			$post_type_label = $post_type->labels->name;
			$post_in = ($category_name) ? $category_name : $post_type_label;
		?>

		<?php if ( get_field( 'hide_sidebar' ) == 1 ) : ?>		
		<section class="single-column-section blog-single-post">
			<div class="container-sm animate-children">
				<div class="text-md-center mt-5 pt-4">
					<h3 class="h3 text-uppercase in-header-title"><span
							class="title-selected sec"><?php echo $post_type_label; ?></span></h3>
					<h1 class="mb-3"><?php the_title(); ?></h1>
					<div class="d-none d-md-block"><small><?php echo do_shortcode('[rt_reading_time label="" postfix="Minutes" postfix_singular="Minute"]'); ?> Read | Posted in <u><?php echo $post_in; ?></u> | Posted during <u><?php echo get_the_date('F j, Y'); ?></u></small></div>
					<div class="d-md-none"><small><?php echo do_shortcode('[rt_reading_time label="" postfix="Minutes" postfix_singular="Minute"]'); ?> Read <br> Posted in <u><?php echo $post_in; ?></u> <br> Posted during <u><?php echo get_the_date('F j, Y'); ?></u></small></div>
				</div>
				<div class="content-admin pr-0 pt-4 pb-0 animate-children">
					<?php if(!$bannerFeaturedImage): ?>
					<div class="featured-image-blog-content text-center mb-4">
						<?php echo get_the_post_thumbnail( $post->ID, 'full'); ?>
					</div>
					<?php endif; ?>
					<div class="podcast-feed my-5">
						<?php echo do_shortcode("[powerpress]"); ?>
					</div>
					<?php the_content(); ?>
				</div>
			</div>
		</section>
		<?php else: ?>
			<section class="blog-single-post">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 pr-lg-0 animate-children <?php if(!$bannerFeaturedImage){ echo 'mt-5 pt-5'; } ?>">
							<h3 class="h3 text-uppercase in-header-title text-center text-md-left"><span class="title-selected sec"><?php echo $post_type_label; ?></span>
							</h3>
							<h1 class="mb-3"><?php the_title(); ?></h1>
							<p class="post-meta mb-lg-4">
								<span><small><?php echo do_shortcode('[rt_reading_time label="" postfix="Minutes" postfix_singular="Minute"]'); ?> Read</small></span> <span class="delim">|</span>
								<span><small>Posted in <u><?php echo $post_in; ; ?></u></small></span> <span class="delim">|</span>
								<span><small>Posted during <u><?php echo get_the_date('F j, Y'); ?></u></small></span>
							</p>

							<div class="content-admin animate-children">
								<?php if(!$bannerFeaturedImage): ?>
								<div class="featured-image-blog-content text-center mb-4">
									<?php echo get_the_post_thumbnail( $post->ID, 'full'); ?>
								</div>
								<?php endif; ?>
								<div class="podcast-feed">
									<?php echo do_shortcode("[powerpress]"); ?>
								</div>
								<?php the_content(); ?>
							</div>

							<div class="widget-left border-top animate-children">
								<a href="#" class="btn btn-primary show-comment">Leave a comment</a>

								<div id="disqus-comment" class="mt-5 comment-section">
									<div class="row justify-content-center">
										<div class="col-sm-12">
											<div class="comment-container">
												<?php
												// If comments are open or we have at least one comment, load up the comment template.
												if ( comments_open() || get_comments_number() ) :
													comments_template();
												endif;
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 v-delim-l">
							<aside class="sidebar blog-single-sidebar d-flex flex-column animate-children">
								<?php
								dynamic_sidebar(); ?>
							</aside>
						</div>
					</div>
				</div>
			</section>		
		<?php endif; ?>

		<?php
		endwhile; // End of the loop.
		?>

		<?php if ( get_field( 'hide_sidebar', $post->ID ) == 1 ) : ?>		
		<section class="join-conversation border-top section-padding">
			<div class="container text-center animate-children">
				<h2 class="title-50">Join the <br class="d-none d-lg-inline">
					Conversation</h2>
				<a href="#" class="btn btn-primary show-comment">Leave a comment</a>

				
				<div id="disqus-comment" class="mt-5 comment-section">
					<div class="row justify-content-center">
						<div class="col-md-8 col-sm-12">
							<div class="comment-container">
								<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php
		$tags = wp_get_post_tags($post->ID);
		$args = array(
			'post_type' 		=> get_post_type( $post->ID ),
			'post__not_in' 		=> array( $post->ID ),
			'posts_per_page' 	=> 3,
			'orderby'			=> 'rand'
		);
		$my_query = new wp_query( $args );
		if ($my_query) :
			$category_name = !empty(get_the_category($post->ID)) ? get_the_category($post->ID)[0]->cat_name : '';
			$post_type = get_post_type_object( get_post_type( $post->ID ) );
			$post_type_label = $post_type->labels->name;
			$post_in = ($category_name) ? $category_name : $post_type_label;
		?>		
		<section class="related-post-section position-relative" id="target1">
			<div class="anchor">
				<a href="#target1"></a>
			</div>
			<div class="container animate-children">
				<div class="text-center">
					<h3 class="h3 text-uppercase"><span class="title-selected sec"><?php echo $post_type_label; ?></span></h3>
					<h2 class="title-50">Related Articles</h2>
				</div>
				<div class="row rel-articles-list">
					<?php
					while( $my_query->have_posts() ) :
						$my_query->the_post(); ?>
					<div class="col-md-4 sl d-flex mb-4 mb-md-0">
						<article class="post-article d-flex flex-column align-items-start">
							<a href="<?php the_permalink(); ?>" class="d-block w-100">
								<?php the_post_thumbnail('402x266', array('class'=>'post-article-img')); ?>
							</a>
							<small><?php echo do_shortcode('[rt_reading_time label="" postfix="Minutes" postfix_singular="Minute"]'); ?> Read | Posted in <u><?php echo $post_in; ?></u></small>
							<div class="d-flex flex-column justify-content-space-between mb-auto">
								<h3 class="title-40 pt-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="flex-grow-1 pb-2">
									
									<p><?php echo shorten_text(get_the_excerpt(),130  );?></p>
								</div>
							</div>
								<a href="<?php the_permalink(); ?>" class="title-bordered d-inline-block sm">Continue reading</a>							
						</article>
					</div>
					<?php 
					endwhile; ?>
				</div>
			</div>
		</section>
		<?php 
		wp_reset_query();
		endif; ?>

		<?php
			// get reusable gutenberg block:
			$gblock = get_post( 325 );
			echo apply_filters( 'the_content', $gblock->post_content );
		?>

	</div>
    <!-- /page-content -->

<?php
//get_sidebar();
get_footer();
