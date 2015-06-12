//CKEDITOR.on( 'loaded', function( evt ) {
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline( 'sbheader' );
    document.getElementById('sbheader').setAttribute( 'contenteditable', true );
    CKEDITOR.inline( 'sbbody' );
    document.getElementById('sbbody').setAttribute( 'contenteditable', true );
    CKEDITOR.inline( 'sbfooter' );
    document.getElementById('sbfooter').setAttribute( 'contenteditable', true );

//} );