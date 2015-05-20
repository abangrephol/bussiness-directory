<div class="panel panel-default">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#pages" data-toggle="tab"><strong>Page List</strong></a></li>
        <li><a href="#custom-website" data-toggle="tab"><strong>Custom Website Data</strong></a></li>
        <li><a href="#site-setting" data-toggle="tab"><strong>Site Setting</strong></a></li>
        <!--li class="pull-right save"><a><i class="fa fa-file-text"></i>&nbsp;Save</a></li-->
    </ul>
    <div class="panel-body-nopadding">
        <div class="tab-content">
            <div class="tab-pane active" id="pages">
                <div class=" pull-right">
                    <div class="btn-group">
                        <a class="btn btn-white" href="{{ URL::route('custom-website.builder',array('id'=>$id,'templateId'=>$templateId)) }}">Add New Page</a>
                    </div>
                </div>
                <h5 class="subtitle mb5">{{ Theme::get('pageTitle') }} list</h5>
                <p class="text-muted">...</p>
                <div class="table-responsive">
                    {{ Theme::widget('datatable', array('columns' => $columns, 'routeUrl' => $routeUrl,'dataRoute'=>array('id'=>$id)))->render() }}
                </div>
            </div>
            <div class="tab-pane" id="custom-website" style="padding-top:15px">
                {{ Form::model($data, array('route' => array('admin.custom-website.update', $data->id),'method'=>'PUT','class'=>'form')) }}
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
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="tab-pane" id="site-setting" style="padding-top:15px">
                <div class="row mb20">
                    <div class="col-sm-12">
                        <div class="form-group ">
                            {{ Form::label('background-color', 'Background Color', array('class' => 'col-sm-offset-1 col-sm-3 control-label' )) }}
                            <div class="col-sm-7">
                                {{ Form::text('background-color', null , array('class'=>'form-control colorpicker-input','required'=>'required','placeholder'=>'Default')) }}
                                <span id="colorSelector" class="colorselector">
                                    <span></span>
                                </span>
                                <label id='background-color_error' for='background-color' class='error' style='display: inline-block;'>{{ $errors->first('background-color') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group ">
                            {{ Form::label('banners', 'Banners', array('class' => 'col-sm-offset-1 col-sm-3 control-label' )) }}
                            <div class="col-sm-7 fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                    <div class="uneditable-input">
                                        <i class="glyphicon glyphicon-file fileupload-exists"></i>
                                        <span class="fileupload-preview"></span>
                                    </div>
                                    <span class="btn btn-default btn-file">
                                      <span class="fileupload-new">Select file</span>
                                      <span class="fileupload-exists">Change</span>
                                      {{ Form::file('banner[]') }}
                                    </span>
                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    &nbsp;
                                    <a class="btn btn-default"><i class="fa fa-plus"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 hide">
                        <div class="form-group ">
                            {{ Form::label('banners', 'Banners', array('class' => 'col-sm-offset-1 col-sm-3 control-label' )) }}
                            <div class="col-sm-7 fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                    <div class="uneditable-input">
                                        <i class="glyphicon glyphicon-file fileupload-exists"></i>
                                        <span class="fileupload-preview"></span>
                                    </div>
                                    <span class="btn btn-default btn-file">
                                      <span class="fileupload-new">Select file</span>
                                      <span class="fileupload-exists">Change</span>
                                      {{ Form::file('banner[]') }}
                                    </span>
                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script>
    jQuery(document).ready(function(){
        //if(jQuery('#colorpicker').length > 0) {
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
        //}
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
