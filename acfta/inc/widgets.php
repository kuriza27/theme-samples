<?php
if ( function_exists('register_sidebar') ){
	register_sidebar(array(
			'name' => 'Footer 1',
			'id' => 'footer-1',
			'before_widget' => '<div class = "widgetizedArea">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		)
	);
	register_sidebar(array(
			'name' => 'Footer 2',
			'id' => 'footer-2',
			'before_widget' => '<div class = "widgetizedArea">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		)
	);
	register_sidebar(array(
			'name' => 'Footer 3',
			'id' => 'footer-3',
			'before_widget' => '<div class = "widgetizedArea">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		)
	);
	register_sidebar(array(
			'name' => 'Footer 4',
			'id' => 'footer-4',
			'before_widget' => '<div class = "widgetizedArea">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		)
	);
	register_sidebar(array(
			'name' => 'Footer 5',
			'id' => 'footer-5',
			'before_widget' => '<div class = "widgetizedArea">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		)
	);

	register_sidebar(array(
		'name' => 'Copyright Text',
		'id' => 'copyright-text',
		'before_widget' => '<div class = "widgetizedArea">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	)
);

	register_sidebar(array(
		'name' => 'Single Post Sidebar',
		'id' => 'single-post-sidebar',
		'before_widget' => '<div class = "widgetizedArea">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	)
);

register_sidebar(array(
	'name' => 'Media Enquiries',
	'id' => 'contact-media-enquiries',
	'before_widget' => '<div class = "widgetizedArea">',
	'after_widget' => '</div>',
	'before_title' => '<h5>',
	'after_title' => '</h5>',
   )
);


}