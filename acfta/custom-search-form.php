<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ACFTA
 */

get_header();
?>

<div class="page-content">
    <?php if ( have_posts() ) : ?>
        <header class="page-header header-content">
            <div class="container">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'noda_acfta' ), '<br><span>"' . get_search_query() . '"</span>' );
                    ?>
                </h1>
                <br>
            </div>	
        </header><!-- .page-header -->
        <div style="border-top:2px solid #D4D4D4"></div>

        <div class="post-filter-view-grid">
            <div class="container">
                <form action="<?php echo get_site_url(); ?>" method="get" id="searchform" role="search" data-action="loadPage"  class="filter-form pt-3 pt-md-5">
                    <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse"
                        data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                        Search <span class="icon-chevron-thin-down ml-auto"></span>
                    </a>
                    <div class="collapse" id="filterFields">
                        <div class="row pt-md-0 pt-3">
                            <div class="col-lg">
                                <label class="d-block">
                                    <span class="label-text">Search by title</span>
                                    <span class="position-relative">
                                        <input type="text" placeholder="Enter title" name="s" id="s" value="<?php the_search_query(); ?> ">
                                        <button class="search-input-btn search-input-btn-grid">
                                            <span class="icon-search"></span>
                                        </button>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-auto">
                                <label class="d-none d-lg-block">
                                    <span class="label-text">View </span>
                                    <span class="position-relative">
                                        <a href="javascript:void(0);" class="list-view icon-list-view" data-view="list"><span class="icon-list"></span></a>
                                        <div class="list-view icon-grid-view"><span class="icon-grid1"></span></div>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    else :

        get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>
</div>

<?php
//get_sidebar();
get_footer();