<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ACFTA
 */
global $wp_query;

$filters = array(
    'posts_per_page' => 12
);

if( isset( $_GET['view'] ) && $_GET['view'] != '' ) {
    $view = $_GET['view'];
} else {
    $view = 'list';
}

if( isset($_GET['post_type']) ) {
    $filters['post_type'] = get_query_var('post_type');
}

$filters['meta_query'] = array(
    'relation'  => 'OR',
    array(
        'key'       => 'exclude_in_search',
        'compare'   => '!=',
        'value'     => 1,
    ),
    array(
        'key'       => 'exclude_in_search',
        'compare'   => 'NOT EXISTS',
    )
);

query_posts( 
    wp_parse_args(
        $wp_query->query,
        $filters
    )
);

$post_types = array( 
    'Pages'                      => 'page',
    'Investment and Development' => 'investment',
    'Advocacy and Research'      => 'research',
    'News'                       => 'news'
);

$query_var_s = htmlspecialchars(get_query_var('s'), ENT_QUOTES, 'UTF-8');

get_header();
?>
<div class="page-content">
	<header class="page-header header-content">
		<div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-12 text-break">
                    <h1 class="page-title">
                        <?php
                        /* translators: %s: search query. */
                        $search_query = htmlspecialchars(get_search_query(), ENT_QUOTES, 'UTF-8');
                        printf( esc_html__( 'Search Results for: %s', 'noda_acfta' ), '<br><span>"' . $search_query . '"</span>' );
                        ?>
                    </h1>
                    <br>
                </div>
            </div>
		</div>	
	</header><!-- .page-header -->
	<div style="border-top:2px solid #D4D4D4"></div>
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
                                    <input type="search" name="s" placeholder="Search" class="form-control" value="<?php echo $query_var_s; ?>">
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
                    if ( have_posts() ) :
					/* Start the Loop */
						$count = 0;
						while ( have_posts() ) :
							the_post();

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
                            <?php echo custom_pagination(); ?>
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
                                        <input type="search" name="s" placeholder="Search" value="<?php echo $query_var_s; ?>" class="mb-0">
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
            <?php if ( have_posts() ) : ?>
            <div class="posts-list alt no-gutters row pt-0">
                <?php                    
					/* Start the Loop */
                    $count = 0;
                    while ( have_posts() ) :
                        the_post();

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
                        <?php echo custom_pagination(); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div><!-- /page-content -->
<?php
//get_sidebar();
get_footer();
