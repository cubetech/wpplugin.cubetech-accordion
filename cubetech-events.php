<?php
/**
 * Plugin Name: cubetech Events
 * Plugin URI: http://www.cubetech.ch
 * Description: cubetech Events - simple event plugin
 * Version: 1.0
 * Author: cubetech GmbH
 * Author URI: http://www.cubetech.ch
 */

include_once('lib/cubetech-post-type.php');
include_once('lib/cubetech-metabox.php');
include_once('lib/cubetech-shortcode.php');
include_once('lib/cubetech-group.php');

add_image_size( 'cubetech-events-thumb', 320, 210, true );
add_image_size( 'cubetech-events-block', 528, 270, true );

wp_enqueue_script('jquery');
wp_register_script('cubetech_events_js', plugins_url('assets/js/cubetech-events.js', __FILE__), 'jquery');
wp_enqueue_script('cubetech_events_js');

add_action('wp_enqueue_scripts', 'cubetech_events_add_styles');

function cubetech_events_add_styles() {
	wp_register_style('cubetech-events-css', plugins_url('assets/css/cubetech-events.css', __FILE__) );
	wp_enqueue_style('cubetech-events-css');
}

/* Add button to TinyMCE */
function cubetech_events_addbuttons() {

	if ( (! current_user_can('edit_posts') && ! current_user_can('edit_pages')) )
		return;
	
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_cubetech_events_tinymce_plugin");
		add_filter('mce_buttons', 'register_cubetech_events_button');
		add_action( 'admin_footer', 'cubetech_events_dialog' );
	}
}
 
function register_cubetech_events_button($buttons) {
   array_push($buttons, "|", "cubetech_events_button");
   return $buttons;
}
 
function add_cubetech_events_tinymce_plugin($plugin_array) {
	$plugin_array['cubetech_events'] = plugins_url('assets/js/cubetech-events-tinymce.js', __FILE__);
	return $plugin_array;
}

//add_action('init', 'cubetech_events_addbuttons');

function cubetech_events_dialog() { 

	$args=array(
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	$taxonomies = get_terms('cubetech_events_group', $args);
	
	?>
	<style type="text/css">
		#cubetech_events_dialog { padding: 10px 30px 15px; }
	</style>
	<div style="display:none;" id="cubetech_events_dialog">
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
			<p><input type="submit" class="button-primary" value="Akkordion einfügen" onClick="if ( taxonomy.value > 0 ) { tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[cubetech-events group=' + taxonomy.value + ' single=' + single.checked + ']'); tinyMCEPopup.close(); }" /></p>
		</div>
	</div>
	<?php
}

add_filter( 'template_include', 'cubetech_events_template', 1 );

function cubetech_events_template($template_path) {
    if ( get_post_type() == 'cubetech_events' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-cubetech_events.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/templates/single.php';
            }
        }
    }
    return $template_path;
}

?>
