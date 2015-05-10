<div class="panel panel-default">
    {{ Form::open(array('route' => array('admin.custom-website.store'),'method'=>'POST','class'=>'form form-horizontal')) }}
    <div class="panel-heading">
        <div class=" pull-right">
            <div class="btn-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
        <h4 class="panel-title-alt"><i class="fa fa-edit mr5"></i><span class="text-danger">Please enter {{ Theme::get('pageTitle') }} information</span></h4>
        <p class="text-muted">{{ Theme::get('pageDescription') }}</p>
        <p>* = Required fields</p>


    </div>
    <div class="panel-body">


        <div class="row mb20">
            <div class="col-sm-12">
                <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                    {{ Form::label('name', 'Website Name', array('class' => 'col-sm-offset-1 col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::text('name', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter domain name without tld')) }}
                        <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('company_id')?'has-error':'' }}">
                    {{ Form::label('company_id', 'Company', array('class' => 'col-sm-offset-1 col-sm-3 control-label required' )) }}
                    <div class="col-sm-7">
                        {{ Form::select('company_id', $companies ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select Company')) }}
                        <label id='company_id_error' for='company_id' class='error' style='display: inline-block;'>{{ $errors->first('company_id') }}</label>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                    {{ Form::label('domain', 'Custom Domain (optional)', array('class' => 'col-sm-offset-1 col-sm-3 control-label' )) }}
                    <div class="col-sm-5">
                        {{ Form::text('domain', null , array('class'=>'form-control ','placeholder'=>'Enter domain name without tld')) }}
                        <label id='domain_error' for='domain' class='error' style='display: inline-block;'>{{ $errors->first('domain') }}</label>
                        <label id='tld_error' for='tld' class='error' style='display: inline-block;'>{{ $errors->first('tld') }}</label>
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('tld', CustomWebsite::$tld ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select TLD','id'=>'tld')) }}

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
            },
            ignore: [],
            rules: {
                description: {
                    required: function()
                    {
                        CKEDITOR.instances.description.updateElement();
                    }
                }
            },
            messages: {

                description: "This field is required."
            },
            /* use below section if required to place the error*/
            errorPlacement: function(error, element)
            {
                if (element.attr("name") == "description")
                {
                    error.insertBefore("textarea#description");
                } else {
                    error.insertBefore(element);
                }
            }
        });
        jQuery('#company_id').select2({width:'100%',allowClear:true});
        jQuery('#tld').select2({width:'100%',allowClear:true});
    });
</script>