<section class="all-posts-section">
                <div class="container animate-children">
                    <div class="text-center">
                        <h3 class="h3 text-uppercase"><span class="title-selected sec"><?php the_title();?></span></h3>
                        <h2 class="h1 mb-4">All posts</h2>
                    </div>
                    <a href="#" class="blog-filter-toggle d-inline-flex d-lg-none align-items-center" type="button" data-toggle="collapse" data-target="#blogFilter" aria-expanded="false" aria-controls="blogFilter">Filter and Search </a>
                    <div class="blog-filter-wrap collapse" id="blogFilter">
                        <form action="" class="posts-filter row gutters-20">
                            <div class="col-12 col-lg-3">
                                <select>
                                    <option hidden="">Posted in</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-3">
                                <select>
                                    <option hidden="">Posted during</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-3">
                                <select>
                                    <option hidden="">Article type</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                         <div class="col-12 col-lg-3">
                                <label class="position-relative">
                                   <?php get_search_form() ?>
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="row blog-posts-list animate-children">
                    <?php $posted_in = get_field( 'posted_in' ); ?>
                        <?php if ( $posted_in ) : ?>
                            <?php foreach ( $posted_in as $post_ids ) : ?>
                            <!--Post Block--->
                                <div id="<?php echo esc_attr( $id ); ?>" class="col-lg-4 d-flex <?php echo esc_attr( $classes ); ?>">
                                            <article class="post-article d-flex flex-column align-items-start">
                                                <a href="<?php echo get_permalink( $post_ids ); ?>" class="d-block w-100">
                                                    <?php echo get_the_post_thumbnail( $post_ids, 'large', array( 'class' => 'post-article-img' ) );?>
                                                </a>
                                                <?php 
                                                    $categories = get_the_category( $post_ids);
                                                    foreach($categories as $category):                                
                                                ?>
                                                    <small><?php echo do_shortcode('[rt_reading_time label="" postfix="Minutes" postfix_singular="Minute"]'); ?> Read | Posted in <u><?php echo $category->name; ?></u></small>
                                                    <?php endforeach; ?>
                                                    <h3 class="title-40 pt-2"><a href="<?php echo get_permalink( $post_ids ); ?>"><?php echo get_the_title( $post_ids ); ?></a></h3>
                                                <div class="flex-grow-1 pb-2">
                                                    <p><?php echo get_the_excerpt( $post_ids); ?></p>
                                                </div>
                                                <a href="<?php echo get_permalink( $post_ids ); ?>" class="title-bordered sm">Continue reading</a>
                                            </article>
                                </div>
                            <!-- End Post Block--->
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="border-top pagination-container">
                    <div class="container">
                        <div aria-label="Page navigation example" class="d-flex justify-content-between align-items-center">
                            <a class="page-link disabled d-none d-md-block" href="#" tabindex="-1">Previous</a>

                            <ul class="pagination justify-content-center flex-grow-1 mb-0">
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                            </ul>

                            <a class="page-link d-none d-md-block" href="#">Next</a>
                        </div>
                    </div>
                </div>
            </section>
