<?php

	function cubetech_accordion_shortcode($atts) {

		extract(shortcode_atts(array(
			'group'			=> false,
			'single'		=> false,
			'orderby' 		=> 'menu_order',
			'order'			=> 'asc',
			'numberposts'	=> 999,
			'offset'		=> 0,
			'poststatus'	=> 'publish',
		), $atts));

		if ( $group == false )
			return "Keine Gruppe angegeben";

		$args = array(
			'posts_per_page'  	=> 999,
			'numberposts'     	=> $numberposts,
			'offset'          	=> $offset,
			'orderby'         	=> $orderby,
			'order'           	=> $order,
			'post_type'       	=> 'cubetech_accordion',
			'post_status'     	=> $poststatus,
			'suppress_filters' 	=> false,
			'tax_query' => array(
			    array(
			        'taxonomy' => 'cubetech_accordion_group',
			        'terms' => $group,
			        'field' => 'term_id',
			    )
			),
		);

		$posts = get_posts($args);

		$class = '';

		if($single == 'true')
			$class = ' cubetech-accordion-single';

		$return = '<div class="cubetech-accordion-container' . $class . '">';

		foreach ($posts as $post) {

			$return .= '
			<div class="cubetech-accordion">
				<h2 class="cubetech-accordion-title">' . $post->post_title . '<i class="toggle-down fa-icon-caret-down"></i><i class="toggle-up fa-icon-caret-up"></i></h2>
				<div class="cubetech-accordion-content">' . apply_filters('the_content', $post->post_content) . '</div>
			</div>';

		}

		$return .= '</div>';
		return $return;

	}

	add_shortcode('cubetech-accordion', 'cubetech_accordion_shortcode');

?>