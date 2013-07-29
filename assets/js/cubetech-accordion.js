jQuery(function() {

        /* Accordion */
        jQuery('.cubetech-accordion-active').each(function() {
                jQuery(this).find('.cubetech-accordion-content').show();
        });
        jQuery('.cubetech-accordion .cubetech-accordion-title').click(function() {
                var toggle = jQuery(this).parent('.cubetech-accordion');
                if(jQuery(this).parent('.cubetech-accordion').parent('div').hasClass('cubetech-accordion-single')) {
                	if(toggle.find('.cubetech-accordion-content').is(toggle.parent('div').find('.cubetech-accordion-active').find('.cubetech-accordion-content:visible'))) {
                        toggle.parent('div').find('.cubetech-accordion-active').find('.cubetech-accordion-content:visible').slideUp();
                        toggle.parent('div').find('.cubetech-accordion-active').removeClass('cubetech-accordion-active');
                	} else {
                        toggle.parent('div').find('.cubetech-accordion-active').find('.cubetech-accordion-content:visible').slideUp();
                        toggle.parent('div').find('.cubetech-accordion-active').removeClass('cubetech-accordion-active');
                        toggle.toggleClass('cubetech-accordion-active');
                        toggle.find('.cubetech-accordion-content').slideToggle(500);
                    }
                } else {
                        toggle.toggleClass('cubetech-accordion-active');
                        toggle.find('.cubetech-accordion-content').slideToggle(500);
                }
        });
        
});