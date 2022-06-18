<?php
$the_query = new WP_Query($args);	
$totalpost = $the_query->found_posts; 
?>

<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="col-xl-4 col-md-6">
        <div class="document-box d-flex">
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
            <div class="doc-img d-flex justify-content-center align-items-center"><?php echo $file_format; ?></div>
            <div class="document-info">
                <h4><a href="<?php echo $url;?>"><?php the_title(); ?></a></h4>
                <?php 
                    $excerpt = get_the_excerpt(); 
                    $excerpt = substr( $excerpt, 0, 250 ); // Only display first 260 characters of excerpt
                    $result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
                    echo $result.".";
                    ?>
                <div class="links-group d-flex">
                    <a href="<?php echo $url;?>" target="_blank"><?php echo $file_format;?></a>
                    <a class="ml-auto" href="<?php echo $url;?>"><span class="icon-plus-light"></span></a>
                </div>
            </div>
        </div>
    </div>      
<?php endwhile; ?>