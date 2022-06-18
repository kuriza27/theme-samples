  <?php

	global $post;
	$myposts = new WP_Query($args);	

	$totalpost = $myposts->found_posts; 

	$i=0;
	if ( $myposts ) {

		if($myposts->query_vars['post_type'] == 'research'){
			if($view == 'list-view'){
				foreach ( $myposts->posts as $post ) : 
				setup_postdata( $post );
				$i=1;
				?>
				 <div class="post">
	                <div class="row">
	                    <div class="col-xl-5 col-lg-12 col-12 col-md-6 px-0 px-sm-3">
	                        <?php $size='447X650';?>
	                        <a href="<?php echo get_permalink();?>"><?php  the_post_thumbnail($size,['class' => 'post-img w-100']);  ?></a>
	                    </div>
	                    <div class="col">
	                        <div class="mobile-space">
	                        <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
	                            <div class="post-meta"><?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></div>
	                            <?php 
									$excerpt = get_the_excerpt();
									$excerpt = substr($excerpt, 0, 200);
									echo $excerpt; 
								?>
	                        </div>
	                    </div>
	                </div>
	            </div>	
			<?php
			endforeach;
			wp_reset_postdata();
			}
			else{
			foreach ( $myposts->posts as $post ) : 
				setup_postdata( $post );
				$i=1;
				?>
				 
					<div class="col-12 col-md-6 col-lg-4 col-xl-3 post d-flex">
                                                <div class="d-flex flex-column">
                                                     <div class="flex-shrink-0">
                                                          <?php $size='447X650';?>
                                                          <a href="<?php echo get_permalink();?>"><?php  the_post_thumbnail($size,['class' => 'post-img w-100']);  ?></a>
                                                      </div>
                                                <div class="flex-grow-1 d-flex flex-column post-data">
                                                            <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                                                            <div class="post-meta"><?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></div>
                                                                 <?php 
																	$excerpt = get_the_excerpt();
																	$excerpt = substr($excerpt, 0, 200);
																	echo $excerpt; 
																    ?>
                                                                           
                                                                <a href="<?php echo get_permalink();?>" class="more-link mt-auto">Read More</a>
                                                            </div>
                                                </div>
                                    </div>		

				
			<?php
			endforeach;
			wp_reset_postdata();
			}
		}
		else if ( $myposts->query_vars['post_type'] == 'corporate_docs' ) {
			foreach ( $myposts->posts as $post ) : 
				setup_postdata( $post );
				$i=1;
			?>
				<div class="col-lg-4">
					<div class="document-box d-flex">
						<?php
							$pdf_link_attachment = get_field( 'pdf_link_attachment',$post->ID);
							$rtf_link_attachment = get_field( 'rtf_link_attachment',$post->ID);
							$doc_link_attachment = get_field( 'doc_link_attachment',$post->ID );
							$image_link_attachment = get_field( 'image_link_attachment' ,$post->ID);

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
			<?php
			endforeach;
			wp_reset_postdata();
		}
	}
?>