<div id="editor-container" class="editor-iframe"></div>
<script type = "text/javascript">

    (function (window) {
        'use strict';
        function classReg(className) {
            return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
        }
        var hasClass, addClass, removeClass;
        if ('classList' in document.documentElement) {
            hasClass = function (elem, c) {
                return elem.classList.contains(c);
            };
            addClass = function (elem, c) {
                elem.classList.add(c);
            };
            removeClass = function (elem, c) {
                elem.classList.remove(c);
            };
        }
        else {
            hasClass = function (elem, c) {
                return classReg(c).test(elem.className);
            };
            addClass = function (elem, c) {
                if (!hasClass(elem, c)) {
                    elem.className = elem.className + ' ' + c;
                }
            };
            removeClass = function (elem, c) {
                elem.className = elem.className.replace(classReg(c), ' ');
            };
        }

        function toggleClass(elem, c) {
            var fn = hasClass(elem, c) ? removeClass : addClass;
            fn(elem, c);
        }

        window.classie = {
            // full names
            hasClass: hasClass,
            addClass: addClass,
            removeClass: removeClass,
            toggleClass: toggleClass,
            // short names
            has: hasClass,
            add: addClass,
            remove: removeClass,
            toggle: toggleClass
        };

    })(window);
    var
        menuRight = document.getElementById('push'),
        showRight = document.getElementById('showLeftPush'),
        body = document.body;

    showRight.onclick = function () {
        classie.toggle(this, 'active');
        classie.toggle(menuRight, 'cbp-spmenu-open');
    };
    jQuery(window).load(function(){
        var iframe = document.createElement("iframe");
        $(iframe).addClass('editor-iframe');
        iframe.style.display = "none";
        iframe.src ="{{ route('custom-website.builderEditor',array('templateId'=>$templateId,'id'=>$id,'pageId'=>$pageId)) }}";
        iframe.onload = (function(){
            iframe.style.display = "block";
            $(iframe).contents().find('body').prepend('<div id="toolbar"></div>').css('padding-top','70px');
            $(iframe).contents().find('head').append("<style>" +
                "#toolbar {position:fixed;top:0;z-index:1000;left:0;}" +
                "</style>");
        });
        document.getElementById("editor-container").appendChild(iframe);
    })
    jQuery('.save').on('click',function(){
        if(jQuery(this).hasClass('disabled')==false){
            jQuery(this).addClass('disabled').find('span').html('Saving...');

            //var windowjQuery = $('#builder')[0].contentWindow.$;
            var iframeWindow = $('#editor-container').find('iframe')[0].contentWindow;
            //var f = $('#builder').contents().find('#body');
            //var gm =windowjQuery.data(f[0], 'gridmanager');

            var url = "{{URL::route('custom-website.builderSave',array('id'=>$id,'pageId'=>$pageId))}}";

            //gm.options['remoteURL'] = "{{URL::route('custom-website.builderSave',array('id'=>$id,'pageId'=>$pageId))}}"
            //gm.cleanup();
            //gm.deinitCanvas();
            //var canvas = gm.$el.find("#" + gm.options.canvasId);
            $.ajax({
                type: "POST",
                url:  url,
                data: {
                    content: iframeWindow.CKEDITOR.instances.sbbody.getData(),
                    input: $('form').serialize()
                }
            }).done(function( data ) {
                    jQuery('.save').removeClass('disabled').find('span').html('Save');
                    jQuery.gritter.add({
                        title: 'Notification',
                        text: 'Page Successfully saved.',
                        sticky: false,
                        time: ''
                    });
                    if(data.type=="new")
                        window.location = window.location+"?pageId="+data.id;
                });
        }

    });
</script>