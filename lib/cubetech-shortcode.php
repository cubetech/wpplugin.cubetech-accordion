<?php
function cubetech_accordion_shortcode($atts)
{
	extract(shortcode_atts(array(
		'group'			=> false,
		'single'		=> false,
		'orderby' 		=> false,
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
		'suppress_filters' 	=> true,
		'tax_query' => array(
		    array(
		        'taxonomy' => 'cubetech_accordion_group',
		        'terms' => $group,
		        'field' => 'id',
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
			<h2 class="cubetech-accordion-title">';

		if($title == 'excerpt' && $post->post_excerpt != '') {
			if(has_excerpt()) $return .= $post->post_excerpt;
		} else {
			$return .= $post->post_title;
		}
		
		$return .= '<i class="toggle-down fa-icon-caret-down"></i><i class="toggle-up fa-icon-caret-up"></i></h2>
			<div class="cubetech-accordion-content">';
		if($title == 'both')
		{
			if(has_excerpt()) $return .= $post->post_excerpt . '<br/>';
		}
		$return .= $post->post_content;

		$return .= '</div>
		</div>';

	}

	return $return . '</div>';

}
add_shortcode('cubetech-accordion', 'cubetech_accordion_shortcode');
?>
