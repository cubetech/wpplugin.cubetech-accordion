<?php
function cubetech_events_create_post_type() {
	register_post_type('cubetech_events',
		array(
			'labels' => array(
				'name' => __('Events'),
				'singular_name' => __('Event'),
				'add_new' => __('Event hinzufügen'),
				'add_new_item' => __('Neuer Event hinzufügen'),
				'edit_item' => __('Event bearbeiten'),
				'new_item' => __('Neuer Event'),
				'view_item' => __('Event betrachten'),
				'search_items' => __('Evnet durchsuchen'),
				'not_found' => __('Keine Events gefunden.'),
				'not_found_in_trash' => __('Keine Events gefunden.')
			),
			'capability_type' => 'post',
			'taxonomies' => array('cubetech_events_group'),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'events', 'with_front' => false),
			'show_ui' => true,
			'menu_position' => '20',
			'menu_icon' => null,
			'hierarchical' => true,
			'supports' => array('title', 'editor', 'thumbnail')
		)
	);
}
add_action('init', 'cubetech_events_create_post_type');
?>