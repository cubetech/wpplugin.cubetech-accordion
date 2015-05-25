jQuery(function() {

        /* Accordion */
        jQuery('.cubetech-events-active').each(function() {
                jQuery(this).find('.cubetech-events-content').show();
        });
        jQuery('.cubetech-events .cubetech-events-title').click(function() {
                var toggle = jQuery(this).parent('.cubetech-events');
                if(jQuery(this).parent('.cubetech-events').parent('div').hasClass('cubetech-events-single')) {
                	if(toggle.find('.cubetech-events-content').is(toggle.parent('div').find('.cubetech-events-active').find('.cubetech-events-content:visible'))) {
                        toggle.parent('div').find('.cubetech-events-active').find('.cubetech-events-content:visible').slideUp();
                        toggle.parent('div').find('.cubetech-events-active').removeClass('cubetech-events-active');
                	} else {
                        toggle.parent('div').find('.cubetech-events-active').find('.cubetech-events-content:visible').slideUp();
                        toggle.parent('div').find('.cubetech-events-active').removeClass('cubetech-events-active');
                        toggle.toggleClass('cubetech-events-active');
                        toggle.find('.cubetech-events-content').slideToggle(500);
                    }
                } else {
                        toggle.toggleClass('cubetech-events-active');
                        toggle.find('.cubetech-events-content').slideToggle(500);
                }
        });

});
