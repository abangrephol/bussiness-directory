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
<div class="panel panel-default ">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#page-editor" data-toggle="tab"><strong>Page Editor</strong></a></li>
        <li><a href="#site-setting" data-toggle="tab"><strong>Page Setting</strong></a></li>
        <li class="pull-right save"><a><i class="fa fa-file-text"></i>&nbsp;Save</a></li>
    </ul>
    <div class="panel-body-nopadding">
        <div class="tab-content" style="padding-top:0">
            <div class="tab-pane active" id="page-editor">
                <div class="toolbar">
                    <ul class="filemanager-options panel-primary">
                        <li class="">
                            <span class="itemopt preview">
                                    <i class="fa fa-eye"></i>&nbsp;Preview
                            </span>
                        </li>
                        <li class="">
                            <span class="itemopt reload">
                                    <i class="fa fa-refresh"></i>&nbsp;Reload
                            </span>
                        </li>
                        <li class="pull-right" style="  padding-bottom: 0px;   padding-top: 2px;">
                            <div class="">
                                <div class="form-group {{ $errors->has('status')?'has-error':'' }}">
                                    {{ Form::label('status', 'Status', array('class' => 'control-label required' )) }}
                                    {{ Form::select('status', array('draft'=>'Draft','publish'=>'Publish','private'=>'Private') ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select Status','id'=>'status_publish','style'=>'padding-left:10px;')) }}
                                    <label id='status_error' for='status' class='error' style='display: inline-block;'>{{ $errors->first('status') }}</label>
                                </div>
                            </div>
                        </li>
                        <li class="pull-right" style="  padding-bottom: 0px;">
                            <div class="">
                                <div class="form-group {{ $errors->has('slug')?'has-error':'' }}">

                                    <div class="block">
                                        <label>
                                            {{ Form::checkbox('isHome', null ,null , array('required'=>'required')) }}
                                            &nbsp;Is Home page ?
                                        </label>
                                    </div>
                                    <label id='slug_error' for='slug' class='error' style='display: inline-block;'>{{ $errors->first('slug') }}</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <iframe id="builder" width="100%" scrolling="no" class=""></iframe>

            </div>
            <div class="tab-pane" id="site-setting" style="padding:15px">
                <div class="row mb10">
                    <div class="col-sm-6">
                        <div class="row mb10">

                                <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                                    {{ Form::label('name', 'Page Name', array('class' => 'col-sm-3 control-label required' )) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('name', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter page name')) }}
                                        <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('title')?'has-error':'' }}">
                                    {{ Form::label('title', 'Page Title', array('class' => 'col-sm-3 control-label required' )) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('title', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter page title')) }}
                                        <label id='title_error' for='title' class='error' style='display: inline-block;'>{{ $errors->first('title') }}</label>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('slug')?'has-error':'' }}">
                                    {{ Form::label('slug', 'Page Slug', array('class' => 'col-sm-3 control-label required' )) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('slug', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter page slug')) }}
                                        <label id='slug_error' for='slug' class='error' style='display: inline-block;'>{{ $errors->first('slug') }}</label>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row mb20">

                            <div class="form-group ">
                                {{ Form::label('background-color', 'Background Color', array('class' => 'col-sm-3 control-label' )) }}
                                <div class="col-sm-8">
                                    {{ Form::text('background-color', isset($background_color)?$background_color:null , array('class'=>'form-control colorpicker-input','required'=>'required','placeholder'=>'Default')) }}
                                    <span id="colorSelector" class="colorselector">
                                        <span></span>
                                    </span>
                                    <label id='background-color_error' for='background-color' class='error' style='display: inline-block;'>{{ $errors->first('background-color') }}</label>
                                </div>
                            </div>

                            <?php if (isset($banners)){

                                ?>
                                <div class="form-group ">
                                    {{ Form::label('banners', 'Banners', array('class' => 'col-sm-3 control-label' )) }}
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            {{ Form::text('banner[]', $banners[0] , array('class'=>'form-control col-sm-9','required'=>'required','placeholder'=>'Select an image','id'=>'banner-1')) }}
                                            <div class="input-group-btn">
                                                <a href="{{URL::to('3rdparty/filemanager/dialog.php?type=0&field_id=banner-1')}}" class="btn btn-default iframe-btn" type="button">Select File</a>
                                                <a class="btn btn-default addButton"><i class="fa fa-plus"></i></a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            <?php
                                for ($i=1;$i <count($banners);$i++){

                            ?>
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-3">
                                        <div class="input-group">
                                            {{ Form::text('banner[]', $banners[$i] , array('class'=>'form-control col-sm-9','required'=>'required','placeholder'=>'Select an image')) }}
                                            <div class="input-group-btn">
                                                <a href="{{URL::to('3rdparty/filemanager/dialog.php?type=0')}}" class="btn btn-default iframe-btn" type="button">Select File</a>
                                                <a class="btn btn-default removeButton"><i class="fa fa-minus"></i></a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <?php }
                            }else{ ?>
                            <div class="form-group ">
                                {{ Form::label('banners', 'Banners', array('class' => 'col-sm-3 control-label' )) }}
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        {{ Form::text('banner[]', null , array('class'=>'form-control col-sm-9','required'=>'required','placeholder'=>'Select an image','id'=>'banner-1')) }}
                                        <div class="input-group-btn">
                                            <a href="{{URL::to('3rdparty/filemanager/dialog.php?type=0&field_id=banner-1')}}" class="btn btn-default iframe-btn" type="button">Select File</a>
                                            <a class="btn btn-default addButton"><i class="fa fa-plus"></i></a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group hide" id="template">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <div class="input-group">
                                        {{ Form::text('banner[]', null , array('class'=>'form-control col-sm-9','required'=>'required','placeholder'=>'Select an image')) }}
                                        <div class="input-group-btn">
                                            <a href="{{URL::to('3rdparty/filemanager/dialog.php?type=0')}}" class="btn btn-default iframe-btn" type="button">Select File</a>
                                            <a class="btn btn-default removeButton"><i class="fa fa-minus"></i></a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group ">
                                {{ Form::label('body-font', 'Body Font', array('class' => 'col-sm-3 control-label' )) }}
                                <div class="col-sm-8">
                                    {{ Form::text('body-font', isset($body_font)?$body_font:null , array('class'=>'form-control','required'=>'required','placeholder'=>'Type font name from google fonts')) }}
                                    <label id='body-font_error' for='body-font' class='error' style='display: inline-block;'>{{ $errors->first('body-font') }}</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>


    </div>
</div>
{{ Form::close() }}
<script>
    function responsive_filemanager_callback(field_id,data){
        console.log(data);
        //your code
    }
    jQuery(document).ready(function(){
        /*$.ajax({
            type: "GET",
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            url: "{{ route('custom-website.builderEditor',array('templateId'=>$templateId,'id'=>$id,'pageId'=>$pageId)) }}",
            success: function (data, status, xhr) {
                var $result = $.parseHTML(xhr.responseText,true),
                    $data = xhr.responseText,
                    $scripts = $($result).find("script").add($($result).filter("script")).detach(),
                    $body = $($result).find("body").add($($result).filter("body")).detach();
                $('#builder-tm').val(xhr.responseText);
                /*var scriptArray = new Array();
                $.each($scripts,function(i){
                    scriptArray.push($(this).attr('src'));

                })
                CKEDITOR.scriptLoader.load( scriptArray, function( complete,failed ) {
                    // Alerts true if the script has been properly loaded.
                    // HTTP error 404 should return false.
                    console.log( complete.length+" "+failed.length );
                });


                tinymce.init({
                    mode: "textareas",
                    schema: "html5",
                    cleanup: false,
                    remove_script_host : false,
                    allow_script_urls: true,
                    menubar:false,
                    valid_elements : "*[*]",
                    extended_valid_elements : "*[*],script[charset|defer|language|src|type],style",
                    custom_elements: "*[*],script[charset|defer|language|src|type],style",
                    valid_children : "+body[style],+body[script],+head[script]",
                    verify_html : false,
                    entity_encoding : "raw",
                    media_strict: false,
                    plugins: [
                        "advlist autolink lists link image charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table  paste autoresize noneditable fullpage"
                    ],
                    //toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    relative_urls: false,
                    browser_spellcheck : false ,
                    filemanager_title:"Responsive Filemanager",
                    external_filemanager_path:"/3rdparty/filemanager/",
                    external_plugins: { "filemanager" : "/3rdparty/filemanager/plugin.min.js"},
                    codemirror: {
                        indentOnInit: true, // Whether or not to indent code on init.
                        path: 'CodeMirror'
                    },

                    image_advtab: true,
                    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                    toolbar2: "| responsivefilemanager | image | media | link unlink anchor | print preview code  | youtube | qrcode | flickr | picasa | fullpage ",
                    setup: function(editor) {
                        editor.on('init',function(e){
                            $(tinymce.activeEditor.getBody()).find('script[type="mce-no/type"]').remove();
                            tinyMCE.activeEditor.setContent($data, {format : 'raw'});
                        });
                        editor.on('BeforeSetContent', function(e) {

                            var scriptLoader = new tinymce.dom.ScriptLoader();
                            $.each($scripts,function(i){

                                scriptLoader.load($(this).attr('src'));
                            })
                            scriptLoader.loadQueue(function() {

                            });


                        });
                    }

                });

            }
        });*/


        $('#builder').iFrameResize();

        jQuery('body').addClass('leftpanel-collapsed');
        jQuery('.menutoggle').addClass('menu-collapsed');
        jQuery('.nav-bracket .children').css({display: ''});
        jQuery('#status_publish').select2();
        var preview = false;
        jQuery('.preview').live('click',function(el){
            if(preview){
                $('#builder').contents().find('#gm-controls').show();
                var windowjQuery = $('#builder')[0].contentWindow.$;
                var f = $('#builder').contents().find('#body');
                windowjQuery.data(f[0], 'gridmanager').initCanvas();
                preview = false;
                jQuery('.save').find('a').removeClass('disabled');
                $(this).html('<i class="fa fa-eye"></i>&nbsp;<span>Preview</span>');
            }else{
                $('#builder').contents().find('#gm-controls').hide();
                var windowjQuery = $('#builder')[0].contentWindow.$;
                var f = $('#builder').contents().find('#body');
                windowjQuery.data(f[0], 'gridmanager').cleanup();
                windowjQuery.data(f[0], 'gridmanager').deinitCanvas();
                preview = true;
                jQuery('.save').find('a').addClass('disabled');
                $(this).html('<i class="fa fa-edit"></i>&nbsp;<span>Edit</span>');
            }

        });
        jQuery('.reload').live('click',function(){
            $( '#builder' ).attr( 'src', function ( i, val ) { return val; });
        });
        jQuery('.save').live('click',function(){
            if(jQuery(this).find('a').hasClass('disabled')==false){
                jQuery(this).find('a').addClass('disabled').html('Saving...');
                //var windowjQuery = $('#builder')[0].contentWindow.$;
                var iframeWindow = $('#builder')[0].contentWindow;
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
                        jQuery('.save').find('a').html('<i class="fa fa-file-text"></i>&nbsp;Save').removeClass('disabled');
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
        jQuery('#colorSelector').ColorPicker({
            onShow: function (colpkr) {
                jQuery(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
                jQuery('#colorSelector').prev().val('#'+hex);
            }
        });
        var bannerIn = 1;
        jQuery('.addButton').live('click', function() {
            var $template = $('#template');
            var $clone    = $template
                    .clone()
                    .removeClass('hide')
                    .removeAttr('id');
            bannerIn++;
            $clone.find('input').attr('id','banner-'+bannerIn);
            $clone.find('.iframe-btn').attr('href',$clone.find('.iframe-btn').attr('href')+'&field_id=banner-'+bannerIn);
            $clone.insertBefore($template);
            var $option   = $clone.find('[name="option[]"]');

            // Add new field
            //$('#surveyForm').formValidation('addField', $option);
        });
        jQuery('.removeButton').live('click', function() {
            var $row    = $(this).parents('.form-group'),
                $option = $row.find('[name="option[]"]');

            // Remove element containing the option
            $row.remove();
        });
        jQuery('.iframe-btn').live('click', function(e) {
            jQuery(this).fancybox({
                'width'		: 900,
                'height'	: 600,
                'type'		: 'iframe',
                'autoScale'    	: false
            });
            e.preventDefault();
        });

    });

    jQuery(window).load(function(){
        $('#builder').attr('src',"{{ route('custom-website.builderEditor',array('templateId'=>$templateId,'id'=>$id,'pageId'=>$pageId)) }}");
    })

</script>

<style>

    .filemanager-options{
        margin-bottom: 0;
    }
    #builder {
        border: none;
    }
    .panel-default {
        border: 1px solid #aaa;
    }
    .filemanager-options li.btn {
        color: #fff;
    }
    .save,.preview,.reload,.edit-page{
        cursor: pointer;
    }
    .input-group-btn .btn {
        line-height: 26px !important;
    }
</style>