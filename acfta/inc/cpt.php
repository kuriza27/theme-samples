
<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Investment and Development.
	 */

	$labels = [
		"name" => __( "Investment and Development", "custom-post-type-ui" ),
		"singular_name" => __( "Investment and Development", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Investment and Development", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "investment",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "investment-and-development", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "revisions", "page-attributes" ],
		"taxonomies" => [ "category", "post_tag" ],
		"show_in_graphql" => false,
	];

	register_post_type( "investment", $args );

	/**
	 * Post Type: Corporate Documents.
	 */

	$labels = [
		"name" => __( "Corporate Documents", "custom-post-type-ui" ),
		"singular_name" => __( "Corporate Document", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Corporate Documents", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "corporate_docs", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "revisions" ],
		"taxonomies" => [ "post_tag" ],
		"show_in_graphql" => false,
	];

	register_post_type( "corporate_docs", $args );

	/**
	 * Post Type: Tenders.
	 */

	$labels = [
		"name" => __( "Tenders", "custom-post-type-ui" ),
		"singular_name" => __( "Tender", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Tenders", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "tenders", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "revisions" ],
		"show_in_graphql" => false,
	];

	register_post_type( "tenders", $args );

	/**
	 * Post Type: Advocacy and Research.
	 */

	$labels = [
		"name" => __( "Advocacy and Research", "custom-post-type-ui" ),
		"singular_name" => __( "Advocacy and Research", "custom-post-type-ui" ),
		"menu_name" => __( "Research", "custom-post-type-ui" ),
		"archives" => __( "Research", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Advocacy and Research", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "researches",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "advocacy-and-research", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "revisions", "page-attributes" ],
		"taxonomies" => [ "category", "post_tag" ],
		"show_in_graphql" => false,
	];

	register_post_type( "research", $args );

	/**
	 * Post Type: Creative Connections.
	 */

	$labels = [
		"name" => __( "Creative Connections", "custom-post-type-ui" ),
		"singular_name" => __( "Creative Connection", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Creative Connections", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "creative_connection", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "revisions" ],
		"taxonomies" => [ "post_tag" ],
		"show_in_graphql" => false,
	];

	register_post_type( "creative_connection", $args );

	/**
	 * Post Type: News.
	 */

	$labels = [
		"name" => __( "News", "custom-post-type-ui" ),
		"singular_name" => __( "News", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "News", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "cpt_news",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "news", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "revisions", "page-attributes" ],
		"taxonomies" => [ "category", "post_tag" ],
		"show_in_graphql" => false,
	];

	register_post_type( "cpt_news", $args );

	/**
	 * Post Type: Applicants.
	 */

	$labels = [
		"name" => __( "Applicants", "custom-post-type-ui" ),
		"singular_name" => __( "Applicant", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Applicants", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "applicants", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "revisions" ],
		"taxonomies" => [ "post_tag", "application_type", "artform" ],
		"show_in_graphql" => false,
	];

	register_post_type( "applicants", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Application Type.
	 */

	$labels = [
		"name" => __( "Application Type", "custom-post-type-ui" ),
		"singular_name" => __( "Application Type", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Application Type", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'application_type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "application_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "application_type", [ "investment" ], $args );

	/**
	 * Taxonomy: Funding Type.
	 */

	$labels = [
		"name" => __( "Funding Type", "custom-post-type-ui" ),
		"singular_name" => __( "Funding Type", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Funding Type", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'funding_type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "funding_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "funding_type", [ "investment" ], $args );

	/**
	 * Taxonomy: Artforms.
	 */

	$labels = [
		"name" => __( "Artforms", "custom-post-type-ui" ),
		"singular_name" => __( "Artform", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Artforms", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'artform', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "artform",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "artform", [ "investment" ], $args );

	/**
	 * Taxonomy: Document Types.
	 */

	$labels = [
		"name" => __( "Document Types", "custom-post-type-ui" ),
		"singular_name" => __( "Document Type", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Document Types", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'document_type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "document_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "document_type", [ "corporate_docs" ], $args );

	/**
	 * Taxonomy: Resources.
	 */

	$labels = [
		"name" => __( "Resources", "custom-post-type-ui" ),
		"singular_name" => __( "Resource", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Resources", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'resources', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "resources",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "resources", [ "investment" ], $args );

	/**
	 * Taxonomy: Topics.
	 */

	$labels = [
		"name" => __( "Topics", "custom-post-type-ui" ),
		"singular_name" => __( "Topic", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Topics", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'topic', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "topic",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "topic", [ "research" ], $args );

	/**
	 * Taxonomy: Areas.
	 */

	$labels = [
		"name" => __( "Areas", "custom-post-type-ui" ),
		"singular_name" => __( "Area", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Areas", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'area', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "area",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "area", [ "research" ], $args );

	/**
	 * Taxonomy: Artforms.
	 */

	$labels = [
		"name" => __( "Artforms", "custom-post-type-ui" ),
		"singular_name" => __( "Artform", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Artforms", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'art_form', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "art_form",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "art_form", [ "research" ], $args );

	/**
	 * Taxonomy: Programs.
	 */

	$labels = [
		"name" => __( "Programs", "custom-post-type-ui" ),
		"singular_name" => __( "Program", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Programs", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'program', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "program",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "program", [ "programs-resources" ], $args );

	/**
	 * Taxonomy: Biography Types.
	 */

	$labels = [
		"name" => __( "Biography Types", "custom-post-type-ui" ),
		"singular_name" => __( "Biography Type", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Biography Types", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'bio_type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "bio_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "bio_type", [ "biographies" ], $args );

	/**
	 * Taxonomy: Authors.
	 */

	$labels = [
		"name" => __( "Authors", "custom-post-type-ui" ),
		"singular_name" => __( "Author", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Authors", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'speech_author', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "speech_author",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "speech_author", [ "speeches" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
