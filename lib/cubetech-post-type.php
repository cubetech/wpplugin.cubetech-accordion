<?php

function cubetech_accordion_create_post_type() {
	register_post_type('cubetech_accordion',
		array(
			'labels' => array(
				'name' => __('Akkordion'),
				'singular_name' => __('Element'),
				'add_new' => __('Element hinzufügen'),
				'add_new_item' => __('Neues Element hinzufügen'),
				'edit_item' => __('Element bearbeiten'),
				'new_item' => __('Neues Element'),
				'view_item' => __('Element betrachten'),
				'search_items' => __('Elemente durchsuchen'),
				'not_found' => __('Keine Elemente gefunden.'),
				'not_found_in_trash' => __('Keine Elemente gefunden.')
			),
			'capability_type' => 'post',
			'taxonomies' => array('cubetech_group'),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'accordion', 'with_front' => false),
			'show_ui' => true,
			'menu_position' => '20',
			'menu_icon' => null,
			'hierarchical' => true,
			'supports' => array('title', 'editor')
		)
	);
	flush_rewrite_rules();
}

function cubetech_accordion_destroy_post_type() {
	flush_rewrite_rules();
}

?>