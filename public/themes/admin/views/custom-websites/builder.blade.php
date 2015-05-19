<?php
if($pageId!=0){
?>
{{ Form::model($data, array('route' => array('admin.categories.update', $data->id),'method'=>'PUT','class'=>'form')) }}
<?php
}else{
?>
{{ Form::open(array('route' => array('admin.custom-website.store'),'method'=>'POST','class'=>'form')) }}
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
                                            {{ Form::checkbox('isHome', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter page slug')) }}
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
            <div class="tab-pane" id="site-setting" style="padding-top:15px">
                <div class="row mb10">
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                            {{ Form::label('name', 'Page Name', array('class' => 'control-label required' )) }}
                            {{ Form::text('name', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter page name')) }}
                            <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->has('title')?'has-error':'' }}">
                            {{ Form::label('title', 'Page Title', array('class' => 'control-label required' )) }}
                            {{ Form::text('title', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter page title')) }}
                            <label id='title_error' for='title' class='error' style='display: inline-block;'>{{ $errors->first('title') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row mb10">
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->has('slug')?'has-error':'' }}">
                            {{ Form::label('slug', 'Page Slug', array('class' => 'control-label required' )) }}
                            {{ Form::text('slug', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter page slug')) }}
                            <label id='slug_error' for='slug' class='error' style='display: inline-block;'>{{ $errors->first('slug') }}</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
{{ Form::close() }}
<script>
    jQuery(document).ready(function(){
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
        jQuery('.save').live('click',function(){
            if(jQuery(this).find('a').hasClass('disabled')==false){
                jQuery(this).find('a').addClass('disabled').html('Saving...');
                var windowjQuery = $('#builder')[0].contentWindow.$;
                var f = $('#builder').contents().find('#body');
                var gm =windowjQuery.data(f[0], 'gridmanager');
                gm.options['remoteURL'] ="{{URL::route('custom-website.builderSave',array('id'=>$id,'pageId'=>$pageId))}}"
                gm.cleanup();
                gm.deinitCanvas();
                var canvas = gm.$el.find("#" + gm.options.canvasId);
                $.ajax({
                    type: "POST",
                    url:  gm.options.remoteURL,
                    data: {
                        content: canvas.html(),
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

                    });
            }

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
    .save,.preview,.edit-page{
        cursor: pointer;
    }

</style>