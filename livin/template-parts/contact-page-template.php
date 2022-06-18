<?php 

/* Template Name: Contact Page Template*/

get_header('', array('class' => 'secondary-bg'));
?>
        <!-- page-content -->
        <div class="page-content">

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
