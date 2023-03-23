<?php

function tmo_history_cpt()
{
  global $tmoTextDomain;

  $singular = 'Period';
  $plural = 'Periods';

  $labels = [
		'name'                  => _x($plural, 'Post Type General Name', $tmoTextDomain),
		'singular_name'         => _x($singular, 'Post Type Singular Name', $tmoTextDomain),
		'menu_name'             => __('Company History', $tmoTextDomain),
		'name_admin_bar'        => __('History', $tmoTextDomain),
		'archives'              => __("History Archives", $tmoTextDomain),
		'attributes'            => __("$singular Attributes", $tmoTextDomain),
		'parent_item_colon'     => __("Parent $singular:", $tmoTextDomain),
		'all_items'             => __("All $plural", $tmoTextDomain),
		'add_new_item'          => __("Add New $singular", $tmoTextDomain),
		'add_new'               => __("Add New", $tmoTextDomain),
		'new_item'              => __("New $singular", $tmoTextDomain),
		'edit_item'             => __("Edit $singular", $tmoTextDomain),
		'update_item'           => __("Update $singular", $tmoTextDomain),
		'view_item'             => __("View $singular", $tmoTextDomain),
		'view_items'            => __("View $plural", $tmoTextDomain),
		'search_items'          => __("Search $singular", $tmoTextDomain),
		'not_found'             => __("Not found", $tmoTextDomain),
		'not_found_in_trash'    => __("Not found in Trash", $tmoTextDomain),
		'featured_image'        => __("Featured Image", $tmoTextDomain),
		'set_featured_image'    => __("Set featured image", $tmoTextDomain),
		'remove_featured_image' => __("Remove featured image", $tmoTextDomain),
		'use_featured_image'    => __("Use as featured image", $tmoTextDomain),
		'insert_into_item'      => __("Insert into $singular", $tmoTextDomain),
		'uploaded_to_this_item' => __("Uploaded to this $singular", $tmoTextDomain),
		'items_list'            => __("$singular list", $tmoTextDomain),
		'items_list_navigation' => __("$singular list navigation", $tmoTextDomain),
		'filter_items_list'     => __("Filter $singular list", $tmoTextDomain),
	];

	$rewrite_args = [
		'slug'        => 'history',
		'with_front'  => false
	];

	$args = [
		'label'               => __($plural, $tmoTextDomain),
		'labels'              => $labels,
		'description'         => __('The Mortgage Office history.', $tmoTextDomain),
		'public'              => false,
		'hierarchical'        => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
    'show_in_rest'        => false,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-slides',
		'supports'            => ['title', 'editor', 'thumbnail'],
		'taxonomies'          => [],
		'can_export'          => true,
		'has_archive'         => false,
		'capability_type'     => 'post',
		'rewrite'             => $rewrite_args
  ];

	register_post_type('history', $args);
}

add_action('init', 'tmo_history_cpt', 0);
