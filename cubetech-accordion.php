<?php
/*
Plugin Name: cubetech Accordion
Plugin URI: http://www.cubetech.ch
Description: cubetech Accordion - create accordions in an easy admin panel, group them and add with a shortcode
Version: 1.0.5
Author: cubetech GmbH
Author URI: http://www.cubetech.ch
*/

include_once('lib/cubetech-post-type.php');
include_once('lib/cubetech-shortcode.php');
include_once('lib/cubetech-group.php');

wp_enqueue_script('jquery');
wp_register_script('cubetech_accordion_js', plugins_url('assets/js/cubetech-accordion.js', __FILE__), 'jquery');
wp_enqueue_script('cubetech_accordion_js');

add_action('wp_enqueue_scripts', 'cubetech_accordion_add_styles');

function cubetech_accordion_add_styles() {
	wp_register_style('cubetech-accordion-css', plugins_url('assets/css/cubetech-accordion.css', __FILE__) );
	wp_enqueue_style('cubetech-accordion-css');
	wp_enqueue_style('cubetech-accordion-fontawesome', plugins_url('assets/fonts/fontawesome/css/font-awesome.min.css', __FILE__) );
}

add_filter('nav_menu_css_class', 'cubetech_accordion_current_type_nav_class', 10, 2 );
function cubetech_accordion_current_type_nav_class($classes, $item) {
    $post_type = get_query_var('post_type');
    if(($key = array_search('current_page_parent', $classes)) !== false) {
	    unset($classes[$key]);
	}
    if ($item->attr_title != '' && $item->attr_title == $post_type) {
        array_push($classes, 'current-menu-item');
    }
    return $classes;
}

function cubetech_accordion_custom_colors() {
   echo '<style type="text/css">
           th#year { width: 10%; }
         </style>';
}

add_action('admin_head', 'cubetech_accordion_custom_colors');

/* Add button to TinyMCE */
function cubetech_accordion_addbuttons() {

	if ( (! current_user_can('edit_posts') && ! current_user_can('edit_pages')) )
		return;
	
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_cubetech_accordion_tinymce_plugin");
		add_filter('mce_buttons', 'register_cubetech_accordion_button');
		add_action( 'admin_footer', 'cubetech_accordion_dialog' );
	}
}
 
function register_cubetech_accordion_button($buttons) {
   array_push($buttons, "|", "cubetech_accordion_button");
   return $buttons;
}
 
function add_cubetech_accordion_tinymce_plugin($plugin_array) {
	$plugin_array['cubetech_accordion'] = plugins_url('assets/js/cubetech-accordion-tinymce.js', __FILE__);
	return $plugin_array;
}

add_action('init', 'cubetech_accordion_addbuttons');

function cubetech_accordion_dialog() { 

	$args=array(
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	$taxonomies = get_terms('cubetech_accordion_group', $args);
	
	?>
	<style type="text/css">
		#cubetech_accordion_dialog { padding: 10px 30px 15px; }
	</style>
	<div style="display:none;" id="cubetech_accordion_dialog">
		<div>
			<p>Wählen Sie bitte die einzufügende Akkordion-Gruppe:</p>
			<p><select name="taxonomy" id="taxonomy">
				<option value="">Bitte Gruppe auswählen</option>
				<?php
				foreach($taxonomies as $tax) :
					echo '<option value="' . $tax->term_id . '">' . $tax->name . '</option>';
				endforeach;
				?>
			</select></p>
			<p><input type="checkbox" name="single" id="single" /> Immer nur ein offener Slide in der Gruppe</p>
		</div>
		<div>
			<p><input type="submit" class="button-primary" value="Akkordion einfügen" onClick="if ( taxonomy.value > 0 ) { tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[cubetech-accordion group=' + taxonomy.value + ' single=' + single.checked + ']'); tinyMCEPopup.close(); }" /></p>
		</div>
	</div>
	<?php
}

add_filter( 'single_template', 'cubetech_accordion_template');

function cubetech_accordion_template($template_path) {
    if ( get_post_type() == 'cubetech_accordion' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-cubetech_accordion.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/templates/single.php';
            }
        }
    }
    return $template_path;
}

// Flush rules on activation
register_activation_hook(__FILE__, 'cubetech_accordion_activate_post_type'); 

// On deactivation flush rules
register_deactivation_hook(__FILE__, 'cubetech_accordion_destroy_post_type');

?>
