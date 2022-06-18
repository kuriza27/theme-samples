<?php

add_theme_support('align-wide');

function load_custom_wp_admin_style() {
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/admin-style.css', array(), _S_VERSION);
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), _S_VERSION, true);
    wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), _S_VERSION, true );
    wp_enqueue_script('custom', get_template_directory_uri() . '/js/admin/custom.js', array(), _S_VERSION, true);
}
add_action('acf/input/admin_enqueue_scripts', 'load_custom_wp_admin_style');

function custom_block_categories($categories, $post) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'acf-custom-blocks',
                'title' => __('Custom Blocks', 'acf'),
            ),
        )
    );
}
add_filter('block_categories', 'custom_block_categories', 10, 2);

function register_blocks() {
    // check function exists
    if (function_exists('acf_register_block')) {
        // Home Banner Carousel
        acf_register_block(array(
            'name'              => 'home-banner-carousel',
            'title'             => __('Home Banner Carousel'),
            'description'       => __('Homepage banner carousel section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-home-banner-carousel.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('banner, home, carousel, slider')
        ));

        // Home Carousel
        acf_register_block(array(
            'name'              => 'home-carousel',
            'title'             => __('Home Carousel'),
            'description'       => __('Homepage image and text carousel section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-home-carousel.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('home, carousel, slider')
        ));

        // 2 column content feed
        acf_register_block(array(
            'name'              => 'content-feed-2-column',
            'title'             => __('2 Column Content Feed'),
            'description'       => __('Display 2 column image and text grid section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-2-column-content-feed.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('home, content, feed, column')
        ));

        // boxed content with image
        acf_register_block(array(
            'name'              => 'boxed-content-with-image',
            'title'             => __('Boxed Content with Image'),
            'description'       => __('Display boxed content with image section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-boxed-content-with-image.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('home, content, boxed, image')
        ));

        // 2 column heading and content
        acf_register_block(array(
            'name'              => 'heading-content-2-column',
            'title'             => __('2 Column Heading and Content'),
            'description'       => __('Display 2 column heading and content.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-2-column-heading-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('home, content, heading, column')
        ));

        // 2 column heading and content
        acf_register_block(array(
            'name'              => 'heading-content-2-column',
            'title'             => __('2 Column Heading and Content'),
            'description'       => __('Display 2 column heading and content.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-2-column-heading-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('home, content, heading, column')
        ));

        // search posts
        acf_register_block(array(
            'name'              => 'search-posts',
            'title'             => __('Search Investment & Development'),
            'description'       => __('Display filter/search of posts in Investment and development.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-search-posts.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('opportunity, investment, filter, search, posts')
        ));

        // search posts with cards
        acf_register_block(array(
            'name'              => 'search-posts-cards',
            'title'             => __('Search Posts with Cards'),
            'description'       => __('Display filter/search of posts with cards.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-search-post-with-card.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('opportunity, investment, filter, search, posts')
        ));

        // post banner
        acf_register_block(array(
            'name'              => 'post-banner',
            'title'             => __('Post Banner'),
            'description'       => __('Display single post banner.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-post-banner.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('banner, single, post')
        ));

        // content with right sidebar
        acf_register_block(array(
            'name'              => 'content-right-sidebar',
            'title'             => __('Content with Right Sidebar (Schedule)'),
            'description'       => __('Display content with right sidebar (schedule).'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-content-with-sidebar.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content', 'right sidebar', 'opportunity')
        ));

        // FAQs Accordion
        acf_register_block(array(
            'name'              => 'faqs-accordion',
            'title'             => __('FAQs Accordion'),
            'description'       => __('Display FAQs in accordion.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-faqs-accordion.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('faq', 'accordion', 'opportunity', 'investment')
        ));

        // Page Banner
        acf_register_block(array(
            'name'              => 'page-banner',
            'title'             => __('Page Banner'),
            'description'       => __('Display page banner.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-page-banner.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('banner', 'page', 'development', 'investment')
        ));

        // Page Banner Version 2
        acf_register_block(array(
            'name'              => 'page-banner-v2',
            'title'             => __('Page Banner V2'),
            'description'       => __('Display page banner version2'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-page-banner-v2.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('banner', 'page', 'ceo', 'meet the ceo')
        ));

        // Link Cards
        acf_register_block(array(
            'name'              => 'link-cards',
            'title'             => __('Link Cards'),
            'description'       => __('Display link cards.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-link-cards.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('cards', 'links', 'pages')
        ));

        // Fullwidth Content
        acf_register_block(array(
            'name'              => 'fullwidth-content',
            'title'             => __('Fullwidth Content'),
            'description'       => __('Display full width content.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-full-width-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('about', 'fullwidth', 'content')
        ));

        // Page Header
        acf_register_block(array(
            'name'              => 'page-header',
            'title'             => __('Page Header'),
            'description'       => __('Display page header title'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-page-header.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('title', 'header', 'page')
        ));

        // Content with Side Menu
        acf_register_block(array(
            'name'              => 'content-side-menu',
            'title'             => __('Content with Right Side Menu Options'),
            'description'       => __('Display content with right side menu options'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-content-side-menu.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('side menu', 'content', 'right side')
        ));

        // Content with Side Menu Version 2
        acf_register_block(array(
            'name'              => 'content-side-menu-v2',
            'title'             => __('Content with Right Side Menu V2'),
            'description'       => __('Display content with right side menu v2 with no margin top'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-content-side-menu-v2.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('side menu', 'content', 'right side')
        ));

         // Job List
        acf_register_block(array(
            'name'              => 'job-list',
            'title'             => __('Job Vacancies'),
            'description'       => __('Display all job vacancies'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-open-job-list.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('job', 'list', 'vacancies')
        ));

        // Media Coverage
        acf_register_block(array(
            'name'              => 'media-coverage',
            'title'             => __('Media Coverage'),
            'description'       => __('Display all media coverage'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-media-coverage.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('media', 'coverage')
        ));


        // Related Search Slider Section
        acf_register_block(array(
            'name'              => 'related-search-slider',
            'title'             => __('Related Search Slider'),
            'description'       => __('Display all related search slider'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-related-search.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('search', 'slider')
        ));

        // Content without sidebr
        acf_register_block(array(
            'name'              => 'content-without-sidebar',
            'title'             => __('Content without Sidebar'),
            'description'       => __('Display Content without sidebar'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-content-without-sidebar.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content', 'sidebar')
        ));

        // Center Section with button
        acf_register_block(array(
            'name'              => 'center-with-button',
            'title'             => __('Center Section with button'),
            'description'       => __('Display section center with button'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-center-with-button.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content', 'section')
        ));

        // Box Content with Image on the left
        acf_register_block(array(
            'name'              => 'box-image-left',
            'title'             => __('Box Content with Image on the left'),
            'description'       => __('Display Content with Image on the left'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-box-left-image.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('box', 'image')
        ));

        // Corporate Organisational Structure
        acf_register_block(array(
            'name'              => 'organisational-chart-section',
            'title'             => __('Organisational Structure Section'),
            'description'       => __('Display Organisational Structure chart'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-organisation-chart.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('chart', 'organisation','structure','corporate')
        ));

        // Page Basic Header
        acf_register_block(array(
            'name'              => 'page-basic-header',
            'title'             => __('Page Basic Header'),
            'description'       => __('Display page basic header'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-page-basic-header.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('basic', 'page')
        ));

         // Page Basic Content
         acf_register_block(array(
            'name'              => 'page-basic-content',
            'title'             => __('Page Basic Content'),
            'description'       => __('Display page basic content'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-content-basic.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('basic', 'page')
        ));

        // Useful Links
        acf_register_block(array(
            'name'              => 'useful-links-section',
            'title'             => __('Useful Links Section'),
            'description'       => __('Display useful links section'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-useful-link.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('useful', 'links')
        ));

        // Useful Links Modal
        acf_register_block(array(
            'name'              => 'useful-links-modal',
            'title'             => __('Useful Links Modal'),
            'description'       => __('Display useful links modal section'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-useful-links-modal.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('useful', 'links', 'modal')
        ));

        // Full Video Section 
        acf_register_block(array(
            'name'              => 'full-video-section',
            'title'             => __('Full Width Video Section'),
            'description'       => __('Display full width video section'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-full-video-block.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('video', 'full')
        ));

         // Facilitator Section
         acf_register_block(array(
            'name'              => 'facilitator-section',
            'title'             => __('Facilitator Section'),
            'description'       => __('Display facilitator section'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-facilitator-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('facilitators', 'leaders','team')
        ));

        // Gallery Section
        acf_register_block(array(
            'name'              => 'masonry-gallery-section',
            'title'             => __('Masonry Gallery Section'),
            'description'       => __('Display masonry gallery section'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-masonry-gallery.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('gallery', 'images','masonry')
        ));

        // Resource Section
        acf_register_block(array(
            'name'              => 'resource-section',
            'title'             => __('Resource Section'),
            'description'       => __('Display resource section'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-resource-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('resources', 'resource','tools')
        ));

        // Page Banner V3
        acf_register_block(array(
            'name'              => 'page-banner-v3',
            'title'             => __('Page Banner V3'),
            'description'       => __('Display page banner v3'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-page-banner-v3.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('banner', 'page','media')
        ));

         // Contact and Download Section
         acf_register_block(array(
            'name'              => 'contact-download',
            'title'             => __('Contact and Download Section'),
            'description'       => __('Display contact and download section'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-contact-download.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('contact', 'download')
        ));

        // Digital Events Section
        acf_register_block(array(
            'name'              => 'digital-events-section',
            'title'             => __('Digital Event Section'),
            'description'       => __('Display digital events'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-digital-events.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('contact', 'download')
        ));

        // Page Header Full width no sidebar 
        acf_register_block(array(
            'name'              => 'page-header-fullwidth-no-sidebar',
            'title'             => __('Page Header Full width No Sidebar'),
            'description'       => __('Display page header full width with no sidebar'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-page-header-fullwidth-no-sidebar.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('title', 'header', 'page')
        ));

        // Page Header Single Post
        acf_register_block(array(
            'name'              => 'page-header-single-post',
            'title'             => __('Page Header Single Post'),
            'description'       => __('Display page header single post'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-page-header-single-post.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('title', 'header', 'post')
        ));

        // Media Post Content
        acf_register_block(array(
            'name'              => 'media-post-content',
            'title'             => __('Media Post Content'),
            'description'       => __('Display media post type content'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-content-media.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('media', 'post')
        ));

        // Research Single Post Content
        acf_register_block(array(
            'name'              => 'research-single-post-content',
            'title'             => __('Research Single Post Content'),
            'description'       => __('Display research singple post type content'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-content-research-single-post.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('research', 'post')
        ));

        // Featured Events on events page
        acf_register_block(array(
            'name'              => 'featured-events-section',
            'title'             => __('Featured Events Section'),
            'description'       => __('Display feaured events'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-featured-events.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('events', 'news','feature')
        ));

        // Digital Events by Series
        acf_register_block(array(
            'name'              => 'digital-events-series-section',
            'title'             => __('Digital Events by Series Section'),
            'description'       => __('Display Digital Events by Series'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-digital-events-by-series.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('events', 'news','digital')
        ));

        // Search Events block
        acf_register_block(array(
            'name'              => 'search-events-block',
            'title'             => __('Search Events Section'),
            'description'       => __('Display Search Events'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-search-events.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('events', 'search')
        ));

         // Column content options
         acf_register_block(array(
            'name'              => 'column-content-options',
            'title'             => __('Column Content Options Section'),
            'description'       => __('Display column content options'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-column-content-options.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('podcast, content, heading, column')
        ));

        // Document List Block
        acf_register_block(array(
            'name'              => 'document-list-block',
            'title'             => __('Document List Block Section'),
            'description'       => __('Display document List Block'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-document-list-block.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('documents, content, list')
        ));

        // Block Content Columns 
        acf_register_block(array(
            'name'              => 'block-content-columns',
            'title'             => __('Block Content Columns'),
            'description'       => __('Display Block Content Column'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-columns.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('blocks, content, columns')
        ));

        // Block Image title link column
        acf_register_block(array(
            'name'              => 'block-image-title-link-column',
            'title'             => __('Image Grid with Text and Link'),
            'description'       => __('Display section with columns of image/title/link'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-image-title-link-column.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('image title', 'image link', 'columns')
        ));

        // Block Card with Pop 
        acf_register_block(array(
            'name'              => 'block-card-modal-popup',
            'title'             => __('Block Cards with modal'),
            'description'       => __('Display Cards with modal popup'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-card-popup.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('blocks, content, popup')
        ));

        // Image with Content Slider
        acf_register_block(array(
            'name'              => 'block-image-content-slider',
            'title'             => __('Image with Content Slider'),
            'description'       => __('Display image and content slider section'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-image-content-slider.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('slider', 'image and content', 'content slider')
        ));

        // Podcast Page Banner
        acf_register_block(array(
            'name'              => 'block-podcast-page-banner',
            'title'             => __('Podcast Page Banner'),
            'description'       => __('Display Podcast Page Banner'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-podcast-page-banner.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('banner', 'podcast', 'page')
        ));

        // Text Carousel
        acf_register_block(array(
            'name'              => 'section-text-carousel',
            'title'             => __('Text Carousel'),
            'description'       => __('Display Text Carousel'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-text-carousel.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('carousel', 'page')
        ));

        // Form Block
        acf_register_block(array(
            'name'              => 'section-form-block',
            'title'             => __('Fullwidth Form Content'),
            'description'       => __('Display form section'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-fullwidth-form.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('form', 'form content')
        ));

        // Research Index with filtering block in cards layout
        acf_register_block(array(
            'name'              => 'section-research-posts-in-cards',
            'title'             => __('Research Filtering in Cards'),
            'description'       => __('Display research filtering index in cards layout'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-research-posts-in-cards.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('research', 'research filter', 'research search', 'cards')
        ));

        // News category archive filtering block
        acf_register_block(array(
            'name'              => 'section-news-category',
            'title'             => __('News Category Archive Filtering'),
            'description'       => __('Display news filtering archive'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-news-archive-filtering.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('media releases', 'biographies', 'stories', 'speeches', 'news')
        ));

        // Investment Filter form
        acf_register_block(array(
            'name'              => 'section-investment-filter-form',
            'title'             => __('Investment Filter Form'),
            'description'       => __('Display investment filtering form'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-investment-filter-form.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('filter', 'investment', 'form', 'opportunities')
        ));

        // Featured News cards
        acf_register_block(array(
            'name'              => 'featured-news-cards',
            'title'             => __('Featured News Cards'),
            'description'       => __('Display featured news in cards layout'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-featured-news-cards.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('featured', 'news', 'media releases', 'cards')
        ));

        // News filtering with sidebar
        acf_register_block(array(
            'name'              => 'news-archive-filter-with-sidebar',
            'title'             => __('News Category Archive Filtering with Sidebar'),
            'description'       => __('Display News Category Archive Filtering with sidebar'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-news-archive-filtering-with-sidebar.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('news with sidebar', 'news', 'media releases', 'media queries')
        ));

        // Creative Connections cards
        acf_register_block(array(
            'name'              => 'creative-connections-cards',
            'title'             => __('Creative connections in cards'),
            'description'       => __('Display creative connections in cards layout/view'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-creative-connections-cards.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('creative connections', 'cards', 'webinars')
        ));

        // Search Applicants Cards Block
        acf_register_block(array(
            'name'              => 'search-applicants-block',
            'title'             => __('Search applicants cards block'),
            'description'       => __('Display search applicants block'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-search-applicants.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('applicants', 'cards', 'company')
        ));

        // Home Content Feed Block
        acf_register_block(array(
            'name'              => 'home-content-feed-block',
            'title'             => __('Home Content Feed'),
            'description'       => __('Display blog style content feed in the homepage'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-home-content-feed.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content feed', 'home', 'home content')
        ));

    }    
}

add_action('acf/init',  __NAMESPACE__ . '\\register_blocks');
