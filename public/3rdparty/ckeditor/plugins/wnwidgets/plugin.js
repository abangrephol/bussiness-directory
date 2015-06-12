(function() {
    CKEDITOR.plugins.add('wnwidgets', {
        requires: ['iframedialog','fakeobjects'],
        init: function(a) {
            CKEDITOR.dialog.addIframe('youtube_dialog', 'Insert Widgets', window.location.origin + '/admin/widget-list', 550, 200, function() { /*oniframeload*/ });
            a.addCommand('youtube', {
                exec: function(e) {
                    e.openDialog('youtube_dialog');
                }
            });
            a.ui.addButton('youtube', {
                label: 'Insert Widgets',
                command: 'youtube',
                //icon: this.path + 'images/redo.png',
                toolbar: 'mode,10'
            });
            a.widgets.add('widgets',{
                upcast: function( element ) {
                    return element.name == 'div' && element.hasClass( 'wnwidgets' );
                }
            });
            CKEDITOR.addCss(
                'img.wnwidgets' +
                    '{' +
                    'background-image: url(' + CKEDITOR.getUrl( 'http://placehold.it/200x250' ) + ');' +
                    'background-position: center center;' +
                    'background-repeat: no-repeat;' +
                    'border: 0px;' +
                    'width: 100%;' +
                    '}'
            );
        },
        afterInit : function( editor )
        {
            var dataProcessor = editor.dataProcessor,
                dataFilter = dataProcessor && dataProcessor.dataFilter;

            if ( dataFilter )
            {
                dataFilter.addRules(
                    {
                        elements :
                        {
                            div : function( element )
                            {

                                var returnedElement = element;

                                if ($(element).hasClass('wnwidgets')) {

                                    returnedElement =  createFakeElement( editor, element );
                                }

                                return returnedElement;
                            },
                            'widget' : function( element )
                            {
                                var returnedElement = element;

                                return returnedElement;
                            }
                        }
                    }, 5);
            }
        }
    });
})();