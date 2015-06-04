<?php
function cubetech_events_create_taxonomy() {

	$labels = array(
		'name'                => __( 'Eventgruppen'),
		'singular_name'       => __( 'Eventgruppe' ),
		'search_items'        => __( 'Gruppen durchsuchen' ),
		'all_items'           => __( 'Alle Eventgruppen' ),
		'edit_item'           => __( 'Eventgruppe bearbeiten' ),
		'update_item'         => __( 'Eventgruppe aktualisiseren' ),
		'add_new_item'        => __( 'Neue Gruppe hinzufügen' ),
		'new_item_name'       => __( 'Gruppenname' ),
		'menu_name'           => __( 'Eventgruppe' )
	);

	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'events' )
	);

	register_taxonomy( 'cubetech_events_group', array( 'cubetech_events' ), $args );
	
	
	$labels = array(
		'name'                => __( 'Eventjahr'),
		'singular_name'       => __( 'Eventjahr' ),
		'search_items'        => __( 'Eventjahr durchsuchen' ),
		'all_items'           => __( 'Alle Eventjahre' ),
		'edit_item'           => __( 'Eventjahr bearbeiten' ),
		'update_item'         => __( 'Eventjahr aktualisiseren' ),
		'add_new_item'        => __( 'Neues Eventjahr hinzufügen' ),
		'new_item_name'       => __( 'Eventjahr' ),
		'menu_name'           => __( 'Eventjahr' )
	);

	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'eventjahr' )
	);

	register_taxonomy( 'cubetech_events_year', array( 'cubetech_events' ), $args );
}
add_action('init', 'cubetech_events_create_taxonomy');
?>
