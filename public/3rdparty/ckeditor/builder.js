//CKEDITOR.on( 'loaded', function( evt ) {

    CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline( 'sbheader' );
    document.getElementById('sbheader').setAttribute( 'contenteditable', true );
    CKEDITOR.inline( 'sbbody' );
    document.getElementById('sbbody').setAttribute( 'contenteditable', true );
    CKEDITOR.inline( 'sbfooter' );
    document.getElementById('sbfooter').setAttribute( 'contenteditable', true );
CKEDITOR.on('instanceReady', function(event) {
    document.getElementById('sbbody').focus();
    CKEDITOR.scriptLoader.load( window.location.origin+'/3rdparty/mustache/mustache.min.js' );
    CKEDITOR.scriptLoader.load( window.location.origin+'/3rdparty/jquery/jquery.deserialize.js' );
    CKEDITOR.scriptLoader.load( window.location.origin+'/3rdparty/jquery/jquery.serialize-object.js' );
});
//} );