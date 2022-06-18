<?php
$the_query = new WP_Query($args);	
$totalpost = $the_query->found_posts; 
?>

<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="post pt-0 pb-5">
        <?php
            $post_id = get_the_ID();
            $pdf_link_attachment = get_field( 'pdf_link_attachment', $post_id);
            $rtf_link_attachment = get_field( 'rtf_link_attachment', $post_id);
            $doc_link_attachment = get_field( 'doc_link_attachment', $post_id);
            $image_link_attachment = get_field( 'image_link_attachment', $post_id);

            if ( $pdf_link_attachment ) :
                $file_format="PDF";
                $url = esc_url( $pdf_link_attachment['url']);
            elseif ( $doc_link_attachment ) :
                $file_format="DOC";
                $url = esc_url( $doc_link_attachment['url'] );
            elseif($rtf_link_attachment):
                $file_format="RTF";
                $url = esc_url( $rtf_link_attachment['url'] );
            elseif($image_link_attachment):
                $file_format="IMG";
                $url = esc_url( $image_link_attachment['url'] );
            else:
                $file_format="";
            endif;
        ?>
        <div class="row">
            <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
                <?php $size='365x200';?>
                <a href="<?php echo get_permalink();?>">
                    <div style="background-color:#000;height:172px;font-size:28px;" class="d-flex align-items-center text-center justify-content-center">
                        <span class="color-white font-weight-bold"><?php echo $file_format; ?></span>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="mobile-space">
                    <span class="<?php echo $status_class ?> d-inline-block"><?php echo $status; ?></span>
                    <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                    <p class="font-weight-medium"><?php echo $price; ?></p>
                    <?php 
                        $excerpt = get_the_excerpt();
                        $excerpt = substr($excerpt, 0, 200);
                        echo $excerpt; 
                    ?>
                    <div class="links-group d-inline-flex mt-5">
                        <a class="d-inline-block mr-5 font-weight-bold" href="<?php echo $url;?>" target="_blank"><?php echo $file_format;?></a>
                        <a class="ml-auto" href="<?php echo $url;?>"><span class="icon-plus-light"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>    
<?php endwhile; ?>