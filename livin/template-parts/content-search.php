<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Livin
 */




$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), '298x212' ); 
$image = $image_attributes[0];
 if(!$image){	 
	 $image = '/wp-content/uploads/2021/05/defaultimg-298x212.jpg';
 }

 $imageF = ' <img class="post-article-img" src="'.$image.'" alt="'.get_the_title().'">';

?>

<div class="pl-half-container border-bottom" id="post-<?php the_ID(); ?>">
	<div class="row result-card">
 		
		<a href="<?php echo the_permalink();?>" class="card-img col-12 col-sm-5">			
			<?php echo $imageF; ?> 
		</a>	

		<div class="card-content col-12 col-sm-7">
			<!-- <h3 class="title-40"><a href="#">Ways You Can Support Livin</a></h3> -->
			<?php the_title( sprintf( '<h3 class="title-40"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
				<!-- <small>2 Minute Read | Posted in <u>Support Livin</u></small> -->
				<?php
					$catJm=[];
					$categories = get_the_category( get_the_ID() );                                                    
					foreach($categories as $category):                                
						$catJm[] = '<u><a href="'.get_category_link( $category->term_id ).'" title="">'.$category->name.'</a></u>';
					endforeach;
				?>
				<small><?php echo my_post_time_ago_function();?> | Posted in <?php echo implode(' ', $catJm);?></small>

			<?php endif; ?>	
			<div class="pt-3"><?php echo shorten_text( strip_tags(apply_filters( 'the_content', get_the_content() )),130  );?></div>
			<a href="<?php echo esc_url( get_permalink() );?>" class="title-bordered sm">Continue reading</a>
		</div>		
	</div>
</div>