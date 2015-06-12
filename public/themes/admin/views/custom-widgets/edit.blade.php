<div class="panel panel-alt panel-default">
    <div class="panel-heading">
        <a class="btn btn-danger pull-right mr10 mt5" href="{{ URL::route('admin/custom-widget') }}">Back to list</a>
        <h4 class="panel-title-alt"><i class="fa fa-edit mr5"></i><span class="text-danger">Please enter template information</span></h4>
        <p>* = Required fields</p>
    </div>
    {{ Form::model($data, array('route' =>  array('admin.custom-widget.update', $data->id),'method'=>'PUT','class'=>'form form-horizontal')) }}
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
</div>
<script>
    jQuery(document).ready(function(){

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