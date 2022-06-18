<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ACFTA
 */

if( isset( $_GET['view'] ) && $_GET['view'] != '' ) {
    $view = $_GET['view'];
} else {
    $view = 'list';
}

$post_types = array( 
    'Pages'                      => 'page',
    'Investment and Development' => 'investment',
    'Advocacy and Research'      => 'research',
    'News'                       => 'news'
);

$req_path = explode( '?', $_SERVER['REQUEST_URI'] )[0];

$exp = explode('/', rtrim( $req_path, '/' ));
$path = $exp[count($exp) - 1];

if( get_query_var('paged') ) {
	$path = $exp[count($exp) - 3];
}

$search_word = str_replace( "-", " ", $path ); 

$paged = get_query_var('paged') == 0 ? 1 : get_query_var('paged');

set_query_var('s', $search_word);
$args = array( 
	's' 				=> $search_word,
	'posts_per_page' 	=> 12,
    'paged'             => $paged
);

if( isset($_GET['post_type']) ) {
    $args['post_type'] = get_query_var('post_type');
}

$the_query = new WP_Query( $args );

get_header();
?>
<div class="page-content">
	<section id="<?php echo esc_attr( $id ); ?>" class="header no-banner">
		<div class="header-content d-flex flex-column py-280">
			<div class="container">
				<div class="row">
					<div class="col pb-6">
						<div class="row align-items-end">
							<div class="col">
								<h3><?php esc_html_e( 'We’re sorry the page you’re looking for cannot be found...', 'noda_acfta' ); ?></h3>
								<h1 class="page-title mt-5">
									<span class="font-book d-block mb-4">Perhaps these search results might help:</span>
									<span>"<?php echo $search_word; ?>"</span>
								</h1>
							</div>							
						</div>
					</div>
					<div class="col-lg-4 d-none d-lg-block">

					</div>
				</div>
			</div>
		</div><!---/header content--->
		<hr>
	</section>
	<?php if( $view == 'list' ): ?>
	<div class="container">
		<div class="row flex-lg-row-reverse">
            <div class="col-xl-4 col-lg-5 col-12">
                <div class="right-sidebar push-top-lg">
                    <div class="placement-aside">
                        <h3>Search</h3>
                        <form action="<?php echo site_url(); ?>">
                            <ul class="list-unstyled topics-search horizontal-search filter-research-dropdown filter--search-page">
                                <li>
                                    <label class="d-block filter-research-dropdown">
                                        <span class="label-text">Select Post Type</span>
                                        <select name="post_type">
                                            <option value="">Select</option>
                                            <?php foreach($post_types as $key => $val): ?>
                                            <?php 
                                                $selected = '';
                                                if( get_query_var('post_type') == $val ) {
                                                    $selected = 'selected';
                                                }
                                            ?>
                                            <option value="<?php echo $val; ?>" <?php echo $selected; ?> ><?php echo $key;?></option>                            
                                            <?php endforeach;?>                           
                                        </select>
                                    </label>
                                </li>
                                <li>
                                    <label class="d-block" for=""><span class="label-text">Enter a search term</span>
                                    <input type="search" name="s" placeholder="Search" class="form-control" value="<?php echo get_query_var('s'); ?>">
                                    </label>
                                </li>
                                <li>
                                    <input type="hidden" name="view" value="<?php echo $view; ?>">
                                    <input type="submit" class="btn btn-black btn-block" value="Search">
                                </li>
                            </ul>
                        </form>
                    </div>

                    <div class="view-widget d-none d-lg-block">
                        <span class="label-text mb-2 d-inline-block">View </span>
                        <label class="d-flex align-items-center">
                            <span class="position-relative">
                                <div class="list-view icon-list-view"><span class="icon-list"></span></div>
                                <a href="?<?php echo http_build_query(array_merge($_GET, array( 'view' => 'grid' ))); ?>"  class="list-view icon-grid-view" data-view="grid"><span class="icon-grid1"></span></a>
                            </span>
                        </label>
                    </div>				
					
                </div>
            </div>
			<div class="col-xl-8">
				<div class="posts-list">
					<?php
                    if ( $the_query->have_posts() ) :
					/* Start the Loop */
						$count = 0;
						while ( $the_query->have_posts() ) :
							$the_query->the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search-horizontal' );
							$count++;	
						endwhile;
					else :
						get_template_part( 'template-parts/content', 'search-none' );
					endif;
					?>
				</div>
				<div class="mobile-space">
                    <nav class="post-type-pagination" aria-label="Page navigation example">
                        <ul class="pagination justify-content-sm-center">
                            <?php if( get_query_var('paged') < 2 ): ?>
                            <li class="page-item d-none d-sm-inline-block"> </li>
                            <?php endif; ?>
                            <?php echo custom_pagination( $the_query ); ?>
                        </ul>
                    </nav>
                </div>	
			</div>
		</div>
	</div><!-- /container -->
    <?php else: ?>
        <div class="post-filter-view-grid">
        <div class="container">
            <div class="mobile-space">
                <?php the_field( 'content' ); ?>                
                
                <form action="<?php echo site_url(); ?>" class="filter-form pt-3 pt-md-5">
                    <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse"
                        data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                        Search <span class="icon-chevron-thin-down ml-auto"></span>
                    </a>
                    <div class="collapse" id="filterFields">
                        <div class="row pt-md-0 pt-3 filter--search-page">
                            <div class="col-lg-4">
                                <label class="d-block filter-research-dropdown">
                                    <span class="label-text">Select Post Type</span>
                                    <select name="post_type">
                                        <option value="">Select</option>
                                        <?php foreach($post_types as $key => $val): ?>
                                        <?php 
                                            $selected = '';
                                            if( get_query_var('post_type') == $val ) {
                                                $selected = 'selected';
                                            }
                                        ?>
                                        <option value="<?php echo $val; ?>" <?php echo $selected; ?> ><?php echo $key;?></option>                            
                                        <?php endforeach;?>                           
                                    </select>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="d-block">
                                    <label for="">Enter a search term</label>
                                    <div class="d-flex">
                                        <input type="search" name="s" placeholder="Search" value="<?php echo get_query_var('s'); ?>" class="mb-0">
                                        <input type="submit" class="btn btn-black ml-2 py-2" value="Search">
                                    </div>
                                    <input type="hidden" name="view" value="<?php echo $view; ?>">
                                </label>
                            </div>

                            <div class="col-lg-auto">
                                <label class="d-none d-lg-block">
                                    <span class="label-text">View </span>
                                    <span class="position-relative">
                                        <a href="?<?php echo http_build_query(array_merge($_GET, array( 'view' => 'list' ))); ?>" class="list-view icon-list-view" data-view="list"><span class="icon-list"></span></a>
                                        <div class="list-view icon-grid-view"><span class="icon-grid1"></span></div>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="post-type-results-info" style="display: none;"></div>
                    </div>
                </form>
            </div>
        </div>

        <hr class="hr mb-0">
        
        <div class="container open-closed-list list-main-container">
            <?php if ( $the_query->have_posts() ) : ?>
            <div class="posts-list alt no-gutters row pt-0">
                <?php                    
					/* Start the Loop */
                    $count = 0;
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', 'search-grid' );
                        $count++;	
                    endwhile;					
				?>
            </div>    
            <?php
            else :
                get_template_part( 'template-parts/content', 'search-none' );
            endif; ?>
            <div class="mobile-space">
                <nav class="post-type-pagination border-top-0" aria-label="Page navigation example">
                    <ul class="pagination justify-content-sm-center">
                        <?php if( get_query_var('paged') < 2 ): ?>
                        <li class="page-item d-none d-sm-inline-block"> </li>
                        <?php endif; ?>
                        <?php echo custom_pagination( $the_query ); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
 
<?php
get_footer();
