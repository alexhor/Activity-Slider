jQuery( document ).ready( function(){
    tinymce.create( 'tinymce.plugins.HS_as_button_plugin', {
        init: function( ed, url ){
                // Register command for when button is clicked
                ed.addCommand( 'HS_as_insert_shortcode', function(){
                    tinymce.execCommand( 'mceInsertContent', false, '[activity-slider category=""]' );
                });

            // Register buttons - trigger above command when clicked
            ed.addButton( 'HS_as_button', { title : 'Activity Slider', cmd : 'HS_as_insert_shortcode', image: url + '/slider_icon.jpg' });
        },   
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('HS_as_button', tinymce.plugins.HS_as_button_plugin);
});