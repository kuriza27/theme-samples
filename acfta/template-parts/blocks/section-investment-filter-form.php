<?php
$id = 'search-posts-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$classes = $block['className'];

$term_args = array(
    'post_type'              => 'investment',
    'taxonomy'               => 'application_type',
    'hide_empty'             => false
);
$typeApp = new WP_Term_Query( $term_args );

$term_args2 = array(
    'post_type'              => 'investment',
    'taxonomy'               => 'funding_type',
    'hide_empty'             => false
);
$typeFun = new WP_Term_Query( $term_args2 );

$term_args3 = array(
    'post_type'              => 'investment',
    'taxonomy'               => 'artform',
    'hide_empty'             => false
);
$typeArt = new WP_Term_Query( $term_args3 );
?>
<section id="<?php echo esc_attr( $id ); ?>" class="selects-section pb-5 <?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <div class="mobile-space">
            <?php the_field( 'content' ); ?>
            
            <form action="<?php echo get_permalink( get_page_by_path( 'investment-and-development' ) ); ?>#anchor-investment-filter-results" class="filter-form filter--form pt-3 pt-md-5">
                <a href="#" class="d-flex d-lg-none align-items-center mb-2" data-toggle="collapse"
                    data-target="#filterFields" aria-expanded="false" aria-controls="filterFields">Filter
                    Search <span class="icon-chevron-thin-down ml-auto"></span>
                </a>
                <div class="collapse" id="filterFields">
                    <div class="row pt-md-0 pt-3">
                        <div class="col-xl col-lg-6">
                            <label class="d-block filter-research-dropdown max-width-4">
                                <span class="label-text" id="FilterByApplicationType">Filter by Application type</span>
                                <select name="application_type[]" aria-labelledby="FilterByApplicationType" multiple>
                                    <?php foreach($typeApp->terms as $rsA): ?>
                                    <option value="<?php echo $rsA->name;?>"><?php echo $rsA->name;?></option>                            
                                    <?php endforeach;?>                           
                                </select>
                            </label>
                        </div>
                        <div class="col-xl col-lg-6">
                            <label class="d-block filter-research-dropdown max-width-4">
                                <span class="label-text" id="FilterByFundingType">Filter by Funding Type</span>
                                <select name="funding_type[]" aria-labelledby="FilterByFundingType" multiple>
                                    <?php foreach($typeFun->terms as $rsF): ?>
                                    <option value="<?php echo $rsF->name;?>"><?php echo $rsF->name;?></option>                            
                                    <?php endforeach;?> 
                                </select>
                            </label>
                        </div>
                        <div class="col-xl col-lg-6">
                            <label class="d-block filter-research-dropdown max-width-4">
                                <span class="label-text" id="FilterByArtform">Filter by artform</span>
                                <select name="artform[]" aria-labelledby="FilterByArtform" multiple>
                                    <?php foreach($typeArt->terms as $rsArt): ?>
                                    <option value="<?php echo $rsArt->name;?>"><?php echo $rsArt->name;?></option>                            
                                    <?php endforeach;?> 
                                </select>
                            </label>
                        </div>
                        <div class="col-xl col-lg-6">
                            <label class="d-block">
                                <span class="label-text" id="SearchByTitle">Search by title</span>
                                <span class="position-relative">
                                    <input type="text" aria-labelledby="SearchByTitle" aria-label="Search Field" placeholder="Enter title" name="title" value="">
                                    <button class="search-input-btn search-input-btn-grid" aria-label="Search Icon">
                                        <span class="icon-search"></span>
                                    </button>
                                </span>
                            </label>
                        </div>

                        <div class="col-xl-auto col-lg-6 offset-xl-0 offset-lg-3">
                            <label class="d-block" aria-label="Search">
                                <span class="label-text d-xl-block d-none fade">Search</span>
                            </label>                            
                            <input type="submit" aria-label="Search Button" class="btn btn-black btn-block" value="Search">
                        </div>
                    </div>
                    <div class="post-type-results-info" style="display: none;"></div>
                </div>
            </form>
        </div>
    </div>
</section>