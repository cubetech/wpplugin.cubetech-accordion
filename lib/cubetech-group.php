<?php
function cubetech_accordion_create_taxonomy() {
	
	$labels = array(
		'name'                => __( 'Akkordiongruppen'),
		'singular_name'       => __( 'Akkordiongruppe' ),
		'search_items'        => __( 'Gruppen durchsuchen' ),
		'all_items'           => __( 'Alle Akkordiongruppen' ),
		'edit_item'           => __( 'Akkordiongruppe bearbeiten' ), 
		'update_item'         => __( 'Akkordiongruppe aktualisiseren' ),
		'add_new_item'        => __( 'Neue Gruppe hinzufügen' ),
		'new_item_name'       => __( 'Gruppenname' ),
		'menu_name'           => __( 'Akkordiongruppe' )
	);

	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'accordiongruppe' )
	);

	register_taxonomy( 'cubetech_accordion_group', array( 'cubetech_accordion' ), $args );
}
add_action('init', 'cubetech_accordion_create_taxonomy');
?>
