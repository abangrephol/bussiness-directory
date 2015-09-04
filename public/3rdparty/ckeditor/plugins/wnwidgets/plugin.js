var editorName = null;
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
var curWidget = null;
(function() {
    var iframeWindow = null,iframeid=null,iframe = null;
    CKEDITOR.plugins.add('wnwidgets', {
        requires: ['iframedialog','fakeobjects','widget'],
        init: function(editor) {
            CKEDITOR.dialog.addIframe('selectWidget', 'Insert Widgets', window.location.origin + '/admin/widget-list/', 550, 200,
                function() {
                    iframeid=this._.frameId;/*get the iframe*/
                    iframe = document.getElementById( this._.frameId );
                    iframeWindow = iframe.contentDocument || iframe.contentWindow.document;
                },
                {
                    onOk : function(){
                        var form = $(iframe).contents().find('form'),
                            data = {'formData':form.serializeObject(),'wId':form.data('wid')},
                            template = $(iframe).contents().find('#template').html();
                        template = Mustache.to_html(template,data.formData);
                        var customwidget = new CKEDITOR.dom.element.createFromHtml( template );
                        var ed = this._.editor;
                        ed.insertElement( customwidget );
                        ed.widgets.initOn(customwidget,'widgets',data);

                        /*$.get($(e).data('link'),function(data){

                        });
                        console.log($(iframe).contents().find('form').serializeObject());
                        //texttoadd=$('#return', $('#' + iframeid).contents()).html();
                        var dialog = this, data = $(iframe).contents().find('form').serializeObject(), customwidget = new CKEDITOR.dom.element( 'div' );
                        var ed = this._.editor;
                        this.commitContent( data );

                        //Object.keys(data).forEach(function(key) {
                        //    customwidget.setAttribute(data[key].name,data[key].value);
                        //});

                        var newFakeImage = ed.createFakeElement( customwidget, 'wnwidgets', 'wnwidget', true );
                        $(newFakeImage).attr('title',data.title);
                        $(newFakeImage).attr('alt',data.title);
                        ed.insertElement( newFakeImage );*/
                    },
                    onShow : function(){
                        this.definition.dialog.definition.contents[0].elements[0].src = window.location.origin + '/admin/widget-list/'+this._.editor.name;
                    }
                }
            );
            CKEDITOR.dialog.addIframe('editWidget', 'Edit Widgets', window.location.origin + '/admin/widget-form/', 550, 200,
                function() {
                    iframeid=this._.frameId;/*get the iframe*/
                    iframe = document.getElementById( this._.frameId );
                    iframeWindow = iframe.contentDocument || iframe.contentWindow.document;
                    console.log(curWidget);
                    $(iframe).contents().find('form').deserialize(curWidget.data.formData);
                },
                {
                    onOk : function(){
                        var form = $(iframe).contents().find('form'),
                            data = {'formData':form.serializeObject(),'wId':form.data('wid')},
                            template = $(iframe).contents().find('#template').html();
                        template = Mustache.to_html(template,data.formData);
                        curWidget.setData('formData',data.formData);
                        curWidget.setData('wId',data.wId);
                        curWidget.setData('template',template);
                        curWidget.element.setHtml($(template).html());

                    }
                }
            );
            CKEDITOR.dialog.add( 'my_plugin', function( editor ) {
                return {
                    title : 'My IFrame Plugin', minWidth : 390, minHeight : 230,
                    contents : [ {
                        id : 'tab1', label : '', title : '', expand : true, padding : 0,
                        elements : [ {
                            type : 'iframe',
                            src : window.location.origin + '/admin/widget-list',
                            width : 538, height : 478 - (CKEDITOR.env.ie ? 10 : 0),

                        } ]
                    } ]
                    , buttons : []   // don't show the default buttons
                };
            } );
            editor.addCommand('wnwidgets', {
                exec: function(e) {
                    e.openDialog('selectWidget');
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
                    //if(this.element.hasClass( 'wnwidgets' )){
                    //    html = editor.dataProcessor.toDataFormat( this.element.getHtml() );
                    //}
                    editor.widgets.on( 'instanceCreated', function( evt ) {
                        var widget = evt.data;
                        widget.on('data', function(evt){


                        });

                        /*widget.on('doubleclick',function(evt){
                            curWidget = widget;
                            //  this.edit();
                        });*/
                    });
                },
                data :function(){
                    console.log(this.initEditable('text',{
                        selector : 'p,h1,h2,h3,h4,h5,img',
                        multi:true
                    }));
                },
                downcast: function (element){

                },
                edit: function(evt){
                    curWidget = this;
                    //evt.data.dialog = 'selectWidget';
                    var editDialog = editor.openDialog( 'editWidget' );
                    editDialog.definition.contents[0].elements[0].src = window.location.origin + '/admin/widget-form/'+this.data.wId;
                }
            });
            CKEDITOR.addCss(
                'img.wnwidgets' +
                    '{' +
                    'background-image: url(' + CKEDITOR.getUrl( 'http://placehold.it/200x250' ) + ');' +
                    'background-position: center center;' +
                    'background-repeat: no-repeat;' +
                    'border: 0px;' +
                    'width: 100px;' +
                    '}' +
                '.cke_dialog_background_cover {' +
                    'z-index:100 !important;' +
                    '}'
            );
        }/*,
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
        }*/
    });
})();