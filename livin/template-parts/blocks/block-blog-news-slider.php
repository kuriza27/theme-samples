<?php
$id = 'blog_news-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

?>
<div id="<?php echo esc_attr( $id ); ?>" class="blog-news-slider js-blog-news-slider animate-children">
	<?php $select_post = get_field( 'select_post' ); ?>
	<?php if ( $select_post ) : ?>
		<?php foreach ( $select_post as $post_ids ) : ?>
            <div class="sl">
            <h1 class="mb-3"><?php echo get_the_title( $post_ids ); ?></h1>
                <p class="news-text"><?php echo get_the_excerpt( $post_ids); ?></p>
			    <a href="<?php echo get_permalink( $post_ids );?>" class="title-bordered sm">Continue Reading</a>
            </div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
