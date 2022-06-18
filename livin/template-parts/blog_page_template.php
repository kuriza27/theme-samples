<?php 

/* Template Name: Blog Page Template*/

$banner = get_the_post_thumbnail_url( $post->ID, '1920x826' );

get_header('', array('class' => 'header-cover', 'banner' => $banner, 'breadcrumbs' => true, 'bodyClass' => 'blog-page blog-index'));

$catParent = get_terms('category');

$parentCat = [];
$childrenCat = [];
foreach($catParent as $rs){
    if($rs->parent > 0){
        $childrenCat[] = [
            'term_id' => $rs->term_id,
            'name' => $rs->name
        ];
    }else{
        $parentCat[] = [
            'term_id' => $rs->term_id,
            'name' => $rs->name
        ];
    }
}
$argsSlider = array(
     'post_type' => ['mental-health',  'news_and_updates', 'podcast','your_stories','events','in-the-community','upcoming-events','post','in_the_media'],
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy'  => 'post_tag',
            'field'     => 'slug',
            'terms'     => ["featured"]
        )
    )
);
$postslist = get_posts( $argsSlider );

$dateArchive = "Blog";
?>
        <!-- page-content -->
        <div class="page-content">
                <section class="blog-top-section border-bottom">
                    <div class="container animate-children">
                        <div class="row">
                            <div class="col-lg-8 text-center text-sm-left animate-children">
                                <h3 class="h3 text-uppercase in-header-title"><span class="title-selected sec">Blog</span>
                                </h3>
                                <div class="blog-news-slider js-blog-news-slider">
                                    
                                    <?php foreach($postslist as $postSlider):?>
                                        <div class="sl">
                                            <h1 class="mb-3"><?php echo $postSlider->post_title;?></h1>
                                            <p class="news-text"><?php echo shorten_text($postSlider->post_content);?></p>
                                            <a href="<?php echo  get_permalink($postSlider->ID);?>" class="title-bordered sm">Continue reading</a>
                                        </div>
                                    <?php endforeach;?>    
                                   
                                </div>
                            </div>
                            <div class="col-lg-4 v-delim-l">
                                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("News and Updates Sidebar") ) : ?><?php endif;?>                                
                            </div>
                        </div>
                    </div>
                </section>

                <section class="all-posts-section">
                <div class="container animate-children">
                    <div class="text-center animate-children">
                        <h3 class="h3 text-uppercase"><span class="title-selected sec">Blog</span></h3>
                        <h2 class="h1 mb-4">All posts</h2>
                    </div>
                    <a href="#" class="blog-filter-toggle d-inline-flex d-lg-none align-items-center"type="button" data-toggle="collapse" data-target="#blogFilter" aria-expanded="false" aria-controls="blogFilter">Filter and Search </a>
                    <div class="blog-filter-wrap collapse" id="blogFilter">
                        <form class="posts-filter row gutters-20" method="get" action="/blog-search/">
                            <div class="col-12 col-lg-4">
                               <select class="pDuring">
                                    <option hidden>Posted during</option>
                                    <?php 
                                        $duringDate = get_since_dropdown();
                                        foreach($duringDate as $dd):?>

                                         <option value="<?php echo  site_url().'/'.$dd->year.'/'.$dd->monthnum.'/';?>"><?php echo  $dd->monthname . " ". $dd->year;?></option>

                                    <?php 
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4">
                               <select class="parentCat">
									  <option hidden>Article type</option>
                                    <!-- 
										<option hidden>Article type</option>
                                    <?php                                   
                                    #foreach($parentCat as $cp):
									#	$parentCatVar =  ($category->parent == $cp['term_id'] || $category->term_id == $cp['term_id'])? "selected": "";
									?>        

                                      <option value="<?php echo get_category_link($cp['term_id']);?>" <?php echo $parentCatVar;?> ><?php echo $cp['name'];?></option>
                                    <?php #endforeach;?> -->
                                        <option value="<?php echo get_post_type_archive_link('news_and_updates');?>">News & Blogs</option>
                                        <option value="<?php echo get_post_type_archive_link('podcast');?>">Podcasts</option>
                                        <option value="<?php echo get_post_type_archive_link('your_stories');?>"> Your Stories</option>
                                        <option value="<?php echo get_post_type_archive_link('mental-health');?>">Covid-19 & Mental Health</option>
                                        <option value="<?php echo get_post_type_archive_link('events');?>">Past Events</option>              
                                        <option value="<?php echo get_post_type_archive_link('upcoming-events');?>">Upcoming Events</option>
                                        <option value="<?php echo get_post_type_archive_link('in_the_media');?>">In the Media</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4">
                               <form action="search-blog" method="get" action="/blog-search/">
                                    <label class="position-relative">
                                        <input class="search-input" type="text" placeholder="Search" name="search" value="" />
                                        <button class="search-btn"><span class="icon-search"></span></button>
                                    </label>
                                </form>
                            </div>
                        </form>
                    </div>
                    <div class="row blog-posts-list animate-children">

                     <?php
                            global $post;
                            $paged = !empty($_GET['pg'])? $_GET['pg'] : 1;
                            $myposts = new WP_Query( array(
                                'post_status' => 'publish',
                                'post_type' => ['mental-health',  'news_and_updates', 'podcast','your_stories','events','upcoming-events','in-the-community','in_the_media'],
                                'orderby' => 'date',
                                'order'   => 'DESC',                                
                                'posts_per_page' => 6,
                                'paged'   => $paged,
                                
                            ) );

                            $i=0;
                        
                            if ( $myposts ) {
                                foreach ( $myposts->posts as $post ) : 
                                    setup_postdata( $post );
                                    $image = get_the_post_thumbnail_url();
                                    $i=1;
                                    ?>

                                        <div class="col-lg-4 d-flex">
                                            <article class="post-article d-flex flex-column align-items-start">
                                                <?php
                                                    $category_name = get_the_category($post->ID)[0]->cat_name;
                                                    $post_type = get_post_type_object( get_post_type( $post->ID ) );
                                                    $post_type_label = $post_type->labels->name;
                                                ?>
                                                <a href="<?php echo  get_permalink();?>" class="d-block w-100">
                                                   <?php if($image):
                                                         $image_size = '402x266';
                                                         if($post_type_label=='Podcasts'){
                                                           $image_size = '402x420';
                                                         }
                                                    ?>                                                            
                                                            <?php
                                                                $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),  $image_size); 
                                                                $imageF = $image_attributes[0];
                                                            ?>                                                       
                                                    <?php else:?>
                                                            <?php $imageF = '/wp-content/uploads/2021/05/defaultimg-402x266.jpg'; ?>     
                                                    <?php endif;?>

                                                    <img class="post-article-img" src="<?php echo $imageF;?>" alt="<?php the_title();?>" class="post-article-img">
                                                </a>
                                                <small><?php echo do_shortcode('[rt_reading_time label="" postfix="Minutes" postfix_singular="Minute"]'); ?> Read | Posted in <u><?php echo $post_type_label;?></u></small>
                                                <h3 class="title-40 pt-2"><a href="<?php echo  get_permalink();?>"><?php the_title();?></a></h3>
                                                <div class="flex-grow-1 pb-2">
                                                    <p><?php echo shorten_text(get_the_excerpt(),130  );?></p>
                                                </div>
                                                <a href="<?php echo  get_permalink();?>" class="title-bordered sm">Continue reading</a>
                                            </article>
                                        </div>
                                   
                                <?php
                                endforeach;
                               
                            }
                            ?>
                       
                        
                    </div>
                </div>
                <div class="border-top pagination-container">
                    <div class="container animate-children">
                        <div aria-label="Page navigation example"
                             class="d-flex justify-content-between align-items-center animate-children">
                           <?php echo $i ? ea_archive_navigation(2,$myposts) : "";
                            wp_reset_postdata();
                           ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php
            while ( have_posts() ) : the_post();

                the_content();

            endwhile; // End of the loop.
            ?>

        </div>
        <!-- /page-content -->


<?php
//get_sidebar();
get_footer();
