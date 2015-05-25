tinymce.create( 
	'tinymce.plugins.cubetech_events', 
	{
	    /**
	     * @param tinymce.Editor editor
	     * @param string url
	     */
	    init : function( editor, url ) {
			/**
			*  register a new button
			*/
			editor.addButton(
				'cubetech_events_button', 
				{
					cmd   : 'cubetech_events_button_cmd',
					title : editor.getLang( 'cubetech_events.buttonTitle', 'cubetech Events' ),
					image : url + '/../img/toolbar-icon.png'
				}
			);
			/**
			* and a new command
			*/
			editor.addCommand(
				'cubetech_events_button_cmd',
				function() {
					/**
					* @param Object Popup settings
					* @param Object Arguments to pass to the Popup
					*/
					editor.windowManager.open(
						{
							// this is the ID of the popups parent element
							id       : 'cubetech_events_dialog',
							width    : 480,
							title    : editor.getLang( 'cubetech_events.popupTitle', 'cubetech Events' ),
							height   : 'auto',
							wpDialog : true,
							display  : 'block',
						},
						{
							plugin_url : url
						}
					);
				}
			);
		}
	}
);

// register plugin
tinymce.PluginManager.add( 'cubetech_events', tinymce.plugins.cubetech_events );