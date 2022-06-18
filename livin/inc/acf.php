<?php

add_theme_support('align-wide');

function load_custom_wp_admin_style() {
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/admin-style.css', array(), _S_VERSION);
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), _S_VERSION, true);
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
        // Home Banner Block
        acf_register_block(array(
            'name'              => 'home-banner-block',
            'title'             => __('Home Banner'),
            'description'       => __('Homepage main banner section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-home-banner.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('banner, home')
        ));

        // Partners Block
        acf_register_block(array(
            'name'              => 'partners-block',
            'title'             => __('Partners'),
            'description'       => __('Display logos of partners.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-partners.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('logo, partners')
        ));

        // Group Info Block
        acf_register_block(array(
            'name'              => 'group-info-block',
            'title'             => __('Group Info'),
            'description'       => __('Display list of group info.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-group-info.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('group, info, list')
        ));

        // Content with Buttons Block
        acf_register_block(array(
            'name'              => 'content-with-buttons-block',
            'title'             => __('Content with Buttons'),
            'description'       => __('Display title, heading and buttons.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-with-buttons.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content, impact, buttons')
        ));

        // Content with Map Block
        acf_register_block(array(
            'name'              => 'content-with-map-block',
            'title'             => __('Content with Buttons and Map'),
            'description'       => __('Display title, heading, text, buttons and map.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-with-map.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content, map, buttons')
        ));

        // Posts Slider
        acf_register_block(array(
            'name'              => 'posts-slider-block',
            'title'             => __('Posts Slider'),
            'description'       => __('Display posts in slider.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-posts-slider.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('post, slider')
        ));

        // Alternating Image and Content
        acf_register_block(array(
            'name'              => 'alt-image-content-block',
            'title'             => __('Alternating Image and Content'),
            'description'       => __('Display posts in slider.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-alt-image-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('post, slider')
        ));

        // Testimonial and Brands
        acf_register_block(array(
            'name'              => 'testimonial-brands-block',
            'title'             => __('Testimonial and Brands'),
            'description'       => __('Display testimonial and brands section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-testimonial-brands.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('testimonial, brands, logos')
        ));

        // Content with Video and Buttons
        acf_register_block(array(
            'name'              => 'content-video-buttons-block',
            'title'             => __('Content with Video and Buttons'),
            'description'       => __('Display content with video and buttons.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-video-buttons.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('video, content, buttons')
        ));

        // Content with Buttons and Image Right
        acf_register_block(array(
            'name'              => 'content-buttons-image-right-block',
            'title'             => __('Content with Buttons and Image Right'),
            'description'       => __('Display content with buttons and right column image.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-buttons-image-right.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content, buttons, image, right')
        ));

        // Reviews Slider
        acf_register_block(array(
            'name'              => 'reviews-slider-block',
            'title'             => __('Reviews Slider'),
            'description'       => __('Display reviews in slider.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-reviews-slider.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('reviews, slider')
        ));

        // Donate Pricing
        acf_register_block(array(
            'name'              => 'donate-pricing-block',
            'title'             => __('Donate Pricing'),
            'description'       => __('Display pricing donation section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-donate-pricing.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('donate, pricing')
        ));

        // Gallery Slider
        acf_register_block(array(
            'name'              => 'gallery-slider-block',
            'title'             => __('Gallery Slider'),
            'description'       => __('Display image gallery slider section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-gallery-slider.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('gallery, slider')
        ));

         // Contact Form
        acf_register_block(array(
            'name'              => 'contact-form-block',
            'title'             => __('Contact Form'),
            'description'       => __('Contact form section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-contact-form.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('contact, form')
        ));

        // Title with Buttons
        acf_register_block(array(
            'name'              => 'title-with-buttons-block',
            'title'             => __('Title with Buttons'),
            'description'       => __('Title with Buttons section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-title-with-buttons.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('buttons, title')
        ));

        // Content with Sidebar
        acf_register_block(array(
            'name'              => 'content-with-sidebar',
            'title'             => __('Content with Sidebar'),
            'description'       => __('Display content with sidebar'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-sidebar.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content, sidebar')
        ));

        // Blog Index Content with Sidebar
        acf_register_block(array(
            'name'              => 'blog-content-with-sidebar',
            'title'             => __('Blog News Content with Sidebar'),
            'description'       => __('Display blog content with sidebar'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-blog-content-sidebar.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('blog, sidebar')
        ));

        // Widget Social Media
        acf_register_block(array(
            'name'              => 'widget-social-media',
            'title'             => __('Social Media Widget'),
            'description'       => __('Display social media widget'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/widget-social-media.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('widget', 'social media')
        ));

        // Widget Social Media with Newsletter form
        acf_register_block(array(
            'name'              => 'widget-social-media-w-newsletter-form',
            'title'             => __('Social Media with Newsletter Form Widget'),
            'description'       => __('Display Social Media with Newsletter Form widget'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/widget-social-media-w-newsletterform.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('widget', 'social media','news letter')
        ));

        // Widget Link List
        acf_register_block(array(
            'name'              => 'widget-link-list',
            'title'             => __('Link List Widget'),
            'description'       => __('Display link list widget'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/widget-link-list.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('link list', 'widget')
        ));

        // Widget Newsletter
        acf_register_block(array(
            'name'              => 'widget-newsletter',
            'title'             => __('Newsletter Widget'),
            'description'       => __('Display newsletter widget'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/widget-newsletter.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('newsletter', 'widget')
        ));

        // Widget Buttons
        acf_register_block(array(
            'name'              => 'widget-buttons',
            'title'             => __('Buttons Widget'),
            'description'       => __('Display buttons widget'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/widget-buttons.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('buttons', 'widget')
        ));

        // Widget Sidebar Options
        acf_register_block(array(
            'name'              => 'widget-sidebar-options',
            'title'             => __('Sidebar Options'),
            'description'       => __('Display all sidebar widget options'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/widget-sidebar-custom-options.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('sidebar', 'widget')
        ));

        // Blog News Slider
        acf_register_block(array(
            'name'              => 'blog-news-slider',
            'title'             => __('Blog News Slider'),
            'description'       => __('Blog News Slider'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-blog-news-slider.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('blog', 'news')
        ));

        // All Post Filter
        acf_register_block(array(
            'name'              => 'all-post-filter',
            'title'             => __('All Post Filter'),
            'description'       => __('All Post Filter'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-all-post-filter.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('post', 'all')
        ));

        // No search Found
        acf_register_block(array(
            'name'              => 'no-search-found',
            'title'             => __('No search found'),
            'description'       => __('No search found'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-no-search-found.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('form', 'search','all')
        ));

        // Banner Header Content
        acf_register_block(array(
            'name'              => 'banner-header-content',
            'title'             => __('Banner Header Content'),
            'description'       => __('Banner Header Content'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-banner-header-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('banner', 'header')
        ));

        // Simple Section Content
        acf_register_block(array(
            'name'              => 'simple-section-content',
            'title'             => __('Simple Section Content'),
            'description'       => __('Simple Section Content'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-simple-section-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('simple', 'content')
        ));

        // How it works Content
        acf_register_block(array(
            'name'              => 'how-it-works-content',
            'title'             => __('How it works Content'),
            'description'       => __('How it works Content'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-how-it-works-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('how', 'works')
        ));

        // Fund Raising Content
        acf_register_block(array(
            'name'              => 'fund-raising-content',
            'title'             => __('Fund Raising'),
            'description'       => __('Fund Raising'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-fund-raising-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('content', 'options')
        ));

        // Content Image on Left
        acf_register_block(array(
            'name'              => 'content-image-left',
            'title'             => __('Content Image on Left'),
            'description'       => __('Content Image on Left'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-image-left.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('content', 'image')
        ));

        // Content Left with Background Image
        acf_register_block(array(
            'name'              => 'content-left-imagebg',
            'title'             => __('Content Left with Background Image'),
            'description'       => __('Content  Left with Background Image'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-left-imagebg.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('content', 'image')
        ));

        // Content Right with Background Image
        acf_register_block(array(
            'name'              => 'content-right-imagebg',
            'title'             => __('Content Right with Background Image'),
            'description'       => __('Content Right with Background Image'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-right-imagebg.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('content', 'image')
        ));

        // Content Orange Head Text
        acf_register_block(array(
            'name'              => 'orange-head-text',
            'title'             => __('Content Orange Head Text'),
            'description'       => __('Content Orange Head Text'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-orange-head-text.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('content', 'head','title')
        ));

        // Column Content
        acf_register_block(array(
            'name'              => 'content-columns',
            'title'             => __('Column Content'),
            'description'       => __('Display content in columns'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-columns.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('column', 'columns', 'content column')
        ));

        // Card Slider
        acf_register_block(array(
            'name'              => 'card-slider',
            'title'             => __('Card Slider'),
            'description'       => __('Display card slider'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-card-slider.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('card', 'slider', 'card slider')
        ));

        // Banner Form Options
        acf_register_block(array(
            'name'              => 'banner-option-block',
            'title'             => __('Header Banner with Form'),
            'description'       => __('Display banner form with options'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-banner-options.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('banner', 'content', 'gravity form')
        ));

        // Single Page Layout
        acf_register_block(array(
            'name'              => 'single-page-layout-block',
            'title'             => __('Single Page Layout Block'),
            'description'       => __('Display Single Page Layout Block'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-single-page-layout.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('page', 'layout', 'single page')
        ));

        // Column List Content with Images
        acf_register_block(array(
            'name'              => 'column-list-content-layout-block',
            'title'             => __('Column List Content with Images'),
            'description'       => __('Display Column List Content with Images Block'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-column-list-content-with-images.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('page', 'layout', 'single page')
        ));

        // Page Text Banner Block
        acf_register_block(array(
            'name'              => 'page-text-banner-block',
            'title'             => __('Page Text Banner Block'),
            'description'       => __('Display Page Text Banner Block'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-page-text-banner.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'screenoptions',
            'mode'              => 'auto',
            'keywords'          => array('page', 'layout', 'single page', 'banner')
        ));

        // Partners with Stamp Image Block
        acf_register_block(array(
            'name'              => 'partners-stamp-block',
            'title'             => __('Partners with Stamp Image Block'),
            'description'       => __('Display logos of partners with Stamp Image.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-partners-with-stamp.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('logo, partners','stamp')
        ));

        //CTA content 
        acf_register_block(array(
            'name'              => 'cta-content-block',
            'title'             => __('CTA Content Block'),
            'description'       => __('Display CTA contents.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-cta-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('cta','stamp')
        ));

        //Content List Details
        acf_register_block(array(
            'name'              => 'content-list-block',
            'title'             => __('Content List Block'),
            'description'       => __('Display content list detail.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-list-details.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content, list, details')
        ));

        //Grey Bg Centered Content
        acf_register_block(array(
            'name'              => 'greyBg-centered-content-block',
            'title'             => __('Grey Bg Centered Content'),
            'description'       => __('Display Grey Bg Centered Content.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-grey-bg-centered-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content, center, grey')
        ));

        //Simple Content Left with Background
        acf_register_block(array(
            'name'              => 'simple-content-left-block',
            'title'             => __('Simple Content Left with Background'),
            'description'       => __('Display Simple Content Left with Background.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-simple-content-left-bg.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content, left, simple')
        ));

        //Content with Colored Background and List
        acf_register_block(array(
            'name'              => 'content-list-colored-block',
            'title'             => __('Content with Colored Background and List'),
            'description'       => __('Display Content with Colored Background and List.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-content-list-colored.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content, list, colored')
        ));

        //New Rate Content Layout Block
        acf_register_block(array(
            'name'              => 'new-rate-content',
            'title'             => __('New Rate Content Layout'),
            'description'       => __('Display New Rate Content Layout.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-new-rate-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('content, rate, new, layout')
        ));

        //Book Workshop Section
        acf_register_block(array(
            'name'              => 'book-workshop',
            'title'             => __('Book Workshop Section'),
            'description'       => __('Display Book Workshop Section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/section-book-workshop-content.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('book, workshop, layout')
        ));

        //School participant logos Section
        acf_register_block(array(
            'name'              => 'school-participant-logos',
            'title'             => __('School participant logos Section'),
            'description'       => __('Display School participant logos Section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-school-participant-logos.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('logos, school, parter')
        ));

        //Form Center Block
        acf_register_block(array(
            'name'              => 'form-center',
            'title'             => __('Form Center Section'),
            'description'       => __('Display Form Center Section.'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/block-form-center.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'layout',
            'mode'              => 'auto',
            'keywords'          => array('forms')
        ));

    }    
}

add_action('acf/init',  __NAMESPACE__ . '\\register_blocks');
