<div class="panel panel-alt panel-default">
    <div class="panel-heading">
        <a class="btn btn-danger pull-right mr10 mt5" href="{{ URL::route('admin/custom-widget') }}">Back to list</a>
        <h4 class="panel-title-alt"><i class="fa fa-edit mr5"></i><span class="text-danger">Please enter template information</span></h4>
        <p>* = Required fields</p>
    </div>
    {{ Form::open(array('route' => array('admin.custom-widget.store'),'method'=>'POST','class'=>'form form-horizontal')) }}
    <div class="panel-body">

        <div class="alert {{ Session::get('messages')? Session::get('messages')->has('error')?'alert-danger':'alert-success' :'hidden' }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div id="successMessage text-center">{{ Session::get('messages')?Session::get('messages')->first('message'):'' }}</div>
        </div>
        <div class="row mb20">
            <div class="col-sm-12">
                {{ Form::hidden('theme_id', $thid) }}
                <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                    {{ Form::label('name', 'Template Name', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::text('name', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter template name')) }}
                        <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('template')?'has-error':'' }}">
                    {{ Form::label('template', 'Template', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::textarea('template', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter description')) }}
                        <label id='name_template' for='template' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('template')?'has-error':'' }}">
                    {{ Form::label('location', 'Location', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::select('location', array('sbheader'=>'Header','sbbody'=>'Body','sbfooter'=>'Footer','none'=>'No Restriction') ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select widget type')) }}
                        <label id='name_template' for='template' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('template')?'has-error':'' }}">
                    {{ Form::label('type', 'Type', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::select('type', array('html'=>'HTML Widget','object'=>'Object Widget') ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select widget type')) }}
                        <label id='name_template' for='template' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('template')?'has-error':'' }}">
                    {{ Form::label('form', 'Form Data', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        <div class="mb10">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#formDialog" id="addInput">Add Input</a>
                        </div>

                        <div id="formData">

                        </div>
                        <label id='name_template' for='form' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    <div id="tpl" style="display: none" class="formInput">
        <div class="row mb20">
            <div class="col-sm-7">
                <label class="mr10 padding10" id="inputLabel"></label>
                <label class="mr10 padding10" id="inputName"></label>
                <label class="mr10 padding10" id="inputType"></label>
            </div>
            <div class="col-sm-4 pull-right">
                {{ Form::hidden('inputData[]', null , array()) }}
                <a class="btn btn-success editInput"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger removeInput"><i class="fa fa-trash"></i></a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="formDialog" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Form Input</h4>
                </div>
                <div class="modal-body">

                    <form id="formInput" class="form form-horizontal">
                        <div class="form-group">
                            {{ Form::label('name', 'Name', array('class' => ' col-sm-3 control-label required' )) }}
                            <div class="col-sm-7">
                                {{ Form::text('name', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter input name')) }}
                                <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('label', 'Label', array('class' => ' col-sm-3 control-label required' )) }}
                            <div class="col-sm-7">
                                {{ Form::text('label', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter input label')) }}
                                <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('type', 'Type', array('class' => ' col-sm-3 control-label required' )) }}
                            <div class="col-sm-7">
                                {{ Form::select('type', array('text'=>'Text','textarea'=>'Textarea','select'=>'Combo Box','option'=>'Options','date'=>'Datepicker','file'=>'Files','icon'=>'Icons Font Awesome') ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select input type')) }}
                                <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('default', 'Default Value', array('class' => ' col-sm-3 control-label required' )) }}
                            <div class="col-sm-7">
                                {{ Form::textarea('default', null , array('class'=>'form-control','rows'=>'4','required'=>'required','placeholder'=>'Enter default value')) }}
                                <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                            </div>
                        </div>
                        <div id="combobox" class="form-group hide">
                            {{ Form::label('name', 'Items', array('class' => ' col-sm-3 control-label required' )) }}
                            <div id="combobox_items" class="col-sm-9">
                                <div id="combobox_item" class="row mb10">
                                    <div class="col-xs-4">
                                        {{ Form::text('cb_label[]', null , array('class'=>'form-control col-sm-3','required'=>'required','placeholder'=>'Enter label')) }}
                                    </div>
                                    <div class="col-xs-4">
                                        {{ Form::text('cb_value[]', null , array('class'=>'form-control col-sm-3','required'=>'required','placeholder'=>'Enter value')) }}
                                    </div>
                                    <div class="col-xs-4">
                                        <a id="addCbox" class=" col-sm-3 btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            {{ Form::label('multi', 'Mulitple', array('class' => ' col-sm-3 control-label required' )) }}
                            <div class="col-sm-7">
                                {{ Form::select('formMulti', array('single'=>'Single','multi'=>'Multiple') ,null , array('id'=>'formMulti','class'=>'select2','required'=>'required','placeholder'=>'Select widget type')) }}
                                <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                            </div>
                        </div>
                        <div id="multiple" class="hide form-group">
                            {{ Form::label('multiNumber', 'Multiple Number', array('class' => ' col-sm-3 control-label required' )) }}
                            <div class="col-sm-7">
                                {{ Form::text('multiNumber', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter number')) }}
                                <label id='multiNumber_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                            </div>
                        </div>
                    </form>
                    <div id="combobox_item_tpl" class="row mb10 hide">
                        <div class="col-xs-4">
                            {{ Form::text('cb_label[]', null , array('class'=>'form-control col-sm-3','required'=>'required','placeholder'=>'Enter label')) }}
                        </div>
                        <div class="col-xs-4">
                            {{ Form::text('cb_value[]', null , array('class'=>'form-control col-sm-3','required'=>'required','placeholder'=>'Enter value')) }}
                        </div>
                        <div class="col-xs-4">
                            <a class="removeCbox col-sm-3 btn btn-sm btn-danger"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="saveInput" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<script>
    jQuery(document).ready(function(){
        var spinner = jQuery('#multiNumber').spinner({
            min: 0
        });
        spinner.spinner('value', 1);
        // Basic Form
        jQuery(".form").validate({
            highlight: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        jQuery('#parent_id').select2({
            placeholder: "Select a parent",
            width:'100%',
            allowClear:true
        });
        function formatResult(item) {
            if(!item.id) {
                // return `text` for optgroup
                return item.text;
            }
            // return item template

            return '<i class="fa '+item.id+' mr10"></i>' + item.text + '';
        }
        function formatSelection(item) {
            // return selection template
            return '<i class="fa '+item.id+' mr10"></i>' + item.text + '';
        }
        /*jQuery('#template').ckeditor({
            allowedContent:true
        });*/
        var editor = CodeMirror.fromTextArea(document.getElementById("template"), {
            lineNumbers: true,
            viewportMargin: Infinity,
            mode: "htmlmixed"
        });

        jQuery('.select2').select2({width:'100%',allowClear:true});
        $('#formType').on('change',function(){
            switch($(this).val()){
                case 'option':
                case 'select':
                    $('#combobox').removeClass('hide');
                    break;
                default:
                    $('#combobox').addClass('hide');
                    break;
            }
        });
        $('#formMulti').on('change',function(){
            switch($(this).val()){
                case 'single':
                    $('#multiple').addClass('hide');
                    break;
                case 'multi':
                    $('#multiple').removeClass('hide');
                    break;
            }
        })
        $('#addCbox').on('click',function(){
            var newCbox = $('#combobox_item_tpl').clone().removeClass('hide').removeAttr('id');
            newCbox.appendTo('#combobox_items');
        })
        $( document ).on( "click", ".removeCbox", function() {
            $(this).closest('.row').remove();
        });
        $('#addInput').on('click',function(){
            method = 'add';
            $('#formInput').trigger("reset");
            spinner.spinner('value', 1);
            $('.select2').trigger('change');
            $('#combobox_items div.row:not(#combobox_item)').remove();
            $('#combobox_items div.row input').val('');
        })
        $('#saveInput').on('click',function(){
            var type = {'text':'Text','textarea':'Textarea','select':'Combo Box','option':'Options','date':'Datepicker','file':'Files','icon':'Icons Font Awesome'};

            var newForm;
            if(method=='add'){
                newForm = $('#tpl').clone().css('display','block').removeAttr('id');
            }else{
                newForm = editPointer;
            }
            var object = $('#formInput').serializeObject();
            var data = JSON.stringify(object);
            newForm.find('input').val(data);
            newForm.find('#inputLabel').html(object.label);
            newForm.find('#inputName').html(object.name);
            newForm.find('#inputType').html(type[object.type]);
            if(method=='add'){
                newForm.appendTo('#formData');
            }
            $('#formDialog').modal('hide');
        });
//        jQuery('#addInput').on('click',function(){
//
//            var newForm = $('#tpl').clone().css('display','block').removeAttr('id');
//            $.each(newForm.find('.select2tmp'),function(i,v){
//                $(v).select2({width:'100%',allowClear:true});
//            })
//            newForm.appendTo('#formData');
//        });
        var method = 'add';
        var editPointer = null;
        $( document ).on( "click", ".removeInput", function() {
            $(this).closest('.formInput').remove();
        });
        $( document ).on( "click", ".editInput", function() {
            method = 'edit';
            editPointer = $(this).closest('.formInput');
            var data = JSON.parse($(this).closest('div').find('input').val()) ;
            $('#formInput').deserialize(data);
            $('.select2').trigger('change');
            $('#formDialog').modal('show');
        });
        /*
        jQuery('#icon').select2({
            width:'100%',
            allowClear:true,
            // Specify format function for dropdown item
            formatResult: formatResult,
            // Specify format function for selected item
            formatSelection: formatSelection
        });
        */
    });
</script>