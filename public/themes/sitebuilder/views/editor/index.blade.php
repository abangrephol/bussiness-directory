<div class="main-content">
    <div class="panel pan">
        <div class="panel-body pan-bod">
            Toolbox
            <div id="toolbar"></div>
        </div>
    </div>
    <div id="editor-container" class="editor-iframe"></div>
    <div class="right-sidebar cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="push">

        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#layouts" data-toggle="tab">Layouts</a></li>
            <li role="presentation"><a href="#elements" data-toggle="tab">Elements</a></li>
            <li role="presentation"><a href="#property" data-toggle="tab">Property</a></li>
        </ul>
        <div  class="tab-content ">
            <div class="tab-pane fade in active" id="layouts" >
                <div class="tab-block">
                    yuhuuu
                </div>
            </div>
            <div class="tab-pane fade in" id="elements">
                <div class="tab-block">
                    holaa
                </div>
            </div>
            <div class="tab-pane fade in" id="property">
                <div class="tab-block">
                    oksip
                </div>
            </div>
        </div>


    </div>
</div>
<div class="modal fade" id="mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Settings</h4>
            </div>
            <div class="modal-body">
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
                        <li><a href="#tab2" data-toggle="tab">Additional</a></li>
                    </ul>
                    <?php
                    if($pageId!=0){
                        ?>
                        {{ Form::model($data, array('route' => array('admin.categories.update', $data->id),'method'=>'PUT','class'=>'form form-horizontal')) }}
                    <?php
                    }else{
                        ?>
                        {{ Form::open(array('route' => array('admin.custom-website.store'),'method'=>'POST','class'=>'form form-horizontal')) }}
                    <?php
                    }
                    ?>
                    <div class="tab-content">

                            <div class="tab-pane active" id="tab1">
                                <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                                    {{ Form::label('name', 'Page Name', array('class' => ' col-sm-4 control-label required' )) }}
                                    <div class="col-sm-7">
                                        {{ Form::text('name', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter page name')) }}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('title')?'has-error':'' }}">
                                    {{ Form::label('title', 'Page Title', array('class' => ' col-sm-4 control-label required' )) }}
                                    <div class="col-sm-7">
                                        {{ Form::text('title', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter page title')) }}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('slug')?'has-error':'' }}">
                                    {{ Form::label('slug', 'URL Slug', array('class' => ' col-sm-4 control-label required' )) }}
                                    <div class="col-sm-7">
                                        {{ Form::text('slug', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter URL Slug')) }}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('slug')?'has-error':'' }}">
                                    {{ Form::label('status', 'Status', array('class' => ' col-sm-4 control-label required' )) }}
                                    <div class="col-sm-7">
                                        {{ Form::select('status', array('draft'=>'Draft','private'=>'Private','publish'=>'Publish') ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select Page Status')) }}
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab2">

                            </div>


                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grey" data-dismiss="modal">Close</button>
                <button id="saveSetting" type="button" class="btn btn-blue">Save changes</button>
            </div>
        </div>
    </div>
</div>

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
        jQuery('.select2').select2({width:'100%',allowClear:true});
        var iframe = document.createElement("iframe");
        $(iframe).addClass('editor-iframe');
        iframe.style.display = "none";
        iframe.src ="{{ route('custom-website.builderEditor',array('templateId'=>$templateId,'id'=>$id,'pageId'=>$pageId)) }}";
        iframe.onload = (function(){
            iframe.style.display = "block";
            $(iframe).contents().find('body').prepend('<div id="toolbar"></div>').css('padding-top','90px').css('padding-bottom','50px');
            $(iframe).contents().find('head').append("<style>" +
                "#toolbar {position:fixed;top:0;z-index:1000;left:0;}" +
                "</style>");
        });
        document.getElementById("editor-container").appendChild(iframe);
    })
    jQuery('#saveSetting').on('click',function(){
        $('#mod').modal('hide');
    })
    function checkSetting(){
        if(!$('form #name').val()) {
            $('#mod').modal('show');
            $('form #name').focus();
            return false;
        }
        if(!$('form #title').val()) {
            $('#mod').modal('show');
            $('form #title').focus();
            return false;
        }
        if(!$('form #slug').val()) {
            $('#mod').modal('show');
            $('form #slug').focus();
            return false;
        }
        if(!$('form #status').val()) {
            $('#mod').modal('show');
            $('form #status').focus();
            return false;
        }
        return true;
    }
    jQuery('.save').on('click',function(){
        var setting = checkSetting();
        if(jQuery(this).hasClass('disabled')==false && setting){
            jQuery(this).addClass('disabled').find('span').html('Saving...');

            var iframeWindow = $('#editor-container').find('iframe')[0].contentWindow;

            var url = "{{URL::route('custom-website.builderSave',array('id'=>$id,'pageId'=>$pageId))}}";

            $.ajax({
                type: "POST",
                url:  url,
                data: {
                    content: {
                        'head':iframeWindow.CKEDITOR.instances.sbheader.getData(),
                        'body':iframeWindow.CKEDITOR.instances.sbbody.getData(),
                        'foot':iframeWindow.CKEDITOR.instances.sbfooter.getData()
                    },
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
                        window.location = window.location+"/"+data.id;
                });
        }

    });
</script>