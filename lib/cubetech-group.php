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
		'rewrite'             => array( 'slug' => 'eventgruppe' )
	);

	register_taxonomy( 'cubetech_events_group', array( 'cubetech_events' ), $args );
	//flush_rewrite_rules();
}
add_action('init', 'cubetech_events_create_taxonomy');
?>
