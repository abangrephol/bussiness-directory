function loadScript(srcURL) {
    var deferred = new $.Deferred();
    var e = document.createElement('script');
    e.onload = function () { deferred.resolve(); };
    e.src = srcURL;
    document.getElementsByTagName("head")[0].appendChild(e);
    return deferred.promise();
}
var templateObject = "<div class='wnwidgets widget-object'><span>{{widgetName}}</span></div>";
(function() {
    if (!Array.prototype.forEach) {
        Array.prototype.forEach = function (fn, scope) {
            'use strict';
            var i, len;
            for (i = 0, len = this.length; i < len; ++i) {
                if (i in this) {
                    fn.call(scope, this[i], i, this);
                }
            }
        };
    }
    CKEDITOR.plugins.add('wnnavigation', {
        requires: ['iframedialog','fakeobjects','widget'],
        init: function(editor) {

            CKEDITOR.dialog.addIframe('wnnavigationD', 'Menu Editor', window.location.origin + '/admin/widgets/navigation', 850, 400,
                function() {
                    iframeid=this._.frameId;/*get the iframe*/
                    iframe = document.getElementById( this._.frameId );
                    iframeWindow = iframe.contentDocument || iframe.contentWindow.document;
                }
            );
            editor.addCommand('wnnavigationC', {
                exec: function(e) {
                    e.openDialog('wnnavigationD');
                }
            });
            if ( editor.ui.addButton ) {
                editor.ui.addButton('wnnavigationB', {
                    label: 'Navigation',
                    command: 'wnnavigationC',
                    //icon: this.path + 'icons/redo.png',
                    toolbar: 'mode,11'
                });
            }
            editor.widgets.add('wnnavigation',{
                upcast: function( element ) {
                    return element.name=='wnav';
                },
                init : function (){
                    if(this.element.is('wnav')){
                        var widget = this;
                        widget.setData('navId',$(widget.element).attr('navId'));
                        widget.element.setHtml("<span>Menu</span>");
                    }

                },
                data :function(evt){
                },
                downcast: function (el){
                    var navId = this.data.navId;
                    el.setHtml("[nav id='"+navId+"'][/nav]");
                },
                edit: function(evt){
                    if(this.element.is('wnav')){
                        var editDialog = editor.openDialog('wnnavigationD');
                        editDialog.definition.contents[0].elements[0].src = window.location.origin + '/admin/widgets/navigation/'+ this.data.navId;
                    }
                }
            });
            CKEDITOR.addCss(
                'wNav' +
                    '{' +
                    'background-color: #428bca;' +
                    'background-position: center center;' +
                    'background-repeat: no-repeat;' +
                    'border: 0px;' +
                    'width: 100%;' +
                    'height: 40px ;' +
                    'line-height:40px;' +
                    'text-align:center;' +
                    'display:block;' +
                    'color:white;' +
                    '}' +
                '.cke_button__wnnavigationb_label ' +
                    '{' +
                    'display:inline;' +
                    '}'

            );
        }
    });
})();