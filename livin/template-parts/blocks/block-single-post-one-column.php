<?php $category = get_the_category(); ?>
<section class="single-column-section">
    <div class="container-sm animate-children">
        <div class="text-md-center">
            <h3 class="h3 text-uppercase in-header-title"><span
                    class="title-selected sec"><?php echo $category[0]; ?></span></h3>
            <h1 class="mb-3"><?php the_title(); ?></h1>
            <small>2 Minute Read | Posted in <u><?php echo $category[0]; ?></u> | Posted during <u><?php echo get_the_date('F, Y'); ?></u></small>
        </div>
        <div class="content-admin pr-0 pt-4 pb-0">
            <?php the_content(); ?>
        </div>
    </div>
</section>