 <!-- 
    <option hidden>Article type</option>
<?php                                   
#foreach($parentCat as $cp):
#	$parentCatVar =  ($category->parent == $cp['term_id'] || $category->term_id == $cp['term_id'])? "selected": "";
?>        

    <option value="<?php echo get_category_link($cp['term_id']);?>" <?php echo $parentCatVar;?> ><?php echo $cp['name'];?></option>
<?php #endforeach;?> -->
<div class="page-content">
	<section class="blog-category-section">
                <div class="container animate-children">
                    <h3 class="h3 text-uppercase"><span class="title-selected sec"><?php echo $dateArchive;?></span></h3>
                    <h1 class="mb-3 transform-default"><?php echo ($catnamejm)? $catnamejm : $ym;?></h1>
                    <a href="#" class="blog-filter-toggle d-inline-flex d-lg-none align-items-center"type="button" data-toggle="collapse" data-target="#blogFilter" aria-expanded="false" aria-controls="blogFilter">Filter and Search </a>
                    <div class="blog-filter-wrap collapse" id="blogFilter">
                       <form  class="posts-filter row gutters-20"  method="get" action="/blog-search/">
                            <div class="col-12 col-lg-4">
                               <select class="pDuring">
                                    <option hidden>Posted during</option>
                                    <?php 
                                        $duringDate = get_since_dropdown();
                                        foreach($duringDate as $dd):
                                            $selectedDuring = (!empty(get_query_var('year')) && 
                                            get_query_var('year') == $dd->year &&
                                            !empty(get_query_var('monthnum')) && 
                                            get_query_var('monthnum') == $dd->monthnum)? "selected" : "";

                                            
                                        ?>

                                          <option value="<?php echo  site_url().'/'.$dd->year.'/'.$dd->monthnum.'/';?>" <?php echo $selectedDuring;?>><?php echo  $dd->monthname . " ". $dd->year;?></option>

                                    <?php 
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4">
                                  <select class="parentCat">
									  <option hidden>Article type</option>                                       
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
                        
                            $myposts = new WP_Query($args);
                            $i=0;
                        
                            if ( $myposts ) {
                                foreach ( $myposts->posts as $post ) : 
                                    setup_postdata( $post );
                                    $image = get_the_post_thumbnail_url();
                                    $i=1;
                                    ?>

                                        <div class="col-lg-4 d-flex">
                                            <article class="post-article d-flex flex-column align-items-start">
                                                <a href="<?php  echo get_permalink();?>" class="d-block w-100">
                                                    <?php
                                                        $category_name = get_the_category($post->ID)[0]->cat_name;
                                                        $post_type = get_post_type_object( get_post_type( $post->ID ) );
                                                        $post_type_label = $post_type->labels->name;
                                                    ?>
                                                    <?php if($image):
                                                          $image_size = '402x266';
                                                          if($post_type_label=='Podcasts'){
                                                            $image_size = '402x420';
                                                          }

                                                         $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $image_size); 
                                                                $imageF = $image_attributes[0];
                                                    ?>                                                       
                                                    <?php else:?>
                                                            <?php $imageF = '/wp-content/uploads/2021/05/defaultimg-402x266.jpg'; ?>     
                                                    <?php endif;?>

                                                    <img class="post-article-img" src="<?php echo $imageF;?>" alt="<?php the_title();?>" class="post-article-img">
                                                </a>
                                                <small><?php echo do_shortcode('[rt_reading_time label="" postfix="Minutes" postfix_singular="Minute"]'); ?> | Posted in <u><?php echo $post_type_label;?></u></small>
                                                <h3 class="title-40 pt-2"><a href="<?php  echo get_permalink();?>"><?php the_title();?></a></h3>
                                                <div class="flex-grow-1 pb-2">
                                                    <p><?php echo shorten_text(get_the_excerpt(),130  );?></p>
                                                </div>
                                                <a href="<?php  echo get_permalink();?>" class="title-bordered sm">Continue reading</a>
                                            </article>
                                        </div>
                                   
                                <?php
                                endforeach;
                                
                            }
                            ?>
                    </div>
                </div>
                <div class="border-top pagination-container">
                    <div class="container">
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
				$args = array(  
				'post_type' => 'page',
				'post_name__in'  => ['blog']
				);

				$query =  new WP_Query( $args );

				if ( $query->have_posts() ) {

					while ( $query->have_posts() ) {

						$query->the_post();

						the_content();
					}
				}
			?>


	</div>