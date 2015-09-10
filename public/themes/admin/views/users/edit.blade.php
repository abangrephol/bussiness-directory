<div class="panel panel-alt panel-default">
    <div class="panel-heading">
        <a class="btn btn-danger pull-right mr10 mt5" href="{{ URL::route('admin/users') }}">Back to list</a>
        <h4 class="panel-title-alt"><i class="fa fa-edit mr5"></i><span class="text-danger">Please enter category information</span></h4>
        <p>* = Required fields</p>
    </div>
    {{ Form::model($data,array('route' => array('admin.users.update',$data->id),'method'=>'PUT','class'=>'form form-horizontal')) }}
    <div class="panel-body">

        <div class="alert {{ Session::get('messages')? Session::get('messages')->has('error')?'alert-danger':'alert-success' :'hidden' }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div id="successMessage text-center">{{ Session::get('messages')?Session::get('messages')->first('message'):'' }}</div>
        </div>
        <div class="row mb20">
            <div class="col-sm-12">
                <div class="form-group">
                    {{ Form::label('first_name', 'First Name', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::text('first_name', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter first name')) }}
                        <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('last_name', 'Last Name', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::text('last_name', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter last name')) }}
                        <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::text('email', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter email')) }}
                        <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Password', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::password('password', array('class'=>'form-control','placeholder'=>'Enter password')) }}
                        <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('conf_password', 'Confirm Password', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::password('conf_password' , array('class'=>'form-control','placeholder'=>'Enter confirm password')) }}
                        <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('group', 'Group', array('class' => ' col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::select('group',$groups, $data->group_id , array('class'=>'select2','required'=>'required','placeholder'=>'Group')) }}
                        <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
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
        jQuery('.select2').select2({
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
        jQuery('#icon').select2({
            width:'100%',
            allowClear:true,
            // Specify format function for dropdown item
            formatResult: formatResult,
            // Specify format function for selected item
            formatSelection: formatSelection
        });

    });
</script>