<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Livin
 */

get_header();
/*

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					
					printf( esc_html__( 'Search Results for: %s', 'livin' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
				
				while ( have_posts() ) :
					the_post();
					
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
		?>

	</main>
	<!-- #main -->
*/?>
<div class="page-content">
<section>
                <div class="container-fluid px-0 search-list-area">
                    <div class="row no-gutters">
                        <div class="col-lg-7">
                            <div class="sr-content">
                                <div class="pl-half-container border-bottom">
                                    <h3 class="h3 text-sm-left mr-3 mr-sm-0 ml-sm-3"><span class="title-selected sec text-uppercase">Search Results</span>
                                    </h3>
                                    <h1 class="mb-3"><?php the_search_query(); ?></h1>									
                                    <form action="/"  method="get" class="px-0 col-xl-11 mb-3 mb-lg-0">
                                        <label class="position-relative w-100 mb-0">
											<input type="text" class="search-input mb-0"  name="s" value="" placeholder="Search">
                                            <button type="submit" class="search-btn"><span class="icon-search"></span></button>
                                        </label>
                                    </form>
                                </div>

                                <div class="result-list">
                                    
									<?php $i=""; if ( have_posts() ) : ?>

										<!-- <header class="page-header">
											<h1 class="page-title">
												<?php
												
												printf( esc_html__( 'Search Results for: %s', 'livin' ), '<span>' . get_search_query() . '</span>' );
												?>
											</h1>
										</header> -->

										<?php
											$i=1;
											while ( have_posts() ) :
												the_post();
												
												get_template_part( 'template-parts/content', 'search' );

											endwhile;

											

										else : 
										?>
											<script>
												window.location.href = "<?php echo '/no-search-found/?search='.get_search_query();?>";
											</script>

											

									<?php	endif;
									?>
                                </div>
									
								<?php echo $i ? ea_archive_navigation() : "";?>
                                
                            </div>
                        </div>
                        <div class="col-lg-5 v-delim-l search-sidebar-options">
                            <?php dynamic_sidebar( 'sidebar-search-result-page' ); ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
			// get reusable gutenberg block:
			$gblock = get_post( 325 );
			echo apply_filters( 'the_content', $gblock->post_content );
		?>
		</div>
<?php
get_footer();
