(function() {
    CKEDITOR.plugins.add('wnwidgets', {
        requires: ['iframedialog','fakeobjects'],
        init: function(editor) {
            CKEDITOR.dialog.addIframe('youtube_dialog', 'Insert Widgets', window.location.origin + '/admin/widget-list', 550, 200,
                function() {
                    iframeid=this._.frameId;/*get the iframe*/
                },
                {
                    onOk : function(){
                        //texttoadd=$('#return', $('#' + iframeid).contents()).html();
                        var dialog = this, data = {id:{name:'id',value:'val'}}, customwidget = new CKEDITOR.dom.element( 'div' );
                        var ed = this._.editor;
                        this.commitContent( data );

                        Object.keys(data).forEach(function(key) {
                            customwidget.setAttribute(data[key].name,data[key].value);
                        });


                        var newFakeImage = ed.createFakeElement( customwidget, 'wnwidgets', 'widget', true );
                        $(newFakeImage).attr('title',data.title);
                        $(newFakeImage).attr('alt',data.title);
                        ed.insertElement( newFakeImage );
                    }
                }
            );
            editor.addCommand('wnwidgets', {
                exec: function(e) {
                    e.openDialog('youtube_dialog');
                }
            });
            editor.ui.addButton('wnwidgets', {
                label: 'Insert Widgets',
                command: 'wnwidgets',
                //icon: this.path + 'icons/redo.png',
                toolbar: 'mode,10'
            });
            editor.widgets.add('widgets',{
                upcast: function( element ) {
                    return element.hasClass( 'wnwidgets' );
                },
                init : function (){

                },
                data :function(){

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

                                    console.log('ok');
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