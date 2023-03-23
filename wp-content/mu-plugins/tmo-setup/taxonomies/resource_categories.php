<?php

function tmo_resource_categories_taxonomy()
{
  global $tmoTextDomain;

  $singular = 'Category';
  $plural = 'Categories';

	$labels = [
		'name'                        => _x($plural, "Taxonomy General Name", $tmoTextDomain),
		'singular_name'               => _x($singular, "Taxonomy Singular Name", $tmoTextDomain),
		'menu_name'                   => __($plural, $tmoTextDomain),
		'all_items'                   => __("All $plural", $tmoTextDomain),
		'parent_item'                 => __("Parent $singular", $tmoTextDomain),
		'parent_item_colon'           => __("Parent $singular:", $tmoTextDomain),
		'new_item_name'               => __("New $singular Name", $tmoTextDomain),
		'add_new_item'                => __("Add New $singular", $tmoTextDomain),
		'edit_item'                   => __("Edit $singular", $tmoTextDomain),
		'update_item'                 => __("Update $singular", $tmoTextDomain),
		'view_item'                   => __("View $singular", $tmoTextDomain),
		'separate_items_with_commas'  => __("Separate $plural with commas", $tmoTextDomain),
		'add_or_remove_items'         => __("Add or remove $plural", $tmoTextDomain),
		'choose_from_most_used'       => __("Choose from the most used", $tmoTextDomain),
		'popular_items'               => __("Popular $plural", $tmoTextDomain),
		'search_items'                => __("Search $plural", $tmoTextDomain),
		'not_found'                   => __("Not Found", $tmoTextDomain),
		'no_terms'                    => __("No $plural", $tmoTextDomain),
		'items_list'                  => __("$plural list", $tmoTextDomain),
		'items_list_navigation'       => __("$plural list navigation", $tmoTextDomain),
  ];

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'rewrite'           => true,
	);

	register_taxonomy('resource_categories', ['resources'], $args);
}

add_action('init', 'tmo_resource_categories_taxonomy', 0);
