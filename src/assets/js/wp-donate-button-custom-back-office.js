jQuery(document).ready(function($){
    var frame;
    $('#wp_dbc_set_icone_wp_media_button').on('click', function(e){
        e.preventDefault();
        if (frame) {
            frame.open();
            return;
        }
        frame = wp.media({
            title: 'Choisir un média',
            button: { text: 'Utiliser ce média' },
            multiple: false
        });
        frame.on('select', function(){
            var attachment = frame.state().get('selection').first().toJSON();
            $('#wp_dbc_set_icone_wp_media').val(attachment.url); // ou attachment.id selon le besoin
        });
        frame.open();
    });
});
